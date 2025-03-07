<x-layouts.frontend-layout title="Business Owners Create Deal Page">
    <div class="wizard-body">
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
                                        <div class="green_tick grey_circle margin-right">
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
                <div class="col-md-9">
                    <div class="right_box_section">
                        <div class="heading_sec upload_haed">
                            <h1>Upload Deal Photos</h1>
                        </div>
                        {{-- {{ Form::open(['route' => 'frontend.business_owner.saveDeal.step2', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;', 'files' => true]) }} --}}
                        <form action="" id="image-form" enctype="multipart/form-data">
                            <div class="form-section">

                                <div class="upld_img_sec">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="d-flex flex-wrap">
                                                <div class="file_upload">
                                                    <div>
                                                        <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}"
                                                            alt="img" />
                                                        <h6>Upload Deal Image</h6>
                                                        <small>25 MB Maximum</small>
                                                    </div>
                                                    <div class="show-error">
                                                        <ul></ul>
                                                    </div>
                                                    {{-- <input type="file"/> --}}
                                                    <input type="file" name="deal_image[]" id="photos"
                                                        onchange="preview_photo();" multiple />

                                                    @if ($errors->has('deal_image'))
                                                        <div class="error">{{ $errors->first('deal_image') }}</div>
                                                    @endif
                                                </div>
                                                <input type="hidden" id="main_image_id" name="main_image_id">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="uploaded_file_grp">

                                                @if($maindealimage != NULL)
                                                <img src="{{url($maindealimage)}}"
                                                        class="mainImage" style="height:200px;">
                                                @else
                                                <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}"
                                                        class="mainImage" style="height:200px;">
                                                @endif
                                                <h6>Main Photo</h6>

                                                <div class="up_pht_btn">
                                                    {{-- <button type="submit" id="form-upload-btn">Upload Photo</button> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="upld_file_list_sec">
                                    <div class="lists" id="photo_preview">

                                        @if ($deal != '')
                                            @if ($photos != '')
                                                @foreach ($photos as $key=>$img)
                                                
                                                    <div class="item">
                                                        <div class="inner">
                                                            <img class="dealimage" width="175" height="130"
                                                                src="{{ url($img->getUrl()) }}" data-id = "{{$key}}">
                                                            <div class="btn_grp">
                                                                <a class="dlt_btn removeImage" href="#">Delete</a>
                                                                <a href="javascript:void(0);"
                                                                    class="mkm_pht_btn make_main" href="#">Make
                                                                    Main Photo</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <input type="hidden" name="id" value="{{ $deal->id }}">
                                        @else
                                            <input type="hidden" name="id">
                                        @endif
                                    </div>
                                </div>
                            </div>



                            <div class="skip_sec">
                                <a href="{{ route('frontend.business_owner.createDeal.step3') }}">Skip This Step for
                                    later</a>
                            </div>
                            <div class="btn_section btn_section_two ">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <div>
                                        <a class="btn profile_btn" style="margin-right: 0px"
                                            href="{{ route('frontend.business_owner.createDeal.step1') }}">Back</a>
                                        <button class="btn next_btn nextpage" type="button">Next</button>
                                        <button class="btn profile_btn" style="margin-right:0px" type="submit">Upload Photo</button>
                                    </div>

                                    <h6>Profile Completion :<span>25%</span> </h6>
                                </div>

                            </div>
                        </form>
                        {{-- {{ Form::close() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- remove main deal image -->

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="remove_main_deal_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3>Are you sure you want to delete this photo</h3>
                        </div>
                        <input type="hidden" id="removeid" name="removeid">
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="removeMainImage">Yes</button>
                                <button class="btn_table_s rdd auto_wd" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade cmn_modal_designs gap_sec_modal2" id="img_upload_success_modal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap_modal_cntntr">
                        <div class="cmn_secthd_modals">
                            <h3 id="successmessage">Images have been uploaded successfully</h3>
                        </div>
                        <input type="hidden" id="removeid" name="removeid">
                        <div class="cmn_secthd_modals_btnnn">
                            <div class="btn_foot_end centr">
                                <button class="btn_table_s blu auto_wd" id="closeImgModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function preview_photo() {
                var total_file = document.getElementById("photos").files.length;
                for (var i = 0; i < total_file; i++) {
                    // var li_img = '<li class="imageclass">'+
                    //              '<a href="javascript:void(0);" class="removeImage"><span class="material-symbols-outlined">delete</span></a>'+
                    //              '<img class="dealimage" data-id = "'+i+'" src="'+URL.createObjectURL(event.target.files[i])+'"  alt="" />'+
                    //              '<a href="javascript:void(0);" class="make_main">Make Main Photo</a>'+
                    //              '</li>';
                    var div_list = '<div class="item imageclass">' +
                        '<div class="inner">' +
                        '<img width="175" height="130" class="dealimage" data-id = "' + i + '" src="' + URL.createObjectURL(
                            event.target.files[i]) +
                        '"  alt="" />' +
                        '<div class="btn_grp">' +
                        '<a class="dlt_btn removeImage" href="javascript:void(0);">Delete</a>' +
                        '<a class="mkm_pht_btn make_main" href="javascript:void(0);">Make Main Photo</a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    // $('#photo_preview').append(li_img);
                    $('#photo_preview').append(div_list);
                }
            }

            $(document).on('click', '.make_main', function() {
                // console.log('123');
                const url = $(this).parent().parent().find('img.dealimage').attr('src');
                //    console.log(url);
                $(".mainImage").attr('src', url);
                $("#main_image_id").val($(this).parent().parent().find('img.dealimage').data('id'));
            });

            $(document).on('click', '.removeImage', function() {
                var imgID = $(this).parent().parent().find('.dealimage').data('id');
                //     console.log(imgID);
                //    console.log($("#main_image_id").val());
                if ($("#main_image_id").val() == imgID) {
                    $("#removeid").val($("#main_image_id").val());
                    $("#remove_main_deal_modal").modal('show');
                } else {
                    $(this).parent().parent().parent().remove();
                }
            });

            $(document).on('click', '#removeMainImage', function() {
                $("#main_image_id").val('');
                $(".mainImage").attr('src', " ");
                const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
                $(".mainImage").attr('src', url);
                $("img[data-id='" + $("#removeid").val() + "']").parent().parent().remove();
                $("#remove_main_deal_modal").modal('hide');
            })


            $(document).ready(function(e) {
                $("#closeImgModal").click(function() {
                    $("#img_upload_success_modal").modal('hide');
                    window.location.reload();
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#image-form').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    let TotalFiles = $('#photos')[0].files.length; //Total files
                    console.log($("#main_image_id").val());
                    if($("#main_image_id").val() != ''){

                        let files = $('#photos')[0];
                        for (let i = 0; i < TotalFiles; i++) {
                            formData.append('files' + i, files.files[i]);
                        }
                        formData.append('TotalFiles', TotalFiles);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('frontend.business_owner.saveDeal.step2') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: (data) => {
                                this.reset();
                                // console.log(data);
                                // alert('Files has been uploaded using jQuery ajax');
                                $("#img_upload_success_modal").modal('show');
                            },
                            error: function(data) {
                                // alert(data.responseJSON.errors.files[0]);
                                // console.log(data.responseJSON.errors);
                                $.each(data.responseJSON.errors, function(key, value) {
                                    $(".show-error").find("ul").append('<li>' + value +
                                        '</li>');
                                })
                            }
                        });
                                                    
                    }
                    else{
                        $("#successmessage").html(' ');
                        $("#img_upload_success_modal").modal('show');
                        $("#successmessage").html('Please select at least one image and make main image');
                    }
                });

                $(document).on('click','.nextpage',function(){
                    $.ajax({
                        type: 'GET',
                        url: "{{ route('frontend.business_owner.check_deal_image') }}",
                        success: (data) => {
                            if(data.status == 0){
                                $("#successmessage").html('');
                                $("#successmessage").html('Please upload deal image');
                                $("#img_upload_success_modal").modal('show');
                            }
                            else{
                                window.location.href = "{{route('frontend.business_owner.createDeal.step3')}}";
                            }
                        },
                        error: function(data) {
                            // alert(data.responseJSON.errors.files[0]);
                            // console.log(data.responseJSON.errors);
                            $.each(data.responseJSON.errors, function(key, value) {
                                $(".show-error").find("ul").append('<li>' + value +
                                    '</li>');
                            })
                        }

                    });
                })
            });
        </script>
    @endpush
</x-layouts.frontend-layout>
