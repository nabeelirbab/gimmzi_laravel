<x-layouts.provider-layout title="message board">
    @push('style')
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
        <style>
            .errorMsq {
                color: red !important;
                display: block;
            }
            /* .container {
               max-width: 600px;
            }
            */
            .select2-container{
               width:100%!important;
               z-index: 100000;
            }

        </style>
    @endpush
<form id="tenant_recognition" method="post" name="tenant_recognition">
    @csrf
    <div class="all-smart-rental-database-main-sec">
        <div class="first-smart-rental-sec">
            <div class="container message_board tenant">
                <h2>Tenant Recognition</h2>
                <div class="display_sec">
                    <div class="d-flex align-items-center max_cls">
                        <h6>Tenant Recognition Option</h6>
                        <div class="d-flex">
                            <label class="container_radio">
                                <input type="radio"  name="tenant_option" id="tenant_option" value="on" />
                                <span class="checkmark"></span>On
                            </label>
                            <label class="container_radio mx-4">
                                <input type="radio" name="tenant_option" id="tenant_option" value="off"/>
                                <span class="checkmark"></span>Off
                            </label>
                            <span id="optionerror"></span>
                        </div>

                    </div>
                    <p>
                        Allows ability to reward Tenant of The Month recognition, 100%
                        Pass Inspection, Because You Are A Great Tenant, Good Samaritan,
                        etc. You are able to reward up to 10 tenants for one reward at a
                        time. Points can be given along with the recognition.
                    </p>
                </div>
                <p>Select up to 10 tenants to be recognized at one time</p>
                <div class="form-group-rental-input">
                    <select  id="consumerid" multiple style="padding-bottom:18px!important;" name="consumer_id[]">
                    @if(count($consumers) > 0)
                            @foreach($consumers as $consumer_data)
                                <option value="{{$consumer_data->consumers->id}}">{{$consumer_data->consumers->full_name}}</option>
                            @endforeach
                     @endif
                    </select>

                    <button class="search">
                        <img src="{{asset('frontend_assets/images/search-icon-rental.svg')}}" alt="" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="message_board tenant">
        <div class="form_section_area">
            <div class="container form_margin top-space18">
                <div class="row">
                    <div class="col-sm-4 p-top-one p-top-4">
                        <select class="form-select select1 filter-section11" id="select_type" name="select_type">
                            <option value="" selected>Select the Recognition Type</option>
                            @foreach ($types as $type )
                            <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                            @endforeach

                        </select>
                        <span id="typeerror"></span>
                    </div>
                    <?php $currentmonth = date('Y-m-d');?>
                    <div class="col-sm-4 p-top-one p-top-4">
                        <select class="form-select select1 filter-section11" id="select_type" name="select_type">
                            <option value="" selected>Select the Month</option>
                            <option value="{{date('F', strtotime ( '-1 month' , strtotime ( $currentmonth ) ))}}">{{ date('F', strtotime ( '-1 month' , strtotime ( $currentmonth ) )) }}</option>
                            <option value="{{date('F')}}">{{ date('F') }}</option>
                            <option value="{{date('F', strtotime ( '+1 month' , strtotime ( $currentmonth ) ))}}">{{ date('F', strtotime ( '+1 month' , strtotime ( $currentmonth ) )) }}</option>
                        </select>
                        <span id="typeerror"></span>
                    </div>
                </div>

            </div>
            {{-- @if ($errors->has('select_type'))
                <div class="error" style="color:red;">{{ $errors->first('select_type') }}</div>
            @endif --}}

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label> System Generated Message </label>
                                <p>required*</p>
                            </div>

                            <textarea class="form-control system_message" id="system_message" rows="3" placeholder="Enter the message" name="system_message" ></textarea>
                        </div>
                        <span id="systemerror"></span>
                        {{-- @if ($errors->has('system_message'))
                            <div class="error" style="color:red;">{{ $errors->first('system_message') }}</div>
                        @endif --}}
                    </div>
                </div>
            </div>

            <div class="display_sec my-4 ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="d-flex">
                                <label class="container_radio">
                                    <input type="radio" id="tenant_only" value="tenant_only" name="default" />
                                    <span class="checkmark"></span>Tenants Only
                                </label>
                                <label class="container_radio mx-4">
                                    <input type="radio" id="make_public" value="make_public" name="default" />
                                    <span class="checkmark"></span>Make Public
                                </label>
                            </div>
                            <span id="defaulterror"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label> Custom Private Message To Tenant </label>

                            <textarea class="form-control custom_message" id="custom_message" rows="3" placeholder="Enter the message" name="custom_message"></textarea>
                        </div>
                        <span id="customerror"></span>
                        {{-- @if ($errors->has('custom_message'))
                            <div class="error" style="color:red;">{{ $errors->first('custom_message') }}</div>
                        @endif --}}
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-flex">
                            <button type="button" class="btn preview_btn" id="previewNew" data-bs-toggle="modal" data-bs-target="#preview_modal_publish">Preview</button>
                            <button class="btn publish_btn tenantsubmit" type="submit" name="submit">Publish</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{{-- Preview Modal --}}

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
                            <div class="special_mvmnt_wrapper">
                                <div class="special_mvmnt_wrapper_inr">
                                    <div class="special_mvmnt_wrapper_inr_top" id="recog">
                                        Please Select Recognition Type
                                    </div>

                                    <div class="special_mvmnt_wrapper_inr_btm">
                                      <h4 id="month"> </h4>
                                      <p id="system_msg"> </p>
                                     <p id="custom_msg"> </p>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script>
    $(document).ready(function () {
        $("#select_type").on('change', function(){
            var type_id = $('#select_type').val();
            $.ajax({
            url: "{{ url('get-recognation-message') }}",
            type: 'GET',
            data: {
                'type_id': type_id,
                },
            success: function(response){
                // console.log(response);
                    if(response.success == 1){
                         console.log(response.data);
                         $('.custom_message').val('');
                         $("#tenant_only").prop("checked",false);
                         $('#make_public').prop("checked",false);
                        $('.system_message').val(response.data.message);
                        $('.system_message').prop("readonly", true);
                        if(response.tenant.tenant_only == 1){
                            $("#tenant_only").prop("checked",true);
                            $('.custom_message').val(response.tenant.custom_message);

                        }else if(response.tenant.make_public == 1){
                            $('#make_public').prop("checked",true);
                            $('.custom_message').val(response.tenant.custom_message);
                        } else{
                            $('.custom_message').val('');
                        }
                    }
                }
            });
        });

        var editvalidator = $("#tenant_recognition").validate({
                    rules: {
                        tenant_option: "required",
                        select_type:{ required: true},
                        system_message: "required",
                        default: "required",
                        custom_message: "required",

                    },
                    messages: {
                        tenant_option: " Please Select one option",

                        select_type: {
                            required: "Please select one type",

                        },
                        system_message: "System Message field is required",
                        default: "Please select one",
                        custom_message: "Custom Message field is required",
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

        $("#tenant_recognition").submit(function(e) {
            e.preventDefault();
            $('.system_message').prop('readonly',false);
            $('#typeerror').html('');
            $('#systemerror').html('');
            $('#customerror').html('');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var form = $('#tenant_recognition')[0];
                var formdata = new FormData(form);
               // console.log(formdata);
                $.ajax({
                    url: "{{ route('frontend.store_tenant_recognation') }}",
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formdata,

                    success: function(result) {
                      //  console.log(result);
                        if(result.success == 1){
                            // console.log(result.data);
                            toastr.success('Tenant Recognition published successfully.');
                            $('#tenant_recognition')[0].reset();

                        } else if(result.success == 2){
                            //console.log($('.system_message').val());
                            $('#tenant_recognition')[0].reset();
                            toastr.success('Tenant Recognition published successfully.');

                        }else if(result.success == 3){
                            $('#systemerror').html('');
                            $('#customerror').html('');
                            // $('#optionerror').html('Please select one option').css('color','red');

                        } else if(result.success == 4){
                            console.log('yes');
                            $('#systemerror').html('');
                            $('#customerror').html('');
                            $('#defaulterror').html('');
                            // $('#typeerror').html('Please select one type').css('color', 'red');
                        } else if(result.success == 5){
                            $('#typeerror').html('');
                            $('#customerror').html('');
                            $('#defaulterror').html('');
                            // $('#systemerror').html('System message field is reqiured').css('color', 'red');
                        } else if(result.success == 6){
                            $('#typeerror').html('');
                            $('#systemerror').html('');
                            $('#customerror').html('');
                            // $('#defaulterror').html('Select one').css('color', 'red');
                        }
                        else if(result.success == 7){
                            $('#typeerror').html('');
                            $('#systemerror').html('');
                            $('#defaulterror').html('');
                            // $('#customerror').html('Custom Message field is required').css('color', 'red');
                        }
                    }
                });
        });

        $('#previewNew').click(function(){
            var system_msg = "No System Message Is There";
            var custom_msg = "No Custom Message Is There";

            if($('#select_type').val())
            {
                var recognition = $('#select_type').val();
                    var system_message = $('#system_message').val();
                    var custom_message = $('#custom_message').val();
                    var date = new Date();

                    var month = 'Tenant of '+date.toLocaleString('default', { month: 'long' });
                    //var d = date.getMonthName();
                  console.log(month);

                    $("#system_msg").html(system_message);
                    $("#custom_msg").html(custom_message);
                    $("#month").html(month);
                    console.log(month);
                    //alert(date.getMonthName());
                    $.ajax({
                        url: "{{ url('show_recognation') }}",
                        type: 'GET',
                        data: {
                            'recognition': recognition,
                        },

                        success: function(response) {
                            if (response.success == 1) {

                                console.log(response.getRecognition);
                                $("#recog").html(response.getRecognition.type_name);

                            }else if(response.success == ''){
                                $('#recog').html('');
                            } else{

                                $('#recog').html('');
                            }
                        }
                    });
            }else{
                //alert('No Record Found');
                $("#system_msg").html(system_msg);
                    $("#custom_msg").html(custom_msg);
            }

        });

        // var route = "{{ route('search-consumer-for-tenant') }}";
        // $( "#search" ).autocomplete({
        //     source: function(request, response) {
        //         $.ajax({
        //         url: route,
        //         data: {
        //                 term : request.term
        //         },
        //         dataType: "json",
        //         success: function(data){
        //             var resp = $.map(data,function(obj){
        //                 return obj.consumers.full_name+'('+obj.consumers.userId+')';
        //             }); 

        //             response(resp);
        //         }
        //     });
        //     },
        //     minLength: 1
        //     });
        $('#consumerid').select2({
            maximumSelectionLength: 10,
            tags: true,
            tokenSeparators: [',', ' '],
            allowClear: true,
            language: {
                // You can find all of the options in the language files provided in the
                // build. They all must be functions that return the string that should be
                // displayed.
                maximumSelected: function (e) {
                    var t = "You can only select " + e.maximum + " tenants";
                    e.maximum != 1 && (t += "s");
                    return t + ' - Upgrade Now and Select More';
                }
            }
        });

    
    });
   
</script>
@endpush
</x-layouts.provider-layout>
