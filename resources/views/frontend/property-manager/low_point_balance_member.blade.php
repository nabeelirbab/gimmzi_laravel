<x-layouts.provider-layout title="provider account">
    @push('style')
    <style>
        .errorMsq {
            color: red !important;
            display: block;
        }
    </style>
    @endpush

    <livewire:frontend.property-manager.low-point-member />
 

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

                var value1 = $(this).attr('data-property_id');

                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1;

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

            $(document).on('click', '.point_status',function() {
                var status = $(this).val();
                var value1 = $('#property_provider').attr('data-property_id');
                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1 + "&status=" +status;
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

            // $(document).on('change', '.change_list', function() {

            //     var value = $(this).attr('value');
            //     var value1 = $('#property_id').val();
            //     let ajaxPath = base_url + "/smart-rental-db" + "?radiochangelist=" + value + "&id=" + value1;
            //     $('.add_point').prop('disabled', true);
            //     $('.deactive').prop('disabled', true);
            //     $('.add_term').prop('disabled', true);
            //     $('.view_profile').prop('disabled', true);
            //     $.ajax({
            //         type: 'GET',
            //         url: ajaxPath,
            //         success: function(data) {
            //             console.log(data);
            //             $('#change_first').text(data.propertyDetails.name)
            //             $('#property_address').text(data.propertyDetails.address)
            //             $('#property_id').val(data.propertyDetails.id)
            //             $('#ajaxrentaldbtable').html(data.html);
            //             $('#distributePoint').text(addCommas(data.propertyDetails.points_to_distribute) +
            //                 ' Points')
            //         }
            //     });

            // });

            function get_render_html(from_data) {
                let ajaxPath = "{{ route('frontend.low-point-balance-member') }}";
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
                var value1 = $('#property_id').val();
                var text = 'point';

                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1 +
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
                var value1 = $('#property_id').val();
                var text = 'is_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }
                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1 +
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
                var value1 = $('#property_id').val();
                var text = 'single_deactivate';
                var unit = $(".unitCheck:checked").attr('id');
                if (unit == 'flexCheckDefaultUnit' + unitid) {
                    var checked = 'nonConsumerunit';
                } else {
                    var checked = 'consumerunit';
                }

                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1 +
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
                var value1 = $('#property_id').val();
                var text = 'add_term';
                let ajaxPath = base_url + "/low-point-balance-member" + "?id=" + value1 +
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
                        console.log(data);
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

            $(document).on('click','.extraPointAdd',function(){
                
                $("#pointaddmsg").text(' ');
                $("#pointadded").val('');
                $(".point_added").text(' ');
                $(".total_member").text(' ');
                var membercount = $(".low_balance_member").length;
                if(membercount > 0){
                    $("#pointaddmessage_modal").modal('show');
                    if($(this).attr('value') == '200'){
                        var t1 = "Are you sure you would like to ";
                        t1 += '<span style="font-weight: 800;">Add 200 points</span>';
                        t1 += " to each of these members?";
                        var point = addCommas(membercount*200);
                        $("#pointaddmsg").append(t1);
                        $(".total_member").text('Total Members: '+membercount+' members');
                        $(".point_added").text('Total points to be added: '+point+' points');
                        $("#pointadded").val(200);
                    }
                    if($(this).attr('value') == '400'){
                        var t1 = "Are you sure you would like to ";
                        t1 += '<span style="font-weight: 800;">Add 400 points</span>';
                        t1 += " to each of these members?";
                        var point = addCommas(membercount*400);
                        $("#pointaddmsg").append(t1);
                        $(".total_member").text('Total Members: '+membercount+' members');
                        $(".point_added").text('Total points to be added: '+point+' points');
                        $("#pointadded").val(400);
                    }
                }
                else{
                    $("#message_modal").modal('show');
                    $("#errormsg").text('There is no member');
                }
                
            });

            $(document).on('click','.yes_add_point',function(){
                $("#pointaddmessage_modal").modal('hide');
                var point = $("#pointadded").val();
                $.ajax({
                    type: 'GET',
                    url: '{{route("frontend.add-extra-point-member")}}',
                    data:{'point':point, 'property_id':$('#property_id').val()},
                    success: function(data) {
                        console.log(data);
                        if(data.status == 0){
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>Low point balance limit is not updated</p>');
                            $("#errorModal").modal('show');
                        }
                        else if(data.status == 1){
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no consumer to add point</p>');
                            $("#errorModal").modal('show');
                        }
                        else if(data.status == 2){
                            $("#error_msg").html('');
                            $("#error_msg").html('<p>There is no low point balance consumer to add point</p>');
                            $("#errorModal").modal('show');
                        }
                        else{
                            $("#errormsg").html('');
                            $("#errormsg").html('<p>Points successfully added to members profiles</p>');
                            $("#message_modal").modal('show');
                        }
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


        </script>
    @endpush
</x-layouts.provider-layout>
