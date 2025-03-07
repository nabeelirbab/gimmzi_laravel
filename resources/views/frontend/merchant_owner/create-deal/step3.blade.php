<x-layouts.frontend-layout title="Business Owners Create Deal Page">
    <div class="wizard-body mb-5">
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
                    <div class="right_box_section step-2">
                        {{ Form::open(['route' => 'frontend.business_owner.saveDeal.step3', 'method' => 'POST',  'style' => 'color:red']) }}
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
                                    <div class="error">{{ $errors->first('item_id') }}</div>
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
                                    @if ($errors->has('original_price'))
                                    <div class="error">{{ $errors->first('original_price') }}</div>
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
                                @if ($errors->has('discount_type'))
                                    <div class="error">{{ $errors->first('discount_type') }}</div>
                                    @endif
                                <div class="d-flex align-items-center mt-4">
                                    <h6>Is this a bogo (Buy One Get One) ?</h6>
                                    <div class="d-flex mx-3">
                                        @if($deal->is_bogo != '')
                                        <label class="container_radio">
                                            <input type="radio" name="bogo_type" value="bogo_no" <?php if ($deal->is_bogo == false) {
                                                        echo 'checked';} ?>>
                                            <span class="checkmark"></span>No
                                        </label>
                                        <label class="container_radio mx-4">
                                            <input type="radio" name="bogo_type" value="bogo_yes" <?php if ($deal->is_bogo == true ) {
                                                        echo 'checked';} ?>>
                                            <span class="checkmark"></span>Yes
                                        </label>
                                        @else
                                        <label class="container_radio">
                                            <input type="radio" name="bogo_type" value="bogo_no" <?php if (old('bogo_type') == 'bogo_no') {
                                                        echo 'checked';} ?>>
                                            <span class="checkmark"></span>No
                                        </label>
                                        <label class="container_radio mx-4">
                                            <input type="radio" name="bogo_type" value="bogo_yes" <?php if (old('bogo_type') == 'bogo_yes') {
                                                        echo 'checked';} ?>>
                                            <span class="checkmark"></span>Yes
                                        </label>
                                        @endif
                                    </div>
                                </div>
                                @if ($errors->has('bogo_type'))
                                    <div class="error">{{ $errors->first('bogo_type') }}</div>
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
                                    <div class="error">{{ $errors->first('discount_amount') }}</div>
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
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                        <span id="descriptionError"></span>

                        <p class="top-space-one11 small" style="color:black;">Next, we will help you calculate the Smart Rewards point value
                        </p>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="coin_sec calculationpoint">
                                    <h5 class="c-blue "><img src="{{ asset('frontend_assets/images/coin.svg') }}"
                                            alt="img" /><span class="pointtext">--- Points</span></h5>
                                    <span class="c-blue">Amount of points customer need
                                        to redeem this deal.</span>
                                    <p class="basedprice" style="color:black;">( Based on original sales price of $---)</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <p class="character c-blue">Terms and condition</p>
                                <?php $text = str_replace('[Merchant Name]', Auth::user()->merchantBusiness->business_name, $categoryData->terms_conditions);
                                $text2 = strip_tags($text);
                                $result =  str_replace('&nbsp;', '', $text2);
                                // echo $text;?>
                                <textarea class="add-iten-description-textarea" id="" name="terms_conditions" placeholder="" readonly>{{$result}}
                            </textarea>
                            </div>
                        </div>
                        <div class="btn_section btn_section_two">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <a class="btn back-button12"
                                        href="{{ route('frontend.business_owner.createDeal.step2') }}">Back</a>
                                    <button class="btn next_btn11" type="submit" href="">Next</button>
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
                            <h2>Enter the name of Item & Service Below</h2>
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
                                    <input type="text" class="value-input-text"  onkeypress="return isNumber(event);" id="value_one" name="value_one"/>
                                    <label>.</label>
                                    <input type="text" class="value-input-text" id="value_two" name="value_two" onkeypress="return isNumber(event);" />
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
                                <button type="button" id="submit">Add To Database</button>
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
            var base_url = window.location.origin;
            if ($("#itemid").val() != '') {
                if ($("#originalPrc").val() != '') {
                    if ($("input[name=discount_type]").val() != '') {
                        if ($("input[name=bogo_type]").val() != '') {
                            if ($("#discountamnt").val() != '') {
                                if ($("#descriptiontext").val() != '') {
                                    $(".next_btn11").css('background', '#26A7DF');
                                }
                            }
                        }
                    }
                }
            }

            $("#itemid").change(function() {
                if ($(this).val() == 'add_new') {
                    $('#Add-Manage-Gifts').modal('show');
                }
            })
            $(".itemClose").click(function(){
                $("#itemid").val('');
            })
            $("#value_two").on('keypress',function(){
                if($("#value_one").val() == ''){
                    $("#value_two").val('');
                    $("#amounterror").html('Please enter item value in decimal');
                }
                else{
                    $("#amounterror").html('');
                }
            });
            $("#submit").click(function(e){
                e.preventDefault();
                
                    if($("#value_one").val() == ''){
                        if($("#item_name").val() == ''){
                            $("#amounterror").html('Please enter item value in decimal');
                            $("#nameerror").html('Please enter item or service name');
                        }
                        else{
                            $("#nameerror").html(' ');
                            $("#amounterror").html(' ');
                            $("#amounterror").html('Please enter item value in decimal');
                        } 
                    }
                    else{
                        if($("#item_name").val() == ''){
                        $("#amounterror").html(' ');
                        $("#nameerror").html('Please enter item or service name');
                    }
                    else{
                        $("#nameerror").html(' ');
                        $("#amounterror").html(' ');
                        if($("#value_two").val() != ''){
                            var amount = $("#value_one").val()+'.'+$("#value_two").val();
                        }
                        else{
                            var amount = $("#value_one").val()+'.00';
                        }
                        console.log(amount);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('#submit').html('Please Wait...');
                        $("#submit").attr("disabled", true);

                            $.ajax({
                            url: "{{ url('save-item') }}",
                            type: "POST",
                            data: {
                                    item_name : $("#item_name").val(),
                                    value : amount},
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
               
                }

            });
            $('input[name="discount_type"]').on('click', function() {

                // console.log($("input:radio:checked").val());
                if ($("input:radio:checked").val() == 'free') {
                    if ($("#originalPrc").val() != '') {
                        $("#discountamnt").val('');
                        $("#discountamnt").val($("#originalPrc").val());
                        $("#discountamnt").attr('readonly', true);
                        var discount = $("#originalPrc").val();
                        var y = 0.25;
                        var point = Math.ceil(parseInt(discount / y));
                        // $('.calculationpoint').css('display', 'block');
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + discount + ')');
                        $("#discountpoint").val(point);
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount Amount ($)');
                        $("#descriptionError").html('');
                    } else {
                        $("#discountamnt").val('');
                        $("#discountamnt").attr('readonly', true);
                        $("#discountpoint").val('');
                        $('.pointtext').html('--- Points');
                        //$('.calculationpoint').css('display', 'none');
                        $('.basedprice').html('( Based on original sales price of $---)');
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount Amount ($)');
                        $("#descriptionError").html('');
                    }
                    if ($('input[name="bogo_type"]:checked').val() == 'bogo_yes') {
                        if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var trimStr = $.trim('BUY ONE '+item+' and get ONE FREE');
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text(trimStr);
                                $("#descriptionError").html(' ');
                        } else {
                                
                                $('#descriptiontext').text('');
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                        }
                    }
                    else{
                        var item = $('#itemid option:selected').text().trim();
                        var trimStr = $.trim('FREE '+item);
                        $('#descriptiontext').text('');
                        $('#descriptiontext').text(trimStr);
                        $("#descriptionError").html(' ');
                    }

                } else if ($("input:radio:checked").val() == 'percentage') {
                    $("#discountamnt").attr('readonly', false);
                    if($("#discountamnt").val() != ''){
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount percentage (%)');
                        if ($('input[name="bogo_type"]:checked').val() == 'bogo_yes') {
                            if ($('#itemid option:selected').text() != '') {
                                    var item = $('#itemid option:selected').text().trim();
                                    var trimStr = $.trim('BUY ONE '+item+' and get '+$("#discountamnt").val()+'% OFF');
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text(trimStr);
                                    $("#descriptionError").html(' ');

                            } else {
                                    $('#descriptiontext').text('');
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please select Item or service first');
                            }
                        }
                        else{
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim($("#discountamnt").val()+'% OFF '+item);
                            $('#descriptiontext').text('');
                            $('#descriptiontext').text(trimStr);
                            $("#descriptionError").html(' ');
                        }
                        var original = $("#originalPrc").val();
                        var y = 0.25;
                        var z = 100;
                        var discount = $("#discountamnt").val();
                        var point = Math.ceil(parseInt(((discount/z)*original) / y));
                        // $('.calculationpoint').css('display', 'block');
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + original + ')');
                        $("#discountpoint").val(point);
                    }
                    else{
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount percentage (%)');
                        $("#discountamnt").val('');
                        $("#discountamnt").attr('readonly', false);
                        $("#discountpoint").val('');
                    } 
                        
                    
                } else if ($("input:radio:checked").val() == 'discount') {
                    $("#discountamnt").attr('readonly', false);
                    if($("#discountamnt").val() != ''){
                        if ($('input[name="bogo_type"]:checked').val() == 'bogo_yes') {
                            if ($('#itemid option:selected').text() != '') {
                                    var item = $('#itemid option:selected').text().trim();
                                    var trimStr = $.trim('BUY ONE '+item+' and get $'+$("#discountamnt").val()+' OFF');
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text(trimStr);
                                    $("#descriptionError").html(' ');
                            } else {
                                    $('#descriptiontext').text('');
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please select Item or service first');
                            }
                        }
                        else{
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim('$'+$("#discountamnt").val()+' OFF '+item);
                            $('#descriptiontext').text('');
                            $('#descriptiontext').text(trimStr);
                            $("#descriptionError").html(' ');
                        }
                        var y = 0.25;
                        var discount = $("#discountamnt").val();
                        var point = Math.ceil(parseInt(discount / y));
                        // $('.calculationpoint').css('display', 'block');
                        $('.pointtext').html(point + ' Points');
                        $('.basedprice').html('( Based on original sales price of $' + $("#originalPrc").val() + ')');
                        $("#discountpoint").val(point);
                    }
                    else{
                        $(".discounttitle").html('');
                        $(".discounttitle").html('Enter the discount Amount ($)');
                        $("#discountamnt").val('');
                        $("#discountamnt").attr('readonly', false);
                        $("#discountpoint").val('');
                    }
                    
                    // $('.pointtext').html('--- Points');
                    // $('.basedprice').html('( Based on original sales price of $---)');
                   
                }
                if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                    console.log('123');
                    $(".next_btn11").css('background','#26A7DF');
                }
            })

            $("#itemid").on('change', function() {
                var itemid = $(this).val();
                let ajaxPath = base_url + "/get-item" + "?item_id=" + itemid;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(response) {
                        console.log(response);
                        if (response.success == 1) {
                            $("#originalPrc").val('');
                            if (response.data.item_price) {
                                $("#originalPrc").val(response.data.item_price.price);
                            } 
                            else if(response.data.item_value != null){
                                $("#originalPrc").val(response.data.item_value);
                            }
                            else {
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

            });

            $("#discountamnt").on('blur', function() {
                if ($("#discountamnt").val().length > 0) {
                    var discount = $("#discountamnt").val();
                    var y = 0.25;
                    var point = Math.ceil(parseInt(discount / y));
                    $('.calculationpoint').css('display', 'block');
                    $('.calculationpoint h5.pointtext').html(point + ' Points');
                    $("#discountpoint").val(point);
                    //modify description
                    if ($('input[name="bogo_type"]:checked').val() == 'bogo_yes') {
                        //    console.log($("input[name=discount_type]:checked").val());
                        console.log($('#discountamnt').val());
                        if ($("input[name=discount_type]:checked").val() == 'free') {
                            //   console.log('hello');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var trimStr = $.trim('BUY ONE '+item+' and get ONE FREE');
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text(trimStr);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                            // console.log('hello');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text('BUY ONE '+item+' and get '+$('#discountamnt')
                                        .val()+'% OFF');
                                    var original = $("#originalPrc").val();
                                    var y = 0.25;
                                    var z = 100;
                                    var discount = $("#discountamnt").val();
                                    var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                    // $('.calculationpoint').css('display', 'block');
                                    $('.pointtext').html(point + ' Points');
                                    $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                    $("#discountpoint").val(point);
                                } else {
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please enter discount percentage');
                                }
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var original = $("#originalPrc").val();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text('BUY ONE '+item+' and get $'+$('#discountamnt')
                                        .val()+' OFF');
                                    var y = 0.25;
                                    var discount = $("#discountamnt").val();
                                    var point = Math.ceil(parseInt(discount / y));
                                    // $('.calculationpoint').css('display', 'block');
                                    $('.pointtext').html(point + ' Points');
                                    $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                    $("#discountpoint").val(point);
                                } else {
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please enter discount amount');
                                }
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        }

                    }else{
                          console.log($('#discountamnt').val());
                          if ($("input[name=discount_type]:checked").val() == 'free') {
                            //   console.log('hello');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var trimStr = $.trim('FREE '+item);
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text(trimStr);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                            // console.log('hello');
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text($('#discountamnt').val()+'% OFF '+item);
                                    var original = $("#originalPrc").val();
                                    var y = 0.25;
                                    var z = 100;
                                    var discount = $("#discountamnt").val();
                                    var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                    // $('.calculationpoint').css('display', 'block');
                                    $('.pointtext').html(point + ' Points');
                                    $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                    $("#discountpoint").val(point);
                                } else {
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please enter discount percentage');
                                }
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                            if ($('#itemid option:selected').text() != '') {
                                var item = $('#itemid option:selected').text().trim();
                                var original = $("#originalPrc").val();
                                if ($('#discountamnt').val() != '') {
                                    $('#descriptiontext').text('');
                                    $('#descriptiontext').text('$'+$('#discountamnt').val()+' OFF '+item);
                                    var y = 0.25;
                                    var discount = $("#discountamnt").val();
                                    var point = Math.ceil(parseInt(discount / y));
                                    // $('.calculationpoint').css('display', 'block');
                                    $('.pointtext').html(point + ' Points');
                                    $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                    $("#discountpoint").val(point);
                                } else {
                                    $("#descriptionError").html(' ');
                                    $("#descriptionError").html('Please enter discount amount');
                                }
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please select Item or service first');
                            }
                        }
                          
                    }
                } else {
                    $("#discountpoint").val('');
                    $('#descriptiontext').text('');
                    $('.calculationpoint').css('display', 'none');
                }

                if(($('#itemid').val() != '') && ($("#originalPrc").val() != '') && ($('input[name=discount_type]:checked').val() != '') && ($('input[name=bogo_type]:checked').val() != '') && ($('#discountamnt').val() != '')){
                    console.log('123');
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
                    //    console.log($("input[name=discount_type]:checked").val());
                    console.log($('#discountamnt').val());
                    if ($("input[name=discount_type]:checked").val() == 'free') {
                        //   console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim('BUY ONE ' +item+ ' and get ONE FREE');
                            $('#descriptiontext').text('');
                            $('#descriptiontext').text(trimStr);
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                        // console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text('BUY ONE ' + item + ' and get ' + $('#discountamnt')
                                    .val() + '% OFF');
                                var original = $("#originalPrc").val();
                                var y = 0.25;
                                var z = 100;
                                var discount = $("#discountamnt").val();
                                var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                // $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                $("#discountpoint").val(point);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please enter discount percentage');
                            }
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text('BUY ONE ' + item + ' and get $' + $('#discountamnt')
                                    .val() + ' OFF');
                                var y = 0.25;
                                var discount = $("#discountamnt").val();
                                var point = Math.ceil(parseInt(discount / y));
                                // $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $('.basedprice').html('( Based on original sales price of $' + $("#originalPrc").val() + ')');
                                $("#discountpoint").val(point);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please enter discount amount');
                            }
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
                        }
                    }

                }
                else{
                    if ($("input[name=discount_type]:checked").val() == 'free') {
                        //   console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            var trimStr = $.trim('FREE ' +item);
                            $('#descriptiontext').text('');
                            $('#descriptiontext').text(trimStr);
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'percentage') {
                        // console.log('hello');
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text($('#discountamnt').val()+'% OFF '+item);
                                var original = $("#originalPrc").val();
                                var y = 0.25;
                                var z = 100;
                                var discount = $("#discountamnt").val();
                                var point = Math.ceil(parseInt(((discount/z)*original) / y));
                                // $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $('.basedprice').html('( Based on original sales price of $' + original + ')');
                                $("#discountpoint").val(point);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please enter discount percentage');
                            }
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
                        }
                    } else if ($("input[name=discount_type]:checked").val() == 'discount') {
                        if ($('#itemid option:selected').text() != '') {
                            var item = $('#itemid option:selected').text().trim();
                            if ($('#discountamnt').val() != '') {
                                $('#descriptiontext').text('');
                                $('#descriptiontext').text('$'+$('#discountamnt').val()+' OFF '+item);
                                var y = 0.25;
                                var discount = $("#discountamnt").val();
                                var point = Math.ceil(parseInt(discount / y));
                                // $('.calculationpoint').css('display', 'block');
                                $('.pointtext').html(point + ' Points');
                                $('.basedprice').html('( Based on original sales price of $' + $("#originalPrc").val() + ')');
                                $("#discountpoint").val(point);
                            } else {
                                $("#descriptionError").html(' ');
                                $("#descriptionError").html('Please enter discount amount');
                            }
                        } else {
                            $("#descriptionError").html(' ');
                            $("#descriptionError").html('Please select Item or service first');
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
