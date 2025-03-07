<x-layouts.frontend-layout title="Business Owners Create Deal Page">
    <header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m">
                <a class="navbar-brand" href="{{ route('frontend.business_owner.index') }}"><img
                        src="{{ asset('frontend_assets/images/logo-marchant.png') }}" /></a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication">
                        <li class="header_close_btn"> <a href="{{ route('frontend.business_owner.close_button') }}">
                                Close</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    </header>
    <div class="wizard-body">
        <div class="container ">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    @if ($profile != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step One</h6>
                                        <p>Create your user login and tell us about your business</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if ($photos != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @else
                                        <div class="grey_circle margin-right"></div>
                                    @endif
                                    <div>
                                        <h6>Step Two</h6>
                                        <p>Upload your company logo and photos so your business can stand out</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if ($deal != '')
                                        @if ($deal->available_location != '')
                                            <div class="green_tick green_line grey_circle margin-right">
                                                <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                    alt="img" />
                                            </div>
                                        @else
                                            <div class="grey_circle margin-right"></div>
                                        @endif
                                    @endif
                                    <div>
                                        <h6>Step Three</h6>
                                        <p>Create first deal using Deal Wizard</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    @if ($deal != '')
                                        @if ($deal->is_complete == 1)
                                            <div class="green_tick green_line grey_circle margin-right">
                                                <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                    alt="img" />
                                            </div>
                                        @else
                                            <div class="grey_circle margin-right"></div>
                                        @endif
                                    @endif
                                    <div>
                                        <h6>Step Four</h6>
                                        <p>Choose and activate plan. Access profile on vour new Business Profile Page
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn" style="background: #93DA42;">Deal Management</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="right_box_section step-2">
                        {{ Form::open(['route' => 'frontend.business_owner.deal_save_step2', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => '']) }}
                        <h1>Add Deal Description</h1>
                        <div class="form-section">
                            <div class="new-one11">

                                @if ($deal->item_id != '')
                                    <select name="item_id" id="itemid">
                                        <option value="" selected disabled>--Select Item or Services--</option>
                                        @if ($items)
                                            @foreach ($items as $data)
                                                <option value="{{ $data->id }}" <?php if ($deal->item_id == $data->id) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $data->item_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                        <option value="add_new">Add New Item or Service</option>
                                    </select>
                                @else
                                    <select name="item_id" id="itemid">
                                        <option value="" selected disabled>--Select Item or Services--</option>
                                        @if ($items)
                                            @foreach ($items as $data)
                                                <option value="{{ $data->id }}" <?php if (old('item_id') == $data->id) {
                                                    echo 'selected';
                                                } ?>>
                                                    {{ $data->item_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                        <option value="add_new" style="color:blue;">Add New Item or Service</option>
                                    </select>
                                @endif
                                @if ($errors->has('item_id'))
                                    <div class="error" style="color:red;">{{ $errors->first('item_id') }}</div>
                                @endif
                            </div>
                            <div class="down_part border-0">
                                <div class="d-flex align-items-center">
                                    <h6>How much is the original sales price of this item($)? *</h6>
                                    @if ($deal->sales_amount != '')
                                        <input type="text" class="price_box mx-3 allow_decimal main-one44"
                                            name="original_price" id="originalPrc" placeholder=""
                                            value="{{ $deal->sales_amount }}">
                                    @else
                                        <input type="text" class="price_box mx-3 allow_decimal main-one44"
                                            name="original_price" id="originalPrc" placeholder=""
                                            value="{{ old('original_price') }}">
                                    @endif
                                </div>
                                @if ($deal != '')
                                    <input type="hidden" name="id" value="{{ $deal->id }}">
                                @else
                                    <input type="hidden" name="id">
                                @endif
                                <div class="d-flex align-items-center mt-4">
                                    <h6>What kind of discount are you offering on this item? *</h6>
                                    <div class="d-flex mx-3">
                                        @if ($deal->sales_amount != '')
                                            <label class="container_radio">
                                                <input type="radio" name="discount_type" value="free"
                                                    <?php if ($deal->discount_type == 'free') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Free
                                            </label>
                                            <label class="container_radio mx-4">
                                                <input type="radio" name="discount_type" value="discount"
                                                    <?php if ($deal->discount_type == 'discount') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Dolloar ($)
                                            </label>
                                            <label class="container_radio ">
                                                <input type="radio" name="discount_type" value="percentage"
                                                    <?php if ($deal->discount_type == 'percentage') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Percentage (%)
                                            </label>
                                        @else
                                            <label class="container_radio">
                                                <input type="radio" name="discount_type" value="free"
                                                    <?php if (old('discount_type') == 'free') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Free
                                            </label>
                                            <label class="container_radio mx-4">
                                                <input type="radio" name="discount_type" value="discount"
                                                    <?php if (old('discount_type') == 'discount') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Dolloar ($)
                                            </label>
                                            <label class="container_radio ">
                                                <input type="radio" name="discount_type" value="percentage"
                                                    <?php if (old('discount_type') == 'percentage') {
                                                        echo 'checked';
                                                    } ?> />
                                                <span class="checkmark"></span>Percentage (%)
                                            </label>
                                        @endif
                                    </div>

                                </div>
                                <div class="d-flex align-items-center mt-4">
                                    <h6>Is this a bogo (Buy One Get One) ?</h6>
                                    <div class="d-flex mx-3">
                                        <label class="container_radio">
                                            <input type="radio" name="bogo_type" value="bogo_no" <?php if ($deal->is_bogo == 0) {  echo 'checked'; } ?> >
                                            <span class="checkmark"></span>No
                                        </label>
                                        <label class="container_radio mx-4">
                                            <input type="radio" name="bogo_type" value="bogo_yes" <?php if ($deal->is_bogo == 1) {  echo 'checked'; } ?>>
                                            <span class="checkmark"></span>Yes
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('discount_type'))
                                    <div class="error" style="color:red;">{{ $errors->first('discount_type') }}</div>
                                @endif
                                <div class="d-flex align-items-center mt-4">
                                    <h6 class="discounttitle">Enter the discount amount($) *</h6>
                                    @if ($deal->discount_amount != '')
                                        <input type="text" class="price_box mx-3 allow_decimal main-one44"
                                            name="discount_amount" id="discountamnt"
                                            value="{{ $deal->discount_amount }}" placeholder="">
                                    @else
                                        <input type="text" class="price_box mx-3 allow_decimal main-one44"
                                            name="discount_amount" id="discountamnt"
                                            value="{{ old('discount_amount') }}" placeholder="">
                                    @endif
                                    <small>For the most attractive deal, we recommend at least half off the orginal
                                        sales price.</small>

                                </div>
                                @if ($errors->has('discount_amount'))
                                    <div class="error" style="color:red;">{{ $errors->first('discount_amount') }}</div>
                                @endif
                                <input type="hidden" name="point" id="discountpoint">
                            </div>
                        </div>
                        <div>
                            <span>required*</span>
                            @if ($deal->suggested_description != '')
                                <textarea class="add-iten-description-textarea" id="descriptiontext" name="description" readonly>{{ $deal->suggested_description }}</textarea>
                            @else
                                <textarea class="add-iten-description-textarea" id="descriptiontext" name="description" readonly>{{ old('description') }}</textarea>
                            @endif
                            @if ($errors->has('description'))
                                <div class="error" style="color:red;">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                        <span id="descriptionError"></span>

                        <p class="top-space-one11 small">Next, we will help you calculate the Smart Rewards point value
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="coin_sec calculationpoint">
                                    <h5 class="c-blue "><img src="{{ asset('frontend_assets/images/coin.svg') }}"
                                            alt="img" />
                                            @if($deal->point != '')
                                               <span class="pointtext">{{$deal->point}} Points</span>
                                            @else
                                               <span class="pointtext">---- Points</span>
                                            @endif
                                    </h5>
                                    <span class="c-blue">Amount of points customer need
                                        to redeem this deal.</span>
                                    @if($deal->sales_amount != '')
                                       <p class="basedprice">( Based on original sales price of ${{$deal->sales_amount}})</p>
                                    @else
                                       <p class="basedprice">( Based on original sales price of $---)</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <p class="character c-blue">Terms and condition</p>
                                <?php $text = str_replace('[Merchant Name]', $user->full_name, $categoryData->terms_conditions);
                                 $text2 = strip_tags($text);
                                $result =  str_replace('&nbsp;', '', $text2);
                                //echo $text;?>
                                <textarea class="add-iten-description-textarea" id="" name="terms_conditions" placeholder="" readonly>{!!$result!!}</textarea>
                            </div>
                        </div>
                        <div class="btn_section btn_section_two">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <a class="btn back-button12"
                                        href="{{ route('frontend.business_owner.deal_create_photo') }}">Back</a>
                                    <button class="btn next_btn11" href="">Next</button>
                                    {{-- <button class="btn preview-deal1" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Preview deal</button> --}}
                                </div>

                                <h6>Profile Completion :<span>50%</span> </h6>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Add-Manage-Gifts" tabindex="-1" aria-labelledby="Add-Manage-Gifts"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form name="itemForm" id="itemForm" method="post" action="javascript:void(0)">
                    <div class="modal-body white-modal white-modal-scroll text-left">
                        <div class="d-flex justify-content-between">
                            <h1>Item & Service Database</h1>
                            <button class="cancel-button itemClose" data-bs-dismiss="modal">CANCEL</button>
                        </div>
                        <div class="Gimmzi-Gift-Manager ">
                            <h2>Enter the name of Item or Service Below</h2>
                            <input type="text" id="item_name" name="item_name" class="Gimmzi-Gift-Manager-input"
                                placeholder="Example: Large Drink" />
                        </div>
                        <span id="nameerror" style="color:red;"></span>
                        <div class="row value-of-this-gift">
                            <div class="col-sm-6">
                                <h3>Enter the Value of Item or Service</h3>
                                <h4>the amount the customer would normally pay</h4>
                                <div class="customer-input">
                                    <label>$</label>
                                    <input type="text" class="value-input-text" id="value_one" name="value_one"
                                        onkeypress="return isNumber(event);" />
                                    <label>.</label>
                                    <input type="text" class="value-input-text" id="value_two" name="value_two"
                                        onkeypress="return isNumber(event);" />
                                </div>
                                <span id="amounterror" style="color:red;"></span>
                            </div>

                            <div class="col-sm-6">
                                <h3>Notes (Optional)</h3>
                                <textarea class="note-text" id="note" name="note"></textarea>
                            </div>
                        </div>
                        <div class="gift-database-main">
                            <div class="d-flex justify-content-between">
                                <h3>
                                    <div id="success_message" class="ajax_response" style="float:left"></div>
                                </h3>
                                <button type="submit" id="submit">Add To Database</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script>


            // $('input[type=radio]').on('click', function() {

            //      console.log($("input:radio:checked").val());
            //     if ($("input:radio:checked").val() == 'free') {
            //         if ($("#originalPrc").val() != '') {
            //             $("#discountamnt").val('');
            //             $("#discountamnt").val($("#originalPrc").val());
            //             $("#discountamnt").attr('readonly', true);
            //             var discount = $("#originalPrc").val();
            //             var y = 0.25;
            //             var point = Math.ceil(parseInt(discount / y));
            //             $('.calculationpoint').css('display', 'block');
            //             $('.calculationpoint h5.pointtext').html(point + ' Points');
            //             $("#discountpoint").val(point);
            //         } else {
            //             $("#discountamnt").val('');
            //             $("#discountamnt").attr('readonly', true);
            //             $("#discountpoint").val('');
            //             $('.calculationpoint').css('display', 'none');
            //         }

            //     } else {
            //         $("#discountamnt").val('');
            //         $("#discountamnt").attr('readonly', false);
            //         $("#discountpoint").val('');
            //         $('.calculationpoint').css('display', 'none');
            //     }
            //     if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
            //         console.log('123');
            //         $(".next_btn11").css('background','#26A7DF');
            //     }
            // })

            $("#descriptionid").on('change', function() {
                var text = $("#descriptionid option:selected").text();
                if ($("#descriptiontext").text() == '') {
                    $("#descriptiontext").text(text);
                   
                } else {
                    $("#descriptiontext").text('');
                    $("#descriptiontext").text(text);
                   
                }

            });

            $(".itemClose").click(function(){
                $("#itemid").val('');
            })
            $("#submit").click(function(e){
                e.preventDefault();
                
                if($("#item_name").val() == ''){
                    $("#nameerror").html('Please enter item or service name');
                }
                else
                {
                    $("#nameerror").html(' ');
                    if(($("#value_two").val() != '') && ($("#value_one").val() != '')){
                        var amount = $("#value_one").val()+'.'+$("#value_two").val();
                    }
                    else if(($("#value_two").val() == '') && ($("#value_one").val() != '')){
                        var amount = $("#value_one").val();
                    }
                    else if(($("#value_two").val() != '') && ($("#value_one").val() == '')){
                        var amount = '0.'+$("#value_one").val();
                    }
                    else{
                        var amount = '';
                    }
                 
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submit').html('Please Wait...');
                        $("#submit").attr("disabled", true);

                            $.ajax({
                            url: "{{ url('deal-save-item') }}",
                            type: "POST",
                            data: {
                                    item_name : $("#item_name").val(),
                                    value : amount
                                },
                            success: function(response) {
                                if (response.success == 1) {
                                    document.getElementById("itemForm").reset();
                                    $('#success_message').css('color','green').fadeIn().html('Item or Services save successfully....');
                                    setTimeout(function() {
                                        $('#success_message').fadeOut("slow");
                                        location.reload();
                                    }, 3000 );
                                    //location.reload();
                                } else {
                                    $("#Add-Manage-Gifts").modal('show');
                                }

                            }
                        });
                    
                }

            });
            
            $('input[name="discount_type"]').on('click', function() {
                var item = $('#itemid option:selected').text().trim();
                $("#descriptiontext").text(' ');
                if ($("input:radio:checked").val() == 'free') {
                    if ($("#originalPrc").val() != '') {
                        $("#discountamnt").val('');
                        $("#discountamnt").val($("#originalPrc").val());
                       // $("#discountamnt").attr('readonly', true);
                        var discount = $("#originalPrc").val();
                        var y = 0.25;
                        var point = Math.ceil(parseInt(discount / y));
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + discount + ')');
                        $("#discountpoint").val(point);
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount Amount ($)');
                        if($('input[name="bogo_type"]:checked').val() == 'bogo_yes'){
                                
                                var trimStr = $.trim('BUY ONE ' + item + ' and get ONE FREE');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val(trimStr);
                        }
                        else{
                            $("#descriptiontext").val('');
                            $('#descriptiontext').val($.trim('FREE '+item));
                        }
                    } else {
                        $("#discountamnt").val('');
                        $("#discountamnt").attr('readonly', true);
                        $("#discountpoint").val('');
                        $('.pointtext').html('--- Points');
                        //$('.calculationpoint').css('display', 'none');
                        $('.basedprice').html('( Based on original sales price of $---)');
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount Amount ($)');
                    }

                } else if ($("input:radio:checked").val() == 'percentage') {
                    $(".discounttitle").html('');
                    $(".discounttitle").html('Enter the discount percentage (%)');
                    if ($('#discountamnt').val() != '') {
                        var original = $("#originalPrc").val();
                        var y = 0.25;
                        var z = 100;
                        var discount = $("#discountamnt").val();
                        var point = Math.ceil(parseInt(((discount/z)*original) / y));
                        // $('.calculationpoint').css('display', 'block');
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + original + ')');
                        $("#discountpoint").val(point);
                        $('.pointtext').html(point+' Points');
                        $('.basedprice').html('( Based on original sales price of $'+original+')');
                        if($('input[name="bogo_type"]:checked').val() == 'bogo_yes'){
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val('BUY ONE ' + item + ' and get ONE ' + $('#discountamnt')
                                    .val() + '% OFF');
                        }
                        else{
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val($('#discountamnt').val()+'% OFF '+item);
                        }
                        
                    } else {
                        $("#descriptionError").html(' ');
                        $("#descriptionError").html('Please enter discount percentage');
                    }

                } else if ($("input:radio:checked").val() == 'discount') {
                    $(".discounttitle").html('');
                    $(".discounttitle").html('Enter the discount Amount ($)');
                    if ($('#discountamnt').val() != '') {
                        var original = $("#originalPrc").val();
                        var y = 0.25;
                        var discount = $("#discountamnt").val();
                        var point = Math.ceil(parseInt(discount / y));
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + original + ')');
                        $("#discountpoint").val(point);
                        $('.pointtext').html(point+' Points');
                        $('.basedprice').html('( Based on original sales price of $'+original+')');
                        if($('input[name="bogo_type"]:checked').val() == 'bogo_yes'){
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val('BUY ONE ' + item + ' and get ONE $' + $('#discountamnt')
                                    .val() + ' OFF');
                        }
                        else{
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val('$'+$('#discountamnt').val()+' OFF '+item);
                        }
                        
                    } else {
                        $("#descriptionError").html(' ');
                        $("#descriptionError").html('Please enter discount amount');
                    }

                }
                if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                    console.log('123');
                    $(".next_btn11").css('background','#26A7DF');
                }
            })

            $("#itemid").on('change', function() {
                if ($(this).val() == 'add_new') {
                    $('#Add-Manage-Gifts').modal('show');
                }
                else{
                    var base_url = window.location.origin;
                    var itemid = $(this).val();
                
                    let ajaxPath = base_url + "/get-category-item" + "?item_id=" + itemid;
                    $.ajax({
                        type: 'GET',
                        url: ajaxPath,
                        success: function(response) {
                            console.log(response);
                            if (response.success == 1) {
                                if (response.data.item_price != null) {
                                    $("#originalPrc").val(response.data.item_price);
                                } else {
                                    $("#originalPrc").val();
                                    $("#discountamnt").attr('readonly', false);
                                    $("#discountamnt").val('');
                                    $(".discounttitle").html('');
                                    $(".discounttitle").html('Enter the discount Amount ($)');
                                    $('.pointtext').html('--- Points');
                                    $('.basedprice').html('( Based on original sales price of $---)');
                                }

                            } else {
                                $("#originalPrc").val();
                            }
                        }
                    })
                    if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                        console.log('123');
                        $(".next_btn11").css('background','#26A7DF');
                    }
                }
                
            });

            $("#discountamnt").on('keyup', function() {
                if ($("#discountamnt").val().length > 0) {
                    
                    if ($('input[name="bogo_type"]:checked').val() == 'bogo_yes') {

                        if ($("input[name=discount_type]:checked").val() == 'free') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.calculationpoint h5.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var trimStr = $.trim('BUY ONE '+item+' and get ONE FREE');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val(trimStr);
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                            var discount = $("#discountamnt").val();
                            var original = $("#originalPrc").val();
                            var y = 0.25;
                            var z = 100;
                            var point = Math.ceil(parseInt(((discount/z)*original) / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    // var percentageamount = parseInt($("#originalPrc").val()-(($("#originalPrc").val()*amount)/100));
                                    //console.log($("#originalPrc").val()-(($("#originalPrc").val()*amount)/100));
                                    // $('#discountamnt').val('');
                                    // $('#discountamnt').val(amount+'%($'+percentageamount+')');
                                    $('#descriptiontext').val('');
                                    $('#descriptiontext').val('BUY ONE '+item+' and get ONE '+discount+'% OFF');

                                } else {
                                    $("#descriptionError").html('Please enter discount percentage');
                                }
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').val('');
                                    $('#descriptiontext').val('BUY ONE '+item+' and get ONE $'+$('#discountamnt').val()+' OFF');
                                } else {
                                    $("#descriptionError").html('Please enter discount amount');
                                }
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        }

                    }
                 else {
                        $("#discountpoint").val('');
                        if ($("input[name=discount_type]:checked").val() == 'free') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var trimStr = $.trim('Free '+item);
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val(trimStr);
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                            var discount = $("#discountamnt").val();
                            var original = $("#originalPrc").val();
                            var y = 0.25;
                            var z = 100;
                            var point = Math.ceil(parseInt(((discount/z)*original) / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').val('');
                                    $('#descriptiontext').val($('#discountamnt').val()+'% OFF '+item);
                                } else {
                                    $("#descriptionError").html('Please enter discount percentage');
                                }
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').val('');
                                    $('#descriptiontext').val('$'+$('#discountamnt').val()+' OFF '+item);
                                } else {
                                    $("#descriptionError").html('Please enter discount amount');
                                }
                            } else {
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        }
                    }
                }
                if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                    $(".next_btn11").css('background','#26A7DF');
                }
            })

            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            $('input[name="bogo_type"]').on('click', function() {
                if ($(this).val() == 'bogo_yes') {
                    console.log($('#discountamnt').val());
                    if ($("input[name=discount_type]:checked").val() == 'free') {
                        //   console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.calculationpoint h5.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim('BUY ONE ' + item + ' and get ONE FREE');
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val(trimStr);
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                        // console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                var discount = $("#discountamnt").val();
                                var original = $("#originalPrc").val();
                                var y = 0.25;
                                var z = 100;
                                var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $("#discountpoint").val(point);
                                $("#descriptionError").html('');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val('BUY ONE ' + item + ' and get ONE ' + discount + '% OFF');
                            } else {
                                $("#descriptionError").html('Please enter discount percentage').css('color','red');
                            }
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                var discount = $("#discountamnt").val();
                                var y = 0.25;
                                var point = Math.ceil(parseInt(discount / y));
                                $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $("#discountpoint").val(point);
                                $("#descriptionError").html('');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val('BUY ONE ' + item + ' and get ONE $' + $('#discountamnt')
                                    .val() + ' OFF');
                            } else {
                                $("#descriptionError").html('Please enter discount amount').css('color','red');
                            }
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    }

                }
                else{
                    if ($("input[name=discount_type]:checked").val() == 'free') {
                            var discount = $("#discountamnt").val();
                            var y = 0.25;
                            var point = Math.ceil(parseInt(discount / y));
                            $('.calculationpoint').css('display', 'block');
                            $('.calculationpoint h5.pointtext').html(point + ' Points');
                            $("#discountpoint").val(point);
                            $("#descriptionError").html('');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim('FREE ' + item);
                            $('#descriptiontext').val('');
                            $('#descriptiontext').val(trimStr);
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                        // console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                var discount = $("#discountamnt").val();
                                var original = $("#originalPrc").val();
                                var y = 0.25;
                                var z = 100;
                                var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $("#discountpoint").val(point);
                                $("#descriptionError").html('');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val($('#discountamnt').val()+'% OFF ' + item);
                            } else {
                                $("#descriptionError").html('Please enter discount percentage').css('color','red');
                            }
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                var discount = $("#discountamnt").val();
                                var y = 0.25;
                                var point = Math.ceil(parseInt(discount / y));
                                $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $("#discountpoint").val(point);
                                $("#descriptionError").html('');
                                $('#descriptiontext').val('');
                                $('#descriptiontext').val('$'+$('#discountamnt').val()+' OFF ' + item);
                            } else {
                                $("#descriptionError").html('Please enter discount amount').css('color','red');
                            }
                        } else {
                            $("#descriptionError").html('Please select Item or service first').css('color','red');
                        }
                    }
                }
                if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                    console.log('123');
                    $(".next_btn11").css('background','#26A7DF');
                }

            });
        </script>
    @endpush
</x-layouts.frontend-layout>
