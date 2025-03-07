<x-layouts.provider-layout title="provider account">
    @push('style')
    <style>
        .errorMsq {
            color: red !important;
            display: block;
        }
    </style>
    @endpush


    @livewire('frontend.property-manager.consumer-profile', ['guestid' => $id])
    


    <div class="modal fade memberAddModal" id="memberAddModal" tabindex="-1"
        aria-labelledby="memberAddModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 20px;">
                <div class="modal-body">
                    <div class="we-want-con main-form" style="display:block;">
                        <div class="text-center mt-4 mb-4 popup-logo">
                            
                        </div>
                        <p class="by-continue-text">Please enter The New Member information below</p>
                        <form id="member_registration">
                            <div class="row we-want-text1">
                                <div class="col-sm-6" style="margin-top: 18px;">
                                    First Name
                                </div>
                                <div class="col-sm-6">
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
    </div>

   

    
    
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
