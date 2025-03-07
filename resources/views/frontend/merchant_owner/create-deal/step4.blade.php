<x-layouts.frontend-layout title="Business Owners Create Deal Page">
    @push('style')
        <style>
            .errorMsq {
                color: red !important;
                display: block;
            }
        </style>
    @endpush
    <div class="wizard-body wizard-body-new">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    @if ($deal != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right">
                                        </div>
                                    @endif
                                    <div>
                                        <h6>Step One</h6>
                                        <p>Add date span</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                 
                                    @if (count($photos) > 0)
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @elseif((count($photos) == 0) && ($deal->sales_amount != ''))
                                    
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Two</h6>
                                        <p>Upload photo to use for deal</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if ($deal->sales_amount != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Three</h6>
                                        <p>Add deal description and calculate Smart Point value</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if ($deal->available_location != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Four</h6>
                                        <p>
                                            Enter the number of vouchers, add participating locations
                                            & preview deal
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn">Deal Management</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    {{ Form::open(['route' => 'frontend.business_owner.saveDeal.step4', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;', 'files' => true]) }}
                    <div class="right_box_section step-3">
                        <div class="heading_sec">
                            <h1>Enter number of vouchers and participating location</h1>
                        </div>
                        @if ($profile->business_type == 'Online Only' || $profile->business_type == 'Mobile Business')
                           
                            <div class="row right_bx_btm_row">
                                <div class="col-lg-12 right_bx_btm_col">
                                    <div class="right_box_lft_bx">
                                        <div class="last-step">
                                            <h5>Last Step of the Deal Wizard</h5>
                                            <div class="last-step-inner">
                                                <p>How many of these vouchers would you like to offer, in total, to
                                                    your
                                                    customer base, per month? *</p>

                                                <div class="last-step-inner-bttm">
                                                    <div class="width_100">
                                                        <input type="text" placeholder="" name="voucher_number"
                                                            id="voucherNo" onkeypress="return isNumber(event);"
                                                            value="{{ old('voucher_number') }}" />
                                                        <span>Minimum of 15</span>
                                                    </div>

                                                    <label class="checkbox_Box" style="left: 540px">
                                                        <input type="checkbox" name="voucher_unlimited"
                                                            id="unlimitedCheck" <?php if (old('voucher_unlimited') == 'on') {
                                                                echo 'checked';
                                                            } ?> />
                                                        <span class="checkmark"></span>Unlimited
                                                    </label>
                                                </div>
                                                @if ($errors->has('voucher_number'))
                                                    <div class="error">{{ $errors->first('voucher_number') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="note_sec">
                                            <p><strong>Note:</strong>This amount will determine the aviability of
                                                this
                                                coupon to your customer base. Voucher limit set 30 or less will be
                                                labeled as a <strong>LIMITED TIME OFFER</strong> deal.</p>
                                        </div>
                                        <div class="note_sec">
                                            <p>For example, if you enter 100, only 100 of these deals will be
                                                available
                                                for use on a first come, first serve basis.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @else
                            <div class="right_bx_wrap">
                                <input type="hidden" data-id="{{ $deal->id }}" id="deal_id">
                                
                                <div class="row right_bx_btm_row">
                                    <div class="col-lg-5 right_bx_btm_col">
                                        <div class="right_box_lft_bx">
                                            <div class="last-step">
                                                <h5>Last Step of the Deal Wizard</h5>
                                                <div class="last-step-inner">
                                                    <p>How many of these vouchers would you like to offer, in total, to
                                                        your
                                                        customer base, per month? *</p>

                                                    <div class="last-step-inner-bttm">
                                                        <div class="width_100">
                                                            <input type="text" placeholder=""
                                                                name="voucher_number" id="voucherNo"
                                                                onkeypress="return isNumber(event);"
                                                                value="{{ old('voucher_number') }}" />
                                                            <span>Minimum of 15</span>
                                                        </div>

                                                        <label class="checkbox_Box">
                                                            <input type="checkbox" name="voucher_unlimited"
                                                                id="unlimitedCheck" <?php if (old('voucher_unlimited') == 'on') {
                                                                    echo 'checked';
                                                                } ?> />
                                                            <span class="checkmark"></span>Unlimited
                                                        </label>
                                                    </div>
                                                    @if ($errors->has('voucher_number'))
                                                        <div class="error">{{ $errors->first('voucher_number') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="note_sec">
                                                <p><strong>Note:</strong>This amount will determine the aviability of
                                                    this
                                                    coupon to your customer base. Voucher limit set 30 or less will be
                                                    labeled as a <strong>LIMITED TIME OFFER</strong> deal.</p>
                                            </div>
                                            <div class="note_sec">
                                                <p>For example, if you enter 100, only 100 of these deals will be
                                                    available
                                                    for use on a first come, first serve basis.</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- @if ($profile->business_type == 'Online Only' || $profile->business_type == 'Mobile Business')
                                @else --}}
                                    <div class="col-lg-7 right_bx_btm_col">



                                        <div class="cmn_box question_section_nw_btn">
                                            <div class="form-group multi-select">
                                                <label for="" style="color:black;">Participating
                                                    Location(s)</label>
                                                <select class="select-item select2"
                                                    name="participating_location_ids[]" id="participating_location_id"
                                                    multiple style="padding-bottom:18px!important;">
                                                    <option value=""disabled>Select locations</option>
                                                    @if ($business_locations)
                                                        @foreach ($business_locations as $locations)
                                                            <option value="{{ $locations->id }}">
                                                                {{ $locations->address }},
                                                                {{ $locations->city }},{{ $locations->states->name }},
                                                                {{ $locations->zip_code }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                @if ($errors->has('participating_location_ids'))
                                                    <div class="error">{{ $errors->first('participating_location_ids') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="cmn_box question_section_nw_btn">
                                            <p id="add_more_location_text" style="color: black">You can add more
                                                locations using the
                                                add button below or you can add later in your Business profile
                                                page</p>
                                            <button class="btn next_btn lc_btn" id="add_location_modal"
                                                type="button" data-id="{{ $deal->id }}">Add Participating
                                                Location</button>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        @endif
                        <div class="btn_section btn_section_two btn_section_two-button">


                            <div class=" btn_section_inn"> 
                                <div class="btn_section_btns_wr">
                                    <a class="btn back-button12"
                                        href="{{ route('frontend.business_owner.createDeal.step3') }}">Back</a>
                                    <button class="btn next_btn" type="submit">Next</button>
                                    <button class="btn preview-deal1 previewmodal pre-modal" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" type="button">Preview deal</button>
                                </div>
                                <div class="btn_section_btns_p_compl">
                                    <h6>Profile Completion :<span>75%</span> </h6>
                                </div>

                            </div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body position-relative">
                    <button type="button" class="close-button-one11" data-bs-dismiss="modal"><img
                            src="{{ asset('frontend_assets/images/cross-icon.svg') }}" alt="img" /></button>
                    <div class="preview-deal-modal-main">
                        <div class="prvw_dl_main_row">
                            <div class="row">
                                <div class="col-lg-4 prvw_dl_col">
                                    <div class="prvw_dl_col_inner">
                                        <h2>{{ Auth::user()->merchantBusiness->business_name }}</h2>
                                        <div class="logo_wth_img">
                                            <figutre class="logo_img">
                                                @if(Auth::user()->merchantBusiness->logo_image != null)
                                                   <img src="{{Auth::user()->merchantBusiness->logo_image}}" alt="img" style="width: 100px;border-radius: 18px;">
                                                @else
                                                   <img src="{{ asset('frontend_assets/images/11rectangle-img.svg')}}" alt="img">
                                                @endif
                                            </figutre>
                                            <figure class="lg_bs_img">
                                               
                                                @if(count($photos) > 0)
                                                    <img src="{{$photos[0]->getUrl();}}" alt="img" style="width: 100px;border-radius: 18px;" id="sizeable">
                                                @else
                                                    <img src="{{ asset('frontend_assets/images/modal-img1.png')}}" alt="img">
                                                @endif
                                            </figure>
                                        </div>
                                        <div class="use_deal_btn_cont">
                                            <button class="deactive-deal1">USE DEAL NOW</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 prvw_dl_col">
                                    <div class="prvw_dl_col_inner">
                                        <div class="prvw_dl_offer_head">
                                            @if(($deal->voucher_unlimited == 0) && ($deal->voucher_number == null))
                                                <h2 id="preview_voucher"></h2>
                                            @elseif(($deal->voucher_unlimited != 1) && ($deal->voucher_number <= 30))
                                               <h2>Limited Time Offer</h2>
                                            @endif
                                            <p>{{ $deal->suggested_description }}</p>
                                        </div>
                                        <div class="deal-point-text">
                                               <h2>Used for deal: <span>{{ $deal->point }}</span> Points</h2>
                                           
                                            @if($deal->end_Date != '')
                                            <?php $enddate = date_create($deal->end_Date); $format_end_date = date_format($enddate,'m-d-Y');?>
                                                <h3>Deal Expires: {{$format_end_date}}</h3>
                                            @else
                                                <h3></h3>
                                            @endif
                                        </div>
                                        <div class="terms_link">
                                            <a href="javascript:void(0);" class="terms_condition">Gimmzi Deals Terms and Conditions</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 prvw_dl_col">
                                    <div class="prvw_dl_col_inner">
                                        <div class="bottom-location-main">
                                           @if(Auth::user()->merchantBusiness->business_type == 'Mobile Business')
                                                <p><b style="font-size:22px;">How to redeem deal</b></p>
                                                <p>To redeem this deal, call for service or purchase using number provided below.</p>
                                                <p>Be sure to mention this deal to the associate prior to checkout</p>
                                                <p><img src="{{ asset('frontend_assets/images/call-16.svg')}}" alt="img" />{{ Auth::user()->merchantBusiness->business_phone }}</p>
                                                <br>
                                           @elseif(Auth::user()->merchantBusiness->business_type == 'Online Only')
                                                <p><b style="font-size:22px;">How to redeem deal</b></p>
                                                <p>To redeem this deal, select <b>USE DEAL NOW</b>. You will be sent an email with a code to use at checkout to the email address on file below.</p>
                                                <p><img src="{{ asset('frontend_assets/images/envelope.png')}}" alt="img" /> {{ Auth::user()->merchantBusiness->business_email }}</p>
                                                <br>
                                           @else
                                           @if(Auth::user()->merchantBusiness->street_address != '')
                                            <p><img src="{{ asset('frontend_assets/images/location-icon44.svg')}}" alt="img" />{{ Auth::user()->merchantBusiness->street_address }}, {{ Auth::user()->merchantBusiness->city }}, {{ Auth::user()->merchantBusiness->states->name }}, {{ Auth::user()->merchantBusiness->zip_code }}</p>
                                           @else
                                            <p><img src="{{ asset('frontend_assets/images/location-icon44.svg')}}" alt="img" />{{ Auth::user()->merchantBusiness->mailing_address }}, {{ Auth::user()->merchantBusiness->mailing_city }}, {{ Auth::user()->merchantBusiness->mailingstates->name }}, {{ Auth::user()->merchantBusiness->mailing_zipcode }}</p>
                                           @endif
                                            <p><img src="{{ asset('frontend_assets/images/call-16.svg')}}" alt="img" /> {{ Auth::user()->merchantBusiness->business_phone }} </p>
                                            <!-- <button class="get-direction-text1">Get Directions</button> -->
                                            <button class="get-direction-text1">choose participating location</button>
                                            @endif
                                        </div>
                                        <button class="use-deal-now1 rmv_frm_wlt_btn">Remove from wallet</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade cmn_modal_designs" id="terms_condition_modal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms & Condition</h5>
                </div>
                <div class="modal-body">
                    <p>{!! $deal->terms_conditions !!}</p>
                </div>
                <div class="modal-footer">
                    <div class="btn_foot_end">
                        <div class="btn_foot_end">
                            <button class="btn_table_s rdd " data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade cmn_modal_designs" id="add_participating_location_modal" aria-hidden="true"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Participating location</h5>
                </div>
                <form id="add_participating_location" name="add_participating_location" method="post">
                    <input type="hidden" id="add_deal_id" name="add_deal_id">
                    <div class="modal-body">
                        <div class="custom_form_dsgn_pop">
                            <div class="row custom_form_dsgn_pop_row gy-4">
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Name *</h5>
                                    <input type="text" name="location_name" id="location_name">
                                    <span id="locationnameerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Phone Number *</h5>
                                    <input type="text" name="location_phone" id="location_phone">
                                    <span id="phoneerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Fax Number</h5>
                                    <input type="text" name="location_fax" id="location_fax">
                                    <span id="faxerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Business Location Email</h5>
                                    <input type="text" name="location_email" id="location_email">
                                    <span id="emailerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Street Address *</h5>
                                    <input type="text" name="address" id="address">
                                    <span id="addresserror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>Location Zip Code *</h5>
                                    <input type="text" name="zip_code" id="zip_code">
                                    <span id="ziperror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>City *</h5>
                                    <input type="text" name="city" id="city">
                                    <span id="cityerror"></span>
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col">
                                    <h5>State *</h5>
                                    <select name="state_id" id="state">
                                        <option value=""> Select State </option>
                                        @if ($stateList)
                                            @foreach ($stateList as $states)
                                                <option value="{{ $states->id }}">{{ $states->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span id="stateerror"></span>
                                </div>
                                {{-- <div class="col-lg-6 custom_form_dsgn_pop_col">
                            <h5>Business Location Website</h5>
                            <input type="text" name="website" id="website">
                            <span id="websiteerror"></span>
                       </div>                 --}}
                            </div>
                        </div>
                        <input type="checkbox" style="margin-top: 40px; margin-right: 10px;" checked
                            name="check_location" value="yes_participate" class="yes_check_box">
                        <span>This deal will be available at this location</span>
                        <p>By unchecking you are not connecting this deal to this location. However, you can add this
                            deal or any new deals to this location later using Add/Manage Participating locations in
                            your business profile.</p>
                       
                    </div>

                    <div class="modal-footer">
                        <div class="btn_foot_end">
                            <div class="btn_foot_end">
                                <button type="submit" name="submit" class="btn_table_s grn">Add</button>
                                <button class="btn_table_s rdd close_modal" type="button">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- yes no modal --}}
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="nonParticipating" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>Is this a Non-participating Location?</h3>
                            <input type="hidden" id="locationid">
                            <input type="hidden" id="deal_id" data-id="{{ $deal->id }}">
                            <h4 id="locationName"></h4>
                            <p><b>Select Yes,</b> if this location is not a location where customers purchase products
                                and/or stuff process transactions with your customers.</p>

                            <p>Examples include headquaters, mailing address and/or a billing address only.</p>
                            <p> <b> Limit 1 non-participating location per account</b></p>
                            <p><b>Select No,</b> if you will be using this location for other deals but you do not wish
                                to use the deal being created at this location as of today.</p>

                            <p>Note: You can add this deal to this location at anytime in your merchant portal later</p>
                        </div>

                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="yesNonParticipating">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal"
                                    id="noNonParticipating">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="modal_message"></h3>
                        <p id="non_part_msg"></p>
                        <p id="limited_msg"></p>
                    </div>
                    <input type="hidden" id="removeid" name="removeid">
                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" id="closeModal">Close</button>
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
            function isNumber(evt)
            {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }
            $(document).ready(function() {
                $(document).on('click', '.terms_condition',function(){
                 $('#terms_condition_modal').modal('show');
                })
                $("#participating_location_id").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    allowClear: true
                });
            });
            $('#unlimitedCheck').on('click', function() {
                if ($(this).prop("checked") == true) {
                    $("#voucherNo").val('');
                    $("#voucherNo").attr('readonly', true);
                } else {
                    $("#voucherNo").attr('readonly', false);
                }
            })

            $(".previewmodal").on('click', function() {
                $('#preview_voucher').html('');
                $('#exampleModal').show();
                if($("#voucherNo").val() != ''){
                    if($("#voucherNo").val() <= 30){
                    $('#preview_voucher').html('Limited Time Offer');
                    }else{
                        $('#preview_voucher').html('');
                    }
                }   
            });
     
            $('#closeModal').on('click', function(){
                $('#success_modal').modal('hide');
            });

            $(document).ready(function() {
                $('.physical_location').on('keyup', function() {
                    var arrCount = [];
                    if ($("#participating_id tr").length > 0) {
                        $("#participating_id tr").each(function() {
                            var currentRow = $(this);
                            if (currentRow.find("td:eq(1)").text() == 'Yes') {
                                arrCount.push(currentRow.find("td:eq(1)").text());
                            }

                        });
                        $('#added_location').val('');
                        $("#added_location").val(arrCount.length + ' of ' + $('.physical_location').val() +
                            ' ' + 'locations');
                    } else {
                        $('#added_location').val('');
                        $("#added_location").val('0 of ' + $('.physical_location').val() + ' ' + 'locations');
                    }



                });

                $("#zip_code").on('keyup', function() {
                    var zipcode = $(this).val();
                    if (zipcode.length == 5) {
                        $.ajax({
                            url: '{{ route('frontend.ajax.get_city') }}',
                            type: 'get',
                            data: {
                                'zipcode': zipcode
                            },
                            success: function(result) {
                                //console.log(result.data);
                                if (result.success == 1) {
                                    $("#city").val(result.data.City);
                                    $("#ziperror").html('');
                                    $("#state").val(result.state_name);

                                } else {
                                    $("#ziperror").html(result.data[0]);
                                    $("#ziperror").css('color', 'red');
                                }

                            }
                        });
                    } else {
                        //$("#profilecity").val('');
                    }

                });

                $("input[name='is_check']").click(function() {

                    if ($("input:radio:checked").val() == 'yes') {

                        var location_id = $(this).data('id');
                        var deal_id = $('#deal_id').data('id');
                        // console.log(deal_id);
                        $.ajax({
                            url: '{{ route('frontend.business_owner.deal_redeem') }}',
                            type: 'GET',
                            data: {
                                'location_id': location_id,
                                'deal_id': deal_id
                            },
                            success: function(response) {
                                // alert('saved');
                                if (response.status == 1) {
                                    // console.log(response.data);
                                    $('.participating_location').css('display', 'block');
                                    $('.yes_no_redeem_part').css('display', 'none');
                                    if (response.data.status == 1) {
                                        var status = 'Yes';
                                    } else {
                                        var status = 'No';
                                    }
                                    var participatedata = '<tr>' +
                                        '<td id="">' + response.data.location.location_name+', '+response.data.location.address +
                                        '</td>' +
                                        '<td id="">' + status + '</td>' +
                                        '<td><a href="#url" id="">Edit Location</a></td>' +
                                        '</tr>';
                                    $("#participating_id").html(participatedata);
                                    $('#non_participating_edit').html('');
                                    $('#add_more_location_text').html(
                                        'You can add more locations using the add button below or you can add later in your Business profile page'
                                    );

                                    $('#added_location').val('');
                                    console.log($("#participating_id tr").length);
                                    $("#added_location").val($("#participating_id tr").length +
                                        ' of ' + $('.physical_location').val() + ' ' +
                                        'locations');
                                    if ($("#participating_id tr").length == parseInt($(
                                                '.physical_location')
                                            .val())) {
                                        $("#add_location_modal").attr('disabled', true);
                                    }
                                }

                            }
                        });
                    } else if ($("input:radio:checked").val() == 'no') {
                        var location_id = $(this).data('id');
                        $.ajax({
                            url: '{{ route('frontend.business_owner.no_deal_redeem') }}',
                            type: 'GET',
                            data: {
                                'location_id': location_id
                            },
                            success: function(response) {
                                // alert('saved');
                                if (response.status == 1) {

                                    $('#nonParticipating').modal('show');
                                    $('#locationName').html(response.data
                                        .location_name);
                                    $('#locationid').val(response.data.id);
                                }
                            }
                        });

                    }


                    $("#yesNonParticipating").on('click', function() {
                        var location_id = $('#locationid').val();
                        var deal_id = $('#deal_id').data('id');
                        // console.log(location_id);
                        $.ajax({
                            url: '{{ route('frontend.business_owner.yes_non_participating_location') }}',
                            type: 'GET',
                            data: {
                                'location_id': location_id,
                                'deal_id': deal_id
                            },
                            success: function(response) {
                                // alert('saved');
                                if (response.status == 1) {
                                    $('#nonParticipating').modal('hide');
                                    $('.participating_location').css('display', 'block');
                                    $('.yes_no_redeem_part').css('display', 'none');
                                    $('#participating_id').html('');
                                    var nonparticipatedata = '<tr>' +
                                        '<td id="">' + response.data.location.location_name+', '+ response.data.location
                                        .address+'</td>' +
                                        '<td><a href="Url" id="">edit location</a></td>' +
                                        +'</tr>';
                                    $("#non_participating_id").html(nonparticipatedata);
                                    $('#add_more_location_text').html(
                                        'At least one Participating Location for this deal is required to complete this deal creation.'
                                    );
                                }

                            }
                        });
                    });

                    $("#noNonParticipating").on('click', function() {
                        var location_id = $('#locationid').val();
                        var deal_id = $('#deal_id').data('id');
                        // console.log(deal_id);
                        $.ajax({
                            url: '{{ route('frontend.business_owner.no_non_participating_location') }}',
                            type: 'GET',
                            data: {
                                'location_id': location_id,
                                'deal_id': deal_id
                            },
                            success: function(response) {
                                // alert('saved');
                                if (response.status == 1) {
                                    $('.participating_location').css('display', 'block');
                                    $('.yes_no_redeem_part').css('display', 'none');
                                    if (response.data.status == 0) {
                                        var status = 'No';
                                    } else {
                                        var status = 'Yes';
                                    }
                                    var participatedata = '<tr>' +
                                        '<td id="">' + response.data.location
                                        .location_name +', '+ response.data.location
                                        .address+'</td>' +
                                        '<td id="">' + status + '</td>' +
                                        '<td><a href="#url" id="">Edit Location</a></td>' +
                                        '</tr>';
                                    $("#participating_id").html(participatedata);
                                    $('#non_participating_edit').html('');
                                    $('#add_more_location_text').html(
                                        'At least one Participating Location for this deal is required to complete this deal creation.'
                                    );
                                }

                            }
                        });
                    })
                });

                var addvalidator = $("#add_participating_location").validate({
                    rules: {

                        location_name: "required",
                        location_phone: {
                            required: true,
                            digits: true,
                        },
                        location_email: {
                            email: true,
                        },
                        address: {
                            required: true,
                        },
                        zip_code: {
                            required: true,
                        },
                        city: {
                            required: true,
                        },
                        state_id: {
                            required: true,
                        },

                    },
                    messages: {

                        location_name: "Please enter location name",
                        location_phone: {
                            required: "Please enter location phone number ",
                            digits: "Phone number must be a number"

                        },
                        location_email: {
                            email: "Please enter a valid email address",
                        },
                        address: {
                            required: "Please enter location address ",

                        },
                        zip_code: {
                            required: "Please enter location zip code",

                        },
                        city: {
                            required: "Please enter location city"
                        },
                        state_id: {
                            required: "Please enter location state",
                        }
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });
                $("#add_location_modal").on('click', function() {
                    $('#add_participating_location_modal').find('form').trigger('reset');
                    $('#add_participating_location_modal').modal('show');
                    $('#add_deal_id').val($(this).data('id'));

                });
                $('input[name=check_location]').on('click', function() {
                    if ($(this).val() == 'yes_non_participate') {
                        $('.yes_check_box').prop('checked', false);
                    } else {
                        $('.no_check_box').prop('checked', false);
                    }
                });

                $(".close_modal").click(function() {

                    $('#locationnameerror').html('');
                    $('#phoneerror').html('');
                    $('#faxerror').html('');
                    $('#emailerror').html('');
                    $('#addresserror').html('');
                    $('#ziperror').html('');
                    $('#cityerror').html('');
                    $('#stateerror').html('');
                    addvalidator.resetForm();

                    $('#add_participating_location_modal').modal('hide');
                    $('#add_participating_location_modal').find('form').trigger('reset');
                });

                $("#add_participating_location").submit(function(e) {

                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var form = $('#add_participating_location')[0];
                    var formdata = new FormData(form);

                    $.ajax({
                        url: "{{ route('frontend.business_owner.add_more_participating_location') }}",
                        type: 'POST',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        success: function(result) {
                            console.log(result);
                            if (result.status == 10) {
                                console.log(result.data);
                                $("#add_participating_location_modal").modal('hide');
                                $("#participating_location_id").html('');
                                toastr.success(
                                    'The participating location has been added successfully');

                                if (result.data.length > 0) {
                                  
                                    for (var x = 0; x < result.data.length; x++) {
                                        // var location = result.data[x];
                                        var participatedata = '<option value="' + result.data[x].id +'">' + result.data[x].address +
                                            ',' + result.data[x].city +','+result.data[x].states.name+','+result.data[x].zip_code+'</option>';
                                        $("#participating_location_id").append(participatedata);
                                       
                                    }

                                    if(result.button == 'disabled'){
                                        $("#add_location_modal").prop('disabled',true);
                                    }
                                    else{
                                        $("#add_location_modal").prop('disabled',false);
                                    }

                                    var arrCount = [];
                                    $("#participating_id tr").each(function() {
                                        var currentRow = $(this);
                                        if (currentRow.find("td:eq(1)").text() == 'Yes') {
                                            arrCount.push(currentRow.find("td:eq(1)")
                                                .text());
                                        }

                                    });
                                    if ($('.physical_location').val() != '') {
                                        $('#added_location').val('');
                                        $("#added_location").val(arrCount.length + ' of ' + $(
                                            '.physical_location').val() + ' ' + 'locations');
                                    }

                                    if (arrCount.length == parseInt($('.physical_location')
                                            .val())) {
                                        $("#add_location_modal").attr('disabled', true);
                                    }



                                }

                            } else if (result.status == 8) {

                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#locationnameerror').html('Location name field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 7) {

                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#phoneerror').html('Location phone field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 0) {


                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#faxerror').html('');
                                $('#phoneerror').html('');
                                $('#emailerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#phoneerror').html(result.validation_errors).css('color', 'red');

                            } else if (result.status == 2) {

                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#emailerror').html('');
                                $('#faxerror').html('');
                                $('#phoneerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#emailerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 1) {

                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#emailerror').html('');
                                $('#phoneerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                $('#faxerror').html(result.validation_errors).css('color', 'red');
                            } else if (result.status == 6) {

                                $('#locationnameerror').html('');
                                $('#addresserror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#addresserror').html('Location address field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 5) {

                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#ziperror').html('Location zip code field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 4) {

                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#cityerror').html('Location city field is required').css('color',
                                //     'red');

                            } else if (result.status == 3) {

                                $('#locationnameerror').html('');
                                $('#phoneerror').html('');
                                $('#faxerror').html('');
                                $('#emailerror').html('');
                                $('#addresserror').html('');
                                $('#ziperror').html('');
                                $('#cityerror').html('');
                                $('#stateerror').html('');
                                // $('#stateerror').html('Location state field is required').css(
                                //     'color', 'red');

                            } else if (result.status == 11) {
                                $("#success_modal").modal('show');
                                $("#modal_message").html('Business Location not saved.');
                            }else if(result.status == 13){
                                $("#add_participating_location_modal").modal('hide');
                                $("#participating_location_id").html('');
                                toastr.success(
                                    'The Non-participating location has been added successfully');
                                
                                var nonparticipatedata = '<tr>' +
                                    '<td id="">' + result.data.location_name + '</td>' +
                                    '<td><a href="Url" id="">edit location</a></td>' +
                                    +'</tr>';
                                $("#non_participating_id").html(nonparticipatedata);
                                
                            } else if(result.status == 12){
                                $("#success_modal").modal('show');
                                $("#modal_message").html('You already have one non-participating location');
                                $('#non_part_msg').html('If you need to change it, you can edit the existing location under non-participating locations');
                                $('#limited_msg').html('There is a one non-participating location limit per merchant').css('color', 'red');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-layouts.frontend-layout>
