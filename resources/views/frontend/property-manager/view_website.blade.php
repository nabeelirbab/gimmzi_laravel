<x-layouts.provider-layout title="message board">
    @push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    @endpush
    <div class="allen-park-apartments-main-sec">
        <div class="allen-part-apartments-sec">
            <div class="first-goback-search-sec">
                <div class="container">
                    <div class="btn-go-search-apartments">
                        <button><img src="./images/go-back-icon-1.svg" alt="">Go Back to search</button>
                    </div>
                </div>
            </div>

            <div class="middle-park-main-middle-sec">
                <div class="container">
                    
                    <div class="middle-park-apartments-sec-main">
                        <div class="left-middle-park-main-sec">
                            <div class="left-middle-park-sec left-middle-park-sec">
                                <input type="hidden" name="property_id" value="{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->id : '' }}" id="property_id">
                                <figure>
                                    <img src="{{ asset('frontend_assets/images/allen-park-icon-11.png')}}" alt="">
                                </figure>
                            </div>
                            <div class="right-middle-park-sec">
                                <h3><span id="change_first">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->name : '' }}</span>
                                    <span class="dropdown top-droup-down-menu">
                                        <button class="dropdown-toggle custom-droup-down" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('frontend_assets/images/green-down-tick.svg') }}"
                                                class="" />
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @foreach ($propertyDetails as $property)
                                                <li><a class="property_provider" id="property_provider"
                                                        href="javascript:void(0);"
                                                        data-property_id="{{ $property->provider->id }}"
                                                        data-property_url="{{ route('frontend.ajax-rental-db-table', $property->provider->id) }}">{{ $property->provider ? $property->provider->name : '' }}</a>
                                                </li>
                                            @endforeach
        
                                        </ul>
                                    </span>
                                </h3>
                                <div class="apartments-sec">
                                    <ul style="display: flex; align-items: center; padding-left: 0;">
                                        <li>
                                            <div class="left-apartments-data">
                                                <h6>
                                                    <span class="icon-img-sec-rental">
                                                        <img src="{{ asset('frontend_assets/images/location-icon-rental-1.svg')}}" alt=""></span>
                                                        <label id="property_address">{{ $propertyDetails->first()->provider ? $propertyDetails->first()->provider->address : '' }}, 
                                                            {{$propertyDetails->first()->provider ? $propertyDetails->first()->provider->city : '' }},
                                                            {{$propertyDetails->first()->provider ? $propertyDetails->first()->provider->state : '' }},
                                                            {{$propertyDetails->first()->provider ? $propertyDetails->first()->provider->zip_code : '' }}</label>
                                                </h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="left-apartments-data">
                                                <h6>
                                                    <span class="icon-img-sec-rental showPropertyPhone">
                                                        @if($propertyDetails->first()->provider->phone != null)
                                                        <img src="{{ asset('frontend_assets/images/allen-park-icon-2.svg')}}" class="iconImage" alt=""></span>
                                                        <span class="property_phone">{{$propertyDetails->first()->provider->phone}}</span>
                                                        @else
                                                        <img src="{{ asset('frontend_assets/images/mail-one1.svg')}}" class="iconImage" alt=""></span>
                                                        <span class="property_phone">{{auth()->user()->email}}</span>
                                                        @endif
                                                </h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="right-middle-park-main-sec">
                            <button><img src="{{ asset('frontend_assets/images/map-icon-allen.svg')}}" alt=""> Map it</button>
                        </div>
                    </div>
                    @include('frontend.property-manager.ajax.website_external_button')
                </div>
            </div>


        </div>
    </div>

    <!-- Add_role_modal -->
    <div class="modal fade modal_floor " id="floor_plan_modal_open" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="close closefloormodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                  </button>
                <div class="modal-body">
                    <div class="foor-wrap">
                        <div class="floor-img-wrp">
                            <figure class="floor-fig">
                                <img src="{{ asset('frontend_assets/images/r-allen.png')}}" class="allen-img-first showFloorImage" alt="">
                            </figure>
                        </div>
                        <div class="foor-txt-outr">
                            <strong class="showNumber">1</strong>
                            <p><span class="showBedroom">1 Bedroom</span>|<span class="showBathroom"> 1 Bedroom</span></p>
                            <p class="showTotal">750 sq.ft</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script>
        var base_url = window.location.origin;
        $(document).ready(function(){
            lightbox.option({
               disableScrolling:true
            });

            $(document).on('click', '#property_provider', function() {
                var providerid = $(this).attr('data-property_id');
                // console.log(value1);
                let ajaxPath = base_url + "/get-external-button";

                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    data: {'providerid' : providerid},
                    success: function(response) {
                        console.log(response.data);
                        $('#change_first').text(response.data.name);
                        $('#property_address').text(response.data.address+', '+response.data.city+', '+response.data.state+', '+response.data.zip_code);
                        if(response.data.phone == null){
                            var icon = "{{ asset('frontend_assets/images/mail-one1.svg')}}";
                            var email = '{{auth()->user()->email}}';
                            $(".iconImage").attr('src',icon);
                            $(".property_phone").text(email);
                        }
                        else{
                            var icon = "{{ asset('frontend_assets/images/allen-park-icon-2.svg')}}";
                            $(".iconImage").attr('src',icon);
                            $(".property_phone").text(response.data.phone);
                        }
                        $('#property_id').val(response.data.id);
                        $('#currentpropertyName').text(response.data.name);
                        $('.externalButtonList').html(response.html);
                    }
                });

            });



            $(document).on('click',".floor_plan_modal",function(){
                //console.log('123');
                
                var property_id = $(this).attr('id');
                var floor_value = $(this).attr('value');
                let ajaxPath = base_url + "/get-provider-floor-plan";
                $(".showFloorImage").attr('src','');
                $(".showNumber").html('');
                $(".showBedroom").html('');
                $(".showBathroom").html('');
                $(".showTotal").html('');
                $.ajax({
                    type: 'GET',
                    url: ajaxPath,
                    data: {'propertyid' : property_id},
                    success: function(response) {
                        
                        if(response.status == 1){
                            $("#floor_plan_modal_open").modal('show');
                            if(floor_value == 1){
                                console.log('789');
                                if(response.image1 != ''){
                                    $(".showFloorImage").attr('src',response.image1);
                                    $(".showNumber").val(floor_value);
                                    $(".showBedroom").html(response.data.bedroom_1+' Bedroom');
                                    $(".showBathroom").html(response.data.bathroom_1+' Bahroom');
                                    $(".showTotal").html(response.data.total_1+' sq.ft');
                                }
                                
                            }
                            if(floor_value == 2){
                                console.log('456');
                                if(response.image2 != ''){
                                    $(".showFloorImage").attr('src',response.image2);
                                    $(".showNumber").val(floor_value);
                                    $(".showBedroom").html(response.data.bedroom_2+' Bedroom');
                                    $(".showBathroom").html(response.data.bathroom_2+' Bahroom');
                                    $(".showTotal").html(response.data.total_2+' sq.ft');
                                }
                                
                            }
                            if(floor_value == 3){
                                console.log('123');
                                if(response.image3 != ''){
                                    $(".showFloorImage").attr('src',response.image3);
                                    $(".showNumber").val(floor_value);
                                    $(".showBedroom").html(response.data.bedroom_3+' Bedroom');
                                    $(".showBathroom").html(response.data.bathroom_3+' Bahroom');
                                    $(".showTotal").html(response.data.total_3+' sq.ft');
                                }
                                
                            }
                        }
                        else{
                            $("#floor_plan_modal_open").modal('hide');
                        }
                    }
                });
            });

            $(document).on('click','.closefloormodal',function(){
                $("#floor_plan_modal_open").modal('hide');
            })
        });
    </script>
    @endpush
</x-layouts.provider-layout>