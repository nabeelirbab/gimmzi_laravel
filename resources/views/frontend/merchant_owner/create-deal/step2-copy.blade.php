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
                                        <div class="green_tick grey_circle margin-right">
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
                                        <div class="green_tick grey_circle margin-right">
                                            <img src="{{ asset('frontend_assets/images/steptick.svg') }}"
                                                alt="img" />
                                        </div>
                                    @elseif(count($photos) == 0 && $deal->sales_amount != '')
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
                                        <div class="green_tick grey_circle margin-right">
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
                                        <div class="green_tick grey_circle margin-right">
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
                    <div class="right_box_section">
                        <div class="heading_sec upload_haed">
                            <h1>Upload Deal Photos</h1>
                        </div>
                        {{ Form::open(['route' => 'frontend.business_owner.saveDeal.step2', 'method' => 'POST', 'class' => 'kt-form parsley-validate', 'style' => 'color:red;', 'files' => true]) }}
                        <div class="form-section">

                            <div class="d-flex flex-wrap">
                                <div class="file_upload">
                                    <div>
                                        <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}"
                                            alt="img" />
                                        <h6>Upload Deal Image</h6>
                                        <small>25 MB Maximum</small>
                                    </div>

                                    <input type="file" name="deal_image[]"  id="photos" onchange="preview_photo();" multiple />

                                    @if ($errors->has('deal_image'))
                                        <div class="error">{{ $errors->first('deal_image') }}</div>
                                    @endif
                                </div>
                                <input type="hidden" id="main_image_id" name="main_image_id">
                                <div class="file_upload">
                                    <div>
                                        @if ($maindealimage != null)
                                                @foreach ($maindealimage as $img)
                                            <img src="{{ url($img->getUrl()) }}"alt="img" class="mainImage"/>
                                                @endforeach
                                        @else
                                            <img src="{{ asset('frontend_assets/images/imageUpload.svg') }}" class="mainImage" />
                                            <h6>Main Photo</h6>
                                        @endif   
                                    </div>
                                </div>
                            </div>
                            <!-- <div class = "row" id="photo_preview"> -->
                            <div class="img-uploard-one4">
                                <ul id="photo_preview">
                                    @if ($deal != '')
                                        @if ($photos != '')
                                            @foreach ($photos as $img)
                                                <li>
                                                <a href=""><span class="material-symbols-outlined">delete</span></a>
                                                    <img class="dealimage" src="{{ url($img->getUrl()) }}" style="width: 100px;height: 100px;">
                                                <a href="javascript:void(0);" class="make_main">Make Main Photo</a>
                                                </li>
                                            @endforeach
                                        @endif
                                        {{--@if ($maindealimage != '')
                                            @foreach ($maindealimage as $img)
                                                <li>
                                                <a href=""><span class="material-symbols-outlined">
                                                            delete</span></a>
                                                    <img src="{{ url($img->getUrl()) }}"
                                                        style="width: 100px;height: 100px;">    
                                                </li>
                                            @endforeach
                                        @endif--}}
                                        <input type="hidden" name="id" value="{{ $deal->id }}">
                                    @else
                                        <input type="hidden" name="id">
                                    @endif
                                </ul>
                                @if ($errors->has('main_image_id'))
                                        <div class="error">{{ $errors->first('main_image_id') }}</div>
                                @endif
                                {{-- <ul>
                                    @if ($deal != '')
                                    @if ($photos != '')
                                    @if ($photos != '')
                                    @foreach ($photos as $img)
                                    <li>
                                        <img src="{{url($img->getUrl())}}" style="width: 100px;height: 100px;">
                                        <a href=""><span class="material-symbols-outlined">
                                                delete
                                            </span></a>
                                    </li>
                                    @endforeach
                                    @endif
                                    @endif
                                    <input type="hidden" name="id" value="{{$deal->id}}">
                                    @else
                                    <input type="hidden" name="id">
                                    @endif
                                </ul> --}}
                            </div>
                        </div>
                        <div class="skip_sec">
                            <a href="{{ route('frontend.business_owner.createDeal.step3') }}">Skip This Step for
                                later</a>
                        </div>
                        <div class="btn_section btn_section_two ">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div>
                                    <a class="btn profile_btn"
                                        href="{{ route('frontend.business_owner.createDeal.step1') }}">Back</a>
                                    <button class="btn next_btn" type="submit">Next</button>
                                </div>

                                <h6>Profile Completion :<span>25%</span> </h6>
                            </div>

                        </div>
                        {{ Form::close() }}
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
@push('scripts')
<script>
    function preview_photo() 
    {
        var total_file=document.getElementById("photos").files.length;
        for(var i=0;i<total_file;i++)
        {
            var li_img = '<li class="imageclass">'+
                         '<a href="javascript:void(0);" class="removeImage"><span class="material-symbols-outlined">delete</span></a>'+
                         '<img class="dealimage" data-id = "'+i+'" src="'+URL.createObjectURL(event.target.files[i])+'"  alt="" />'+
                         '<a href="javascript:void(0);" class="make_main">Make Main Photo</a>'+
                         '</li>';
        $('#photo_preview').append(li_img);
        }
    }
    
    $(document).on('click','.make_main',function(){
       // console.log('123');
       const url = $(this).parent().find('img.dealimage').attr('src');
       $(".mainImage").attr('src',url);
       $("#main_image_id").val($(this).parent().find('img.dealimage').data('id'));
     });

     $(document).on('click','.removeImage',function(){
       var id = $(this).next('.dealimage').data('id');
    //    console.log(id);
    //    console.log($("#main_image_id").val());
       if($("#main_image_id").val() == $(this).next('.dealimage').data('id')){
          $("#removeid").val($("#main_image_id").val());
          $("#remove_main_deal_modal").modal('show');
       }
       else{
         $(this).parent('li.imageclass').remove();
       }
     });

     $(document).on('click','#removeMainImage',function(){
        $("#main_image_id").val('');
        $(".mainImage").attr('src'," ");
        $("img[data-id='" + $("#removeid").val() + "']").parent().remove(); 
        $("#remove_main_deal_modal").modal('hide');
     })
   

</script>
@endpush
</x-layouts.frontend-layout>
