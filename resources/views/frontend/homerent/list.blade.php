<x-layouts.frontend-layout title="Explore">
    
    <div class="all-smart-rental-database-main-sec show-filled-units-only">
        <div class="first-smart-rental-sec">
            <div class="container">
                <div class="search-appart-top-one">
                    <h2 class="m-0">Search for apartments</h2>
                    <div class="search-appart-top-right">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2" checked="">
                            <label class="form-check-label" for="flexRadioDefault2">
                                active Adults 55+ Housing Only
                            </label>
                        </div>

                        <!-- <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Show collegiate student housing only
                    </label>
                </div> -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                id="flexRadioDefault2" checked="">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Show All
                            </label>
                        </div>
                    </div>

                </div>
                <div class="browse-student b-space">
                    <a class="housing-link link-text11" href="#">Browse Student Housing</a>
                </div>
                <div class="form-group-rental-input top-space-one14">
                    <input type="text" placeholder="Search Apartment.." id="search_provider" />
                    <button type="button" class="search">
                        <img src="{{ asset('frontend_assets/images/search-icon-rental.svg') }}" alt="" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="allen-park-apartments-main-sec">
        <div class="allen-part-apartments-sec">


            <div class="middle-park-main-middle-sec">
                <div class="container">
                    <div class="smart-contain-main1 approved-one">
                        <ul id="providerData">
                        @if(count($providers) > 0)
                         @foreach ($providers as $provider)
                            <li class="active-one ">
                                <div class="smart-contain-left">
                                    <div class="heart-icon">
                                        <i class="far fa-heart"></i>
                                    </div>
                                    <figure class="smart-contain-left1 vbvbvbv">
                                        <a href="{{ route('frontend.apartment.view',base64_encode($provider->id)) }}">
                                            @if($provider->logo_img)
                                            <img src="{{ $provider->logo_img }}" class="cat-right-icon" style="height: 78px;width: 97px;">
                                             @else
                                                <img src="{{ asset('frontend_assets/images/logo-travel-tourism.png')}}"class="cat-right-icon" style="height: 78px;width: 97px;">
                                             @endif
                                        </a>
                                    </figure>
                                    <div class="smart-contain-left-text">
                                        <h4>{{$provider->name}}</h4>
                                        <p class=""><img
                                                src="{{ asset('frontend_assets/images/location-icon44.svg') }}"
                                                class=""> {{$provider->address}},{{$provider->city}},{{$provider->states->name}}, {{$provider->zip_code}}</p>
                                    </div>
                                </div>
                                <div class="Search-for-apartments-right-one14">
                                    @if($provider->photo_img)
                                        @foreach ( $provider->photo_img as $photo )
                                            <img src="{{$photo}}" style="height: 88px;width: 99px;border-radius: 8%;margin-bottom: 10px;">
                                        @endforeach
                                    @else
                                        <img src="{{ asset('frontend_assets/images/logo-travel-tourism.png') }}" style="height: 90px;max-width:90%;">
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        @else
                        <li class="active-one ">
                            <div class="smart-contain-left">
                                <div class="heart-icon">
                                    <i class="far fa-heart"></i>
                                </div>
                                <div class="smart-contain-left-text">
                                    <h4>No Provider Found</h4>
                                   
                                </div>
                            </div>
                        </li>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script>
    $(document).ready(function(){
        $(document).on("click",".search",function(){
            if($("#search_provider").val() != ''){
                $.ajax({
                        url: "{{route('frontend.get-apartment')}}",
                        type: 'GET',
                        data: {search_provider:$("#search_provider").val()},
                        success: function(result) {
                            console.log(result);
                            var svgimage = "{{ asset('frontend_assets/images/location-icon44.svg') }}";
                            if (result.status == 1) {
                                $("#providerData").html(' ');   
                               for(var i = 0; i < result.data.length; i++){
                                        for (var j = 0; j < result.data[i].photo_img.length; j++){
                                            var photoimage = '<img src="'+result.data[i].photo_img[j]+'" style="height: 88px;width: 99px;border-radius: 8%;margin-bottom: 10px;">';
                                            $('.providerimage').append(photoimage);
                                        }
                                        var providerlist = '<li class="active-one ">'+
                                                                '<div class="smart-contain-left">'+
                                                                    '<div class="heart-icon">'+
                                                                    '<i class="far fa-heart"></i>'+
                                                                    '</div>'+
                                                                    '<figure class="smart-contain-left1 vbvbvbv">'+
                                                                        '<a href="">'+
                                                                            '<img src="'+result.data[i].logo_img+'" class="cat-right-icon" style="height: 78px;width: 97px;">'+
                                                                        '</a>'+
                                                                    '</figure>'+
                                                                    '<div class="smart-contain-left-text">'+
                                                                        '<h4>'+result.data[i].name+'</h4>'+
                                                                            '<p class=""><img src='+svgimage+' class=""> '+result.data[i].address+','+result.data[i].city+', '+result.data[i].states.name+', '+result.data[i].zip_code+'</p>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                                '<div class="Search-for-apartments-right-one14 providerimage">'+
                                                                    
                                                                '</div>'+
                                                            '</li>';
                                        $("#providerData").append(providerlist);                    
                               }
                            }
                        }
                    });
            }
        })
    })
</script>
@endpush
</x-layouts.frontend-layout>
