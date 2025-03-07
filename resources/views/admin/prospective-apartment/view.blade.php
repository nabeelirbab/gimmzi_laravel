<x-admin-layout title="Support Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Prospective Providers List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('prospective-apartment.index') }}"
                    value="Prospective Providers list" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="" value="View Prospective Providers" />
            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
                <button class="btn btn-brand btn-elevate btn-icon-sm noteAddSave">
                    Add Notes
                </button>
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <style>
        .comments-sec {
            font-size: 15px;
            -webkit-box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
            box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
            background: #fff;
            padding: 13px 25px;
        }

        .comments-sec h2 {
            color: #ef156de6;
            font-weight: 700;
            font-size: 20px;
            line-height: 30px;
        }

        .comments-sec p {
            margin: 10px 0 10px 50px;
        }

        .divider-sec {
            background: #e7e7e7;
            padding: 20px;
            margin: 0 0 40px 0;
        }

        .divider-sec img {
            -webkit-box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
            box-shadow: 0px 0px 13px 0px rgb(82 63 105 / 5%);
            background: #fff;
            padding: 10px;
        }

        .divider-sec h3 {
            border-bottom: #d2d2d2 1px solid;
        }



        a.btn.btn-secondary:hover {
            background: #666 !important;
            color: #fff !important;
        }
    </style>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3>Prospective Providers </h3>


                        </div>
                    </div>
                    <form action="">
                        <div class="kt-portlet__body">
                            <div class="row divider-sec">

                                <div class="form-group col-lg-12">
                                    <h3
                                        style="font-size: 15px;padding-bottom: 11px; color:black;display: flex;flex-wrap: wrap; align-items: center; justify-content: space-between;">
                                        Apartment name: <span class="right_title">Status: @if ($prospective_apartment->status == 1)
                                                Listed
                                            @else
                                                Unlisted
                                            @endif
                                        </span></h3>
                                    <p style="padding-top: 21px;font-size: 15px;" id="apartment_name_id">
                                        {{ $prospective_apartment->apartment_name }}</p>
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->apartment_name }}" id="apartment_name">
                                </div>

                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">City</h3>
                                    <p style="padding-top: 21px;font-size: 15px;" id="apartment_city">
                                        {{ $prospective_apartment->city }}</p>
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->city }}" id="city_name">

                                </div>
                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">State:</h3>
                                    <p style="padding-top: 21px;font-size: 15px;" id="apartment_state">
                                        {{ $prospective_apartment->state->name }}</p>
                                    <select class="form-control" id="state_id">
                                        @foreach ($stateList as $states)
                                            <option value="{{ $states->id }}"<?php if ($prospective_apartment->state_id == $states->id) {
                                                echo 'selected';
                                            } ?>>{{ $states->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Zip Code</h3>
                                    <p style="padding-top: 21px;font-size: 15px;" id="apartment_zipcode">
                                        {{ $prospective_apartment->zip_code }}</p>
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->zip_code }}" id="zip_code">
                                    <span id="ziperror"></span>
                                </div>


                                {{-- <div class="form-group col-lg-3">
                                <a href="Javascript:void(0);" data-toggle="modal" data-target="#add_contact_modal" class="short_link">Add Contact Name</a>
                                <a href="Javascript:void(0);" class="short_link" data-toggle="modal" data-target="#add_email_modal" >Add Email</a>
                                <a href="Javascript:void(0);" class="short_link" data-toggle="modal" data-target="#add_phone_modal" >Add Phone Number</a>
                            </div>  --}}
                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Contact Name</h3>
                                    @if ($prospective_apartment->contact_name != null)
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_name">
                                            {{ $prospective_apartment->contact_name }}</p>
                                    @else
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_name"></p>
                                    @endif
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->contact_name }}" id="contact_name">
                                    <span id="contactnameerror"></span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Contact Email</h3>
                                    @if ($prospective_apartment->contact_email != null)
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_email">
                                            {{ $prospective_apartment->contact_email }}</p>
                                    @else
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_email"></p>
                                    @endif
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->contact_email }}" id="contact_email">
                                    <span id="contactemailerror"></span>
                                </div>
                                <div class="form-group col-lg-4">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Contact Phone</h3>
                                    @if ($prospective_apartment->contact_phone != null)
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_phone">
                                            {{ $prospective_apartment->contact_phone }}</p>
                                    @else
                                        <p style="padding-top: 21px;font-size: 15px;" id="apartment_contact_phone"></p>
                                    @endif
                                    <input type="hidden" class="form-control"
                                        value="{{ $prospective_apartment->contact_phone }}" id="contact_phone">
                                    <span id="contactphoneerror"></span>
                                </div>

                                <div class="form-group col-lg-6">
                                    <div class="left-control">
                                        <label>Action Taken</label>
                                        <select class="wra_select" id="action" disabled>
                                            <option value="">Please Choose</option>
                                            <option value="Phone Call">Phone Call</option>
                                            <option value="Email Sent">Email Sent</option>
                                            <option value="Site Visited">Site Visited</option>
                                            <option value="Planned Site Visit">Planned Site Visit</option>
                                            <option value="Added to Network">Added to Network</option>
                                            <option value="Unlist Provider">Unlist Provider</option>
                                            <option value="Relist">Relist</option>
                                        </select>
                                        <span id="actionError"></span>

                                        <div class="lbl_texxtarea">
                                            <label>Notes</label>
                                            <textarea type="message" id="note" disabled></textarea>
                                            <input type="hidden" value="{{ $prospective_apartment->id }}"
                                                id="prospective_id" name="prospective_id">
                                            <span id="noteError"></span>
                                            <div class="check_sec">
                                                <input type="checkbox" id="check" class="check" name="notify_user"
                                                    disabled>
                                                <label for="check">
                                                    Notify All customer that requested this provider if Added to Network
                                                </label>
                                            </div>
                                            <span id="notifyError"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <div class="data_record">
                                        <h4>Recorded Notes:</h4>
                                        <div class="res_table">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        {{-- <th>User</th> --}}
                                                        <th>Action Taken</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php $createdate = ''; ?>
                                                    @if (count($getprovider->propertyNote) > 0)
                                                        @foreach ($getprovider->propertyNote as $propertynotes)
                                                            <?php $date = date_create($propertynotes->created_at);
                                                            $createdate = date_format($date, 'm/d/Y'); ?>

                                                            <tr>
                                                                <td>{{ $createdate }}</td>
                                                                {{-- <td>{{$propertynotes->user->full_name}}</td> --}}
                                                                <td>{{ $propertynotes->action_taken }}</td>
                                                                <td><a class="btn btn-info view_note"
                                                                        style="color: #fff !important; cursor: pointer;"
                                                                        data-id="{{ $propertynotes->id }}" >View</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td>No note is there</td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Consumer User:</h3>

                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($getprovider->prospectiveApartmentUser as $apartmentuser)
                                        <p style="padding-top: 21px;font-size: 15px;">{{ $i }}.
                                            {{ $apartmentuser->user->full_name }}</p>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                </div>

                                <div class="form-group col-lg-6">
                                    <h3 style="font-size: 15px;padding-bottom: 11px; color:black;">Property Management
                                        name:</h3>
                                    @foreach ($getprovider->prospectiveApartmentUser as $propertyuser)
                                        @if ($getprovider->property_management_name != null)
                                            <p style="padding-top: 21px;font-size: 15px;">
                                                {{ $getprovider->property_management_name }}</p>
                                        @else
                                            <p style="padding-top: 21px;font-size: 15px;">--</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-lg-12">
                                    <div class="sec_footer_text_end">
                                        @if ($createdate != '')
                                            <p class="right_title">last Updated: {{ $createdate }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="kt-form__actions" id="submitbutton">
                                <a href="{{ route('prospective-apartment.index') }}"
                                    class="btn btn-secondary">Back</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact Modal -->



    @push('scripts')
        <script>
            $("#state_id").hide();
            $(document).ready(function() {
                $(".noteAddSave").on('click', function() {
                    //console.log($(this).text().trim());
                    if ($(this).text().trim() == 'Add Notes') {
                        $(this).text('');
                        $(this).text('Save Notes');
                        $('#action').prop('disabled', false);
                        $('#note').prop('disabled', false);
                        $('input[name="notify_user"]').prop('disabled', false);
                        $("#apartment_zipcode").hide();
                        $("#apartment_state").hide();
                        $("#zip_code").attr('type', 'text');
                        $("#state_id").show();
                        $("#apartment_name").attr('type', 'text');
                        $("#city_name").attr('type', 'text');
                        $("#apartment_city").hide();
                        $("#apartment_name_id").hide();
                        $("#apartment_contact_name").hide();
                        $("#contact_name").attr('type', 'text');
                        $("#apartment_contact_email").hide();
                        $("#contact_email").attr('type', 'text');
                        $("#apartment_contact_phone").hide();
                        $("#contact_phone").attr('type', 'text');

                    } else if ($(this).text().trim() == 'Save Notes') {
                        if ($('input[name="notify_user"]').is(':checked')) {
                            var notify_user = true;
                        } else {
                            var notify_user = false;
                        }

                        console.log(notify_user);
                        $.ajax({
                            url: "{{ route('admin.prospective-apartment.add-note') }}",
                            type: 'get',
                            data: {
                                'action': $("#action").val(),
                                'notify_user': notify_user,
                                'city_name': $("#city_name").val(),
                                'state_id': $("#state_id").val(),
                                'zip_code': $("#zip_code").val(),
                                'note': $("#note").val(),
                                'apartment_name': $("#apartment_name").val(),
                                'prospective_id': $("#prospective_id").val(),
                                'contact_name': $("#contact_name").val(),
                                'contact_email': $("#contact_email").val(),
                                'contact_phone': $("#contact_phone").val(),
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.status == 4) {
                                    $("#actionError").html('');
                                    $("#notifyError").html('');
                                    $("#noteError").html('');
                                    setTimeout(() => {
                                        toastr.error(
                                            'Note added successfully');
                                    }, 500)
                                    location.reload();
                                } else if (result.status == 2) {
                                    $("#actionError").html('');
                                    $("#notifyError").html('');
                                    $("#noteError").html('');
                                    setTimeout(() => {
                                        toastr.error(
                                            'Note added successfully');
                                    }, 500)
                                    location.reload();
                                    // $("#notifyError").html('');
                                    // $("#noteError").html('');
                                    // $("#actionError").html('Please choose at least one action').css('color','red');
                                } else if (result.status == 3) {
                                    $("#actionError").html('');
                                    $("#notifyError").html('');
                                    $("#noteError").html('The Note field is required').css('color',
                                        'red');
                                } else if (result.status == 1) {
                                    $("#actionError").html('');
                                    $("#noteError").html('');
                                    $("#notifyError").html('Please check the checkbox').css('color',
                                        'red');
                                } else if (result.status == 5){
                                    $("#contactemailerror").html(result.validation_errors).css('color', 'red');
                                } else if (result.status == 6){
                                    $("#contactphoneerror").html(result.validation_errors).css('color', 'red');
                                }
                            }
                        });

                    }
                });


                $(".view_note").on('click', function() {
                    var note_id = $(this).data('id');
                    $.ajax({
                        url: "{{ route('admin.prospective-apartment.view-note') }}",
                        type: 'get',
                        data: {
                            note_id: note_id,
                        },
                        success: function(result) {
                            if (result.status == 1) {
                                console.log(result.data.action_taken);
                                $('#action').prop('disabled', false);
                                $('option:selected').removeAttr("selected");
                                $('#action').val("");
                                $('#note').prop('disabled', false);
                                $('input[name="notify_user"]').prop('disabled', false);
                                $('#action option[value="' + result.data.action_taken + '"]').attr(
                                    "selected", "selected");
                                $('#note').html(result.data.note);
                                if (result.data.notify_user == true) {
                                    $('.check').prop('checked', true);
                                } else {
                                    $('.check').prop('checked', false);
                                }
                            }
                        }
                    });
                });


                $("#zip_code").on('keyup', function() {
                    var zipcode = $(this).val();
                    if (zipcode.length == 5) {
                        $.ajax({
                            url: "{{ route('get.city') }}",
                            type: 'get',
                            data: {
                                'zipcode': zipcode
                            },
                            success: function(result) {
                                //console.log(result.data);
                                if (result.success == 1) {
                                    $("#city_name").val(result.data.City);
                                    $("#ziperror").html('');
                                    $("#state_id").val(result.state_name);

                                } else {
                                    $("#ziperror").html(result.data[0]);
                                    $("#ziperror").css('color', 'red');
                                }

                            }
                        });
                    } else {
                        $("#city").val('');
                        $("#state").val('');
                    }

                });

            });
        </script>
    @endpush
</x-admin-layout>
