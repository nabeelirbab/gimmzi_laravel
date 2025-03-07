<x-layouts.travel-tourism-layout title="provider account">
    @push('style')
    <style>
        .errorMsq {
            color: red !important;
            display: block;
        }
    </style>
    @endpush
    {{-- <div id="property-manage-search">
        <div class="property-manage-search">
            <div class="container">
                <h2>Search Smart Rental Database</h2>
                <div class="propert-search-main">
                    <input type="text" class="search-input"
                        placeholder="Search tenant using first name, last name or unit number" />
                    <button class="search-button"></button>
                </div>
            </div>
        </div>
    </div> --}}

    @livewire('frontend.travel-tourism.short-term-rental.consumer-profile', ['guestid' => $id])



   

    
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    
    <script>
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

            $(document).on('click', '#deactive_member', function() {
                $("#deactiveModal").modal('show');
            });

            $(document).on('click','#add_member', function() {
                $("#memberAddModal").modal('show');
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
                    var url = window.location.pathname;
                    var conunitid = url.substring(url.lastIndexOf('/') + 1);
                    //console.log(conunitid);
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
                            conunit_id: conunitid,
                            flag: 'consumer_unit',
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
                                $('#linksentmessage').css('color','red').fadeIn().html('Registration link not sent successfully to given email address');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                       // location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 2){
                                $('#linksentmessage').css('color','green').fadeIn().html('Registration link sent successfully to given email address');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                        //location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 3){
                                $('#linksentmessage').css('color','green').fadeIn().html('Registration link sent successfully to given phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                       // location.reload();
                                }, 3000 );
                            }
                            else if(result.status == 4){
                                $('#linksentmessage').css('color','red').fadeIn().html('Please give correct phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                }, 3000 );
                            }
                            else if(result.status == 9){
                                $('#linksentmessage').css('color','red').fadeIn().html('Please give correct phone number');
                                setTimeout(function() {
                                    $('#linksentmessage').fadeOut("slow");
                                }, 3000 );
                            }
                        }
                    });
                });

               

               
               

               
            }); 

    </script>
    @endpush

</x-layouts.provider-layout>
