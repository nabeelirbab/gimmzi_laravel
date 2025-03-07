<x-layouts.frontend-layout title="Upload Business Photo Logo">
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
                        <li class="header_close_btn"> <a href="{{ route('frontend.business_owner.index') }}"> Close</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    </header>
    <div class="wizard-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    @if ($profile != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img
                                                src="{{ asset('frontend_assets/images/steptick.svg') }}"alt="img" />
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
                                    @if ($images != '')
                                        <div class="green_tick green_line grey_circle margin-right">
                                            <img
                                                src="{{ asset('frontend_assets/images/steptick.svg') }}"alt="img" />
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
                                    <div class="grey_circle margin-right"></div>
                                    <div>
                                        <h6>Step Three</h6>
                                        <p>Create first deal using Deal Wizard</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"></div>
                                    <div>
                                        <h6>Step Four</h6>
                                        <p>Choose and activate plan. Access profile on vour new Business Profile Page
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn" style="background: #93DA42;">My Business Profile Page</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                 
                  <form action="" id="image-form" enctype="multipart/form-data">
                    <div class="right_box_section padding-b-space">
                        <div class="heading_sec">
                            <h1 class="uploard-business-logo-text">Upload Business Logo and Photos</h1>
                        </div>
                            <div class="form-section">
                                <div class="upld_img_sec">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 36%;">
                                            <div class="d-flex flex-wrap">
                                                <div class="file_upload">
                                                    <div>
                                                        <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}"
                                                            alt="img" />
                                                        <h6>Upload Business Logo</h6>
                                                        <small>25 MB Maximum</small>
                                                    </div>
                                                    <div class="show-error">
                                                        <ul></ul>
                                                    </div>
                                                    <input type="file" name="business_logo" id="logo" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="uploaded_file_grp">
                                                <div class="up_pht_btn">
                                                    @if($logo != '')
                                                        <img src="{{ $logo->getUrl() }}"
                                                                class="logoPreview" style="height:200px;border-radius: 5%;">
                                                    @else
                                                        <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}" class="logoPreview" style="height:200px;border-radius: 5%;">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="logo_error"></span>
                                </div>
                            </div>    

                        <div class="image_box_wrapper  pading-bottom-space">
                            <h4>Upload Business Photos and Media</h4>
                            <div class="form-section">
                                <div class="upld_img_sec">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 36%;">
                                            <div class="d-flex flex-wrap">
                                                <div class="file_upload">
                                                    <div>
                                                        <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}"
                                                            alt="img" />
                                                        <h6>Upload Business Photo</h6>
                                                        <small>25 MB Maximum</small>
                                                    </div>
                                                    <div class="show-error">
                                                        <ul></ul>
                                                    </div>
                                                    <input type="file" name="business_photos[]" id="photos" onchange="preview_photo();" multiple />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="uploaded_file_grp">
                                                <div class="up_pht_btn">
                                                @if($profile->main_image != NULL)
                                                    <img src="{{ $profile->main_image }}"
                                                            class="mainImage" style="height:200px;border-radius: 5%;">
                                                @else
                                                    <input type="hidden" id="main_image_id" name="main_image_id" >
                                                    <img src="{{ asset('frontend_assets/images/placeholderimage.png') }}"
                                                            class="mainImage" style="height:200px;border-radius: 5%;">
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="upld_file_list_sec">
                                    <div class="lists" id="photo_preview">
                                        @if ($profile != '')
                                            @if ($photos != '')
                                                @foreach ($photos as $key=>$img)
                                                    @if($profile->main_image != NULL)
                                                        @if($profile->main_image == $img->getUrl())
                                                        <input type="hidden" id="main_image_id" name="main_image_id" value="{{$key}}">
                                                        @endif
                                                    @endif
                                                    <div class="item">
                                                        <div class="inner">
                                                            <img class="businessimage" width="175" height="130"
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
                                            @else
                                               <input type="hidden" id="main_image_id" name="main_image_id" >
                                            @endif
                                        @endif
                                    </div>
                                </div>  
                                <span id="photo_error"></span>
                               <br>
                                <div class="upld_img_sec">
                                    <div class="row">
                                        <div class="col-lg-6" style="width: 36%;">
                                            <div class="d-flex flex-wrap">
                                                <div class="file_upload">
                                                    <div>
                                                        <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}"
                                                            alt="img" />
                                                        <h6>Upload Business Media</h6>
                                                        <small>25 MB Maximum</small>
                                                    </div>
                                                    <div class="show-error">
                                                        <ul></ul>
                                                    </div>
                                                    <input type="file" name="business_media" id="media" accept="video/*"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="uploaded_file_grp">
                                                <div class="up_pht_btn">
                                                    @if($profile->video != '')
                                                        <video id="preview_media" src = "{{ url('storage/'.$profile->video) }}" style="height:200px;border-radius: 5%;" controls autoplay>
                                                         Your browser does not support the video tag.
                                                        </video>
                                                    @else
                                                    <video id="preview_media" src = "{{ $profile->video }}" style="display:none;height:200px;border-radius: 5%;" controls autoplay>
                                                         Your browser does not support the video tag.
                                                        </video>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span id="media_error"></span>
                                </div>
                            </div>  

                            <br>
                                <div class="skip-this-text">
                                    <a href="{{ route('frontend.business_owner.deal_create_step1') }}"> Skip This Step, I
                                        will upload logo and images later </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <a class="back-button-one"
                                            href="{{ route('frontend.business_owner.create_business_address') }}">Back</a>

                                        <button class="complete-step-two checkStepTwo" type="button" style="background: #93DA42;">Complete step two</button>
                                        <button class="back-button-one" style="margin-left: 10px;" type="submit">Upload Photo</button>
                                    </div>
                                    <div class="p-complete-text">
                                        Profile Completion : <span>25%</span>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                  </form>
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
    document.getElementById("media").onchange = function(event) {
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").style.display = 'block';
        document.querySelector("video").src = blobURL;
    }

    $(document).ready(function (e) {
    $("#closeImgModal").click(function() {
        $("#img_upload_success_modal").modal('hide');
        window.location.reload();
    });
    $('#logo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('.logoPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });

    });
    function preview_photo() {
        var total_file = document.getElementById("photos").files.length;
        for (var i = 0; i < total_file; i++) {
            var div_list = '<div class="item imageclass">' +
                '<div class="inner">' +
                '<img width="175" height="130" class="businessimage" data-id = "' + i + '" src="' + URL.createObjectURL(
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
    // $('#media').change(function(){
    //     const file = this.files[0];
    //     console.log(file);
    //     if (file){
    //       let reader = new FileReader();
    //       reader.onload = function(event){
    //         console.log(event.target.result);
    //         $('#preview_media').attr('src', event.target.result);
    //       }
    //       reader.readAsDataURL(file);
    //     }
    //   });

    $(document).on('click', '.make_main', function() {
        $("#main_image_id").val('');
        const url = $(this).parent().parent().find('img.businessimage').attr('src');
        $(".mainImage").attr('src', url);
        $("#main_image_id").val($(this).parent().parent().find('img.businessimage').data('id'));
    });

    $(document).on('click', '.removeImage', function() {
        var imgID = $(this).parent().parent().find('.businessimage').data('id');
        //     console.log(imgID);
        //    console.log($("#main_image_id").val());
        if ($("#main_image_id").val() == imgID) {
            $("#removeid").val($("#main_image_id").val());
            $("#remove_main_deal_modal").modal('show');
        } else {
            $(this).parent().parent().parent().remove();
            $.ajax({
                type: 'GET',
                url: "{{ route('frontend.business_owner.remove_business_image') }}",
                data: {'image_id':imgID,'type': 'not_main'},
                success: function(response) {
                    console.log(response);
                    if(response.status == 1){
                        $("#img_upload_success_modal").modal('show');
                        $("#successmessage").html('Image has been deleted successfully');
                    }
                }
            });
        }
    });

    $(document).on('click', '#removeMainImage', function() {
        $("#main_image_id").val('');
        $(".mainImage").attr('src', " ");
        const url = "{{ asset('frontend_assets/images/placeholderimage.png') }}";
        $(".mainImage").attr('src', url);
        $("img[data-id='" + $("#removeid").val() + "']").parent().parent().remove();
        $("#remove_main_deal_modal").modal('hide');
        $.ajax({
                type: 'GET',
                url: "{{ route('frontend.business_owner.remove_business_image') }}",
                data: {'image_id':$("#removeid").val(),'type': 'main'},
                success: function(response) {
                    console.log(response);
                    if(response.status == 1){
                        $("#img_upload_success_modal").modal('show');
                        $("#successmessage").html('Image has been deleted successfully');
                    }
                }
            });
    });

    $(document).ready(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#image-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            //console.log($('#photos')[0].files.length);
            let TotalFiles = $('#photos')[0].files.length; //Total files
            console.log(TotalFiles);
        if((TotalFiles > 0) || ($("#logo").val() != '') || ($("#main_image_id").val() != '') || ($("#preview_media").attr('src') != '')){

                let files = $('#photos')[0];
                for (let i = 0; i < TotalFiles; i++) {
                    formData.append('files' + i, files.files[i]);
                }
                formData.append('TotalFiles', TotalFiles);
                console.log(formData);
                $("#logo_error").html('');
                $("#photo_error").html('');
                $("#media_error").html('');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('frontend.business_owner.save_business_photo') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        //console.log(data);
                        if(data.status == 1){
                            $("#img_upload_success_modal").modal('show');
                            $("#successmessage").html('Photo has been uploaded successfully');
                        }
                        else if(data.status == 2){
                            $("#logo_error").html(data.validation_errors).css('color','red');
                        }
                        else if(data.status == 3){
                            $("#photo_error").html('The business photo must be a file of type: png, jpg, jpeg.').css('color','red');
                        }
                        else if(data.status == 4){
                            $("#media_error").html(data.validation_errors).css('color','red');
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
                                            
            }
            else{
                $("#successmessage").html(' ');
                $("#img_upload_success_modal").modal('show');
                $("#successmessage").html('Please selcet at lease one image');
            }
        });

        $(document).on('click','.checkStepTwo',function(){
            $.ajax({
                        type: 'GET',
                        url: "{{ route('frontend.business_owner.check_business_image') }}",
                        success: (data) => {
                            if(data.status == 0){
                                $("#successmessage").html('');
                                $("#successmessage").html('Please upload business image');
                                $("#img_upload_success_modal").modal('show');
                            }
                            else{
                                window.location.href = "{{route('frontend.business_owner.deal_create_step1')}}";
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
        });
    });



</script>
@endpush
</x-layouts.frontend-layout>
