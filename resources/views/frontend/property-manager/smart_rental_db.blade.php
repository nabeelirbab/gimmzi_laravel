<x-layouts.provider-layout title="provider account">
    @push('style')
    <style>
        .errorMsq {
            color: red !important;
            display: block;
        }
    </style>
    @endpush

    <livewire:frontend.property-manager.smart-rental-database />


    

        
        
 
    {{-- <div class="modal fade points_add_modal" id="addPoint" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <h6 id="heading">Points Added!</h6>
                        <p id="pointModalmessage"></p>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade points_add_modal" id="errorModal" tabindex="-1" aria-labelledby="errorModallLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <span id="error_msg"></span>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade deactivate_modal_1" id="deactiveModal" tabindex="-1"
        aria-labelledby="deactiveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom pb-3">
                        <h6>Are You Sure you Want To Deactivate this Member?</h6>
                        <p id="deactivetitle"> </p>
                        <p id="deactiveunit"></p>
                    </div>
                    <div class="d-flex justify-content-between mt-5 allen-park-apartments-button">
                        <button type="button" class="btn next_btn deactive_account">
                            yes, deactivate Account
                        </button>
                        <button type="button" class="btn next_btn next_btn_2 multiple_deactivate">
                            Deactivate multiple members in this unit
                        </button>
                        <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade points_add_modal deactivate_modal_3" id="deactiveMsg" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        <h6>Account Deactivated</h6>
                        <p class="mb-0 unitopen"></p>
                        <div class="margin_for">
                            <a href="#" class="sendunit"></a>
                        </div>
                    </div>
                    <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade deactivate_modal_2 deactivate_modal_1" id="multipleusers" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form>
                        <div class="border_bottom">
                            <label class="container_check">
                                <input type="checkbox" checked="checked" class="allchecked" />
                                <span class="checkmark"></span>Select All
                            </label>
                        </div>
                        <div class="border_bottom margin_cls">
                            <div class="container">
                                <div class="row" id="consumerList">

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-5">
                            <button type="button" class="btn next_btn next_btn_2 multiple_user_deactivate">
                                Deactivate multiple members in this unit
                            </button>
                            <button type="button" class="btn close_btn" data-bs-dismiss="modal" aria-label="Close">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade memberAddModal" id="memberAddModal" tabindex="-1"
        aria-labelledby="memberAddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-body">
                    <div class="we-want-con main-form" style="display:block;">
                        <div class="text-center mt-4 mb-4 popup-logo">
                            
                        </div>
                        <p class="by-continue-text">Please enter The New Member information below</p>
                        <form id="member_registration" name="member_registration" method= "post">
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    First Name
                                </div>
                                <div class="col-sm-6" >
                                    <input type="text" class="input-box-one" name = "first_name" id = "first_name" placeholder="" onKeyPress="return ValidateAlpha(event);"/>
                                </div>
        
                            </div>
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    Last Name
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="input-box-one" name = "last_name" id = "last_name" placeholder="" onKeyPress="return ValidateAlpha(event);"/>
                                </div>
        
                            </div>
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    Email <input type="radio" name="sent_by" id="sent_by" value="email"/> &nbsp; &nbsp; Phone <input type="radio" id="sent_by" name="sent_by" value="phone"/>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="input-box-one" name="link_Sent_on" id="link_Sent_on" placeholder="" />
                                </div>
                            </div>
                            <input type="hidden" name="unit_id" id = "unit_id">
                            <span id="linksentmessage"></span>
                            <br>
                            <div class="row we-want-text1">
                                <div class="col-sm-12 text-center">
                                    <button class="send-button-one4" type="submit">Send invite</button>
                                    <button class="cancel-button44" onclick="location.reload();" type="button">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="message_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="errormsg"></h3>
                    </div>

                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd"  onclick="window.location.reload();">ok</button>    
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div> --}}

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script>
            var from_data = {}
            var base_url = window.location.origin;
            $('#link_Sent_on').keyup(function(){
                if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                    $(this).val($(this).val().replace(/(\d{3})\-?(\d{3})\-?(\d{4})/,'$1-$2-$3'))
                }
            });
            
            function ValidateAlpha(evt)
            {
                var keyCode = (evt.which) ? evt.which : evt.keyCode
                if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
                
                return false;
                    return true;
            }
            $.validator.addMethod('customphone', function (value, element) {
                    return this.optional(element) || /^(\+91-|\+91|0)?\d{10}$/.test(value);
            }, "Please enter a valid phone number");

            $(document).on('click', '#property_provider', function() {
                var value = 'default';
                var value1 = $(this).attr('data-property_id');

                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1;

                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        console.log(data);
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
                            ' Points')
                    }
                });

            });

            $(document).on('change', '.change_list', function() {

                var value = $(this).attr('value');
                var value1 = $('#property_id').val();
                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1;
                $('.add_point').prop('disabled', true);
                $('.deactive').prop('disabled', true);
                $('.add_term').prop('disabled', true);
                $('.view_profile').prop('disabled', true);
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        console.log(data);
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
                            ' Points')
                    }
                });

            });

            function get_render_html(from_data) {
                let ajaxPath = "{{ route('frontend.smart-rental-db') }}";
                console.log(from_data);
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    data: from_data,
                    success: function(data) {
                        console.log(data);
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                    }
                });

            }
            // $(document).ready(function() {
            //     $('#property_provider').change(function (e) {
            //         var id = $(this).attr('data-property_id');
            //         console.log(id)
            //     });
            // });

            $(document).on('change', '.unitCheck', function() {
                var value = $(this).attr('value');
                console.log(value);
                if (value != '') {
                    $('.add_point').prop('disabled', false);
                    $('.deactive').prop('disabled', false);
                    $('.add_term').prop('disabled', false);
                    $('.view_profile').prop('disabled', false);
                } else {
                    $('.add_point').prop('disabled', true);
                    $('.deactive').prop('disabled', true);
                    $('.add_term').prop('disabled', true);
                    $('.view_profile').prop('disabled', true);
                }
            });

            $(document).on('click', '.add_point', function() {
                var unitid = $(".unitCheck:checked").val();
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';

                } else {
                    var checked = 'consumerunit';
                }
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'point';

                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to added point</p>');
                            $("#errorModal").modal('show');

                        } 
                        else if(data.message == 'no_point'){
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is not updated the add point</p>');
                            $("#errorModal").modal('show');
                        }
                        else {
                        $("#error_msg").html('');
                        $("#pointModalmessage").html('Point have been added to this member’s account');
                        $("#addPoint").modal('show');
                    }
                        //console.log(data);
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
                            ' Points')
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);

                    }
                });

            });

            $(document).on('click', '.deactive', function() {
                var unitid = $(".unitCheck:checked").val();
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'is_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }
                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        // console.log(data);
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to deactivate</p>');
                            $("#errorModal").modal('show');

                        } else {
                            $("#error_msg").html('');
                            $("#deactivetitle").html('');
                            $("#deactivetitle").html(
                                '<p>By deactivating this member, it will open a primary slot for ' +
                                data.arrayData.buildingName + ' Unit ' + data.arrayData.unitName +
                                '</p>');
                            $("#deactiveunit").html('');
                            $("#deactiveunit").html('<p>' + data.arrayData.consumer_name +
                                ' will no longer have access to Smart Rentals with ' + data
                                .arrayData.property + '</p>');
                            $("#deactiveModal").modal('show');
                        }
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);
                        if (checked == 'nonConsumerunit') {
                            $("#flexCheckDefaultUnit" + unitid).prop('checked', true);
                            //console.log($("#flexCheckDefaultUnit" + unitid).val());
                        } else {
                            $("#flexCheckDefaultCon" + unitid).prop('checked', true);
                            //console.log($("#flexCheckDefaultUnit" + unitid).val());
                        }

                    }
                });
            });


            $(document).on('click', '.deactive_account', function() {
                var unitid = $(".unitCheck:checked").val();
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'single_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }

                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        console.log(data);
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to deactivate</p>');
                            $("#errorModal").modal('show');

                        } else {
                            $("#error_msg").html('');
                            $("#deactiveModal").modal('hide');
                            $("#deactiveMsg").modal('show');
                        }
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);

                    }
                });

            })

            $(document).on('click', '.multiple_deactivate', function() {
                var unitid = $(".unitCheck:checked").val();
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'multiple_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }

                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        console.log(data);
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to deactivate</p>');
                            $("#errorModal").modal('show');

                        } else {
                            $("#error_msg").html('');
                            $("#multiple_deactivate").modal('hide');
                            $("#multipleusers").modal('show');
                            $('#consumerList').html('');
                            for (i = 0; i < data.consumers.length; i++) {
                                let namediv = '<div class="col-lg-4 my-2">' +
                                    '<label class="container_check">' +
                                    '<input type="checkbox" class="consumername" checked = "checked" name="consumer_id" value="' +
                                    data.consumers[i].consumer_unit_id + '" id="consumerunit' + data
                                    .consumers[i].consumer_unit_id + '"/>' +
                                    '<span class="checkmark"></span>' + data.consumers[i].name +
                                    '</label>' +
                                    '</div>';
                                $('#consumerList').append(namediv);
                            }

                        }
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);
                        $("#deactiveModal").modal('hide');
                        if (checked == 'nonConsumerunit') {
                            $("#flexCheckDefaultUnit" + unitid).prop('checked', true);
                            console.log($("#flexCheckDefaultUnit" + unitid).val());
                        } else {
                            $("#flexCheckDefaultCon" + unitid).prop('checked', true);
                            console.log($("#flexCheckDefaultUnit" + unitid).val());
                        }
                    }
                });
            });

            $(".multiple_user_deactivate").click(function() {
                var unitid = $(".unitCheck:checked").val();
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'multiple_user_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }
                var yourArray = [];
                var conarray = [];
                $("input:checkbox[name=consumer_id]:checked").each(function() {
                    yourArray.push($(this).val());
                });
                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked + "&conarray=" + yourArray;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        console.log(data);
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>Please select a consumer to deactivate</p>');
                            $("#errorModal").modal('show');

                        } else {
                            $("#error_msg").html('');
                            $("#multiple_deactivate").modal('hide');
                            $("#multipleusers").modal('hide');
                            $(".unitopen").html(data.arrayData + ' Is now Open');
                            $(".sendunit").html(' Send new user registration link for ' + data.arrayData);
                            $("#deactiveMsg").modal('show');
                        }
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);
                        $("#deactiveModal").modal('hide');

                    }
                });


            })


            $(".allchecked").change(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            $(document).on('click','.add_user_modal', function() {
                $("#memberAddModal").modal('show');
                console.log($(this).attr('id'));
                $("#unit_id").val($(this).attr('id'));
            });

            $(document).on('click','.add_term',function(){
                
                var unitid = $(".unitCheck:checked").val();
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';

                } else {
                    var checked = 'consumerunit';
                }
                var value = $(".change_list:checked").val();
                var value1 = $('#property_id').val();
                var text = 'add_term';
                let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1 +
                    "&unit=" + unitid + "&text=" + text + "&checked=" + checked;
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    success: function(data) {
                        if (data.message == 'error') {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to added point</p>');
                            $("#errorModal").modal('show');

                        } 
                        else if(data.message == 'no_term'){
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is not updated the term limit</p>');
                            $("#errorModal").modal('show');
                        }
                        else {
                            $("#error_msg").html('');
                            $("#pointModalmessage").html(' ');
                            $("#heading").html(' ');
                            $("#pointModalmessage").html('Term have been added to this member’s account');
                            $("#heading").html('Term Added!');
                            $("#addPoint").modal('show');
                        }
                        //console.log(data);
                        $('#change_first').text(data.propertyDetails.name)
                        $('#property_address').text(data.propertyDetails.address)
                        $('#property_id').val(data.propertyDetails.id)
                        $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
                            ' Points')
                        $('#ajaxrentaldbtable').html(data.html);
                        $('.add_point').prop('disabled', true);
                        $('.deactive').prop('disabled', true);
                        $('.add_term').prop('disabled', true);
                        $('.view_profile').prop('disabled', true);

                    }
                });
            })
           


            $(document).ready(function() {
                $("#viewprofile").click(function() {
                    var unitid = $(".unitCheck:checked").val();
                    // console.log(unitid);
                    var unit = $(".unitCheck:checked").attr('id');
                    if (unit == 'flexCheckDefaultUnit' + unitid) {
                        var checked = 'nonConsumerunit';
                    } else {
                        var checked = 'consumerunit';
                    }
                    $.ajax({
                        type: 'GET',
                        url: '/check-consumer-profile',
                        data: {
                            'unitid': unitid,
                        },
                        success: function(response) {
                            if (response.success == 1) {
                                window.location = response.redirect_url+'/'+response.data.id;
                            } else {
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to View Profile</p>');
                            $("#errorModal").modal('show');
                            }
                        }
                    });

                });
            });

            $(document).ready(function() {
                $("#member_registration").validate({
                    rules: {
                        first_name: {
                            required: true,
                        },
                        last_name: {
                            required: true,
                        },
                        sent_by: {
                            required: true,
                        },
                        link_Sent_on: {
                            required: true,
                            email: {
                                depends: function(elem) {
                                    if($("input:radio[name=sent_by]:checked").val() == 'email'){
                                        return true;
                                    }
                                    else{
                                        return false;
                                    }
                                }
                            },
                            // phoneUS:{
                            //     depends: function(elem) {
                            //         if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                            //             return true;
                                        
                            //         }
                            //         else{
                            //             return false;
                            //         }
                            //     }
                            // },
                            // customphone: {
                            //     depends: function(elem) {
                            //         if($("input:radio[name=sent_by]:checked").val() == 'phone'){
                            //             return true;
                                        
                            //         }
                            //         else{
                            //             return false;
                            //         }
                            //     }
                            // },
                            
                              
                        },
                    },
                    messages: {
                        first_name: {
                            required: " Please enter your first name ",
                        },
                        last_name: {
                            required: " Please enter your last name ",
                        },
                        sent_by: {
                            required: " Please check any checkbox ",
                        },
                        link_Sent_on: {
                            required: 'Please enter your email id or phone',
                            email: 'Please give a valid email address',
                            
                        },
                    },
                    errorPlacement: function(label, element) {
                        label.addClass('errorMsq');
                        element.parent().append(label);
                    },
                });

                $("#member_registration").submit(function(e) {
                    e.preventDefault();
                    console.log($("#unit_id").val());

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('frontend.property.consumer.send-registration-link') }}",
                        type: 'POST',
                        data: {
                            first_name: $("#first_name").val(),
                            last_name: $("#last_name").val(),
                            sent_by: $("input:radio[name=sent_by]:checked").val(),
                            link_Sent_on: $("#link_Sent_on").val(),
                            unit_id:  $("#unit_id").val(),
                            flag: 'unit',
                        },
                        success: function(result) {
                            console.log(result);
                            if(result.status == 0){
                                $('#linksentmessage').css('color','red').fadeIn().html('Something went wrong');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                        //location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 1){
                                $("#memberAddModal").modal('hide');
                                $("#errormsg").html('Registration link not sent successfully to given email address');
                                $("#message_modal").modal('show');
                            }
                            else if(result.status == 2){
                                $("#memberAddModal").modal('hide');
                                $("#errormsg").html('Registration link sent successfully to given email address');
                                $("#message_modal").modal('show');
                            }
                            else if(result.status == 3){
                                $("#memberAddModal").modal('hide');
                                $("#errormsg").html('Registration link sent successfully to given phone number');
                                $("#message_modal").modal('show');
                            }
                            else if(result.status == 4){
                                
                                $("#memberAddModal").modal('hide');
                                $("#errormsg").html('Please give correct phone number');
                                $("#message_modal").modal('show');
                            }
                            else if(result.status == 9){
                                
                                $("#memberAddModal").modal('hide');
                                $("#errormsg").html('Please give correct phone number');
                                $("#message_modal").modal('show');
                            }
                        }
                    });
                });
            }); 
        </script>
    @endpush
</x-layouts.provider-layout>
