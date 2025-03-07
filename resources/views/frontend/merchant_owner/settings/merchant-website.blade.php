<x-layouts.frontend-layout title="Business Owners Account Page">
@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
@endpush
{{-- <a href="https://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg" data-lightbox="lgt1"><img src="https://lokeshdhakar.com/projects/lightbox2/images/image-1.jpg" alt=""></a> --}}
<div class="allen-park-apartments-main-sec view-your-merchant-website-main-sec">
    <div class="allen-part-apartments-sec">

        <div class="middle-park-main-middle-sec">
            <div class="container">
                <div class="form-group-rental-input view-sec">
                    <input type="text" placeholder="Search businesses, brands, or keywords for deals">
                    <button>
                        <img src="{{asset('frontend_assets/images/search-icon-rental.svg')}}" alt="">
                    </button>
                </div>
                <div class="middle-park-apartments-sec-main">
                    <div class="left-middle-park-main-sec">
                        <div class="left-middle-park-sec left-middle-park-sec">
                            <figure>
                            <img src="{{Auth::user()->merchantBusiness->logo_image}}" alt="" style="width: 102px;height: 87px;border-radius: 4px;" />
                            </figure>
                        </div>
                        <div class="right-middle-park-sec">
                            <h2>{{Auth::user()->merchantBusiness->business_name}}</h2>
                            <div class="rt_mid_park_sec">
                                <select name="main_location" class="form-control" id="main_location" style="width: 50%;">
                                    @if ($merchant_location)
                                    @foreach ($merchant_location as $locations)

                                    @if($locations->merchantUser->location_type == 'multiple')
                                    <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{
                                        $locations->businessLocation->id }}" >{{
                                        $locations->businessLocation->location_name }}
                                    </option>
                                    @else
                                    <option {{$locations->is_main == 1 ? 'selected' : ''}} value="{{
                                        $locations->businessLocation->id }}">{{
                                        $locations->businessLocation->location_name }}
                                    </option>
                                    @endif

                                    @endforeach
                                    @endif
                        </select>
                                {{-- <a href="#" class="view_loc_btn">View All Location</a> --}}
                                <a href="#" style="margin-left: auto;" class="link_btn">Hours of Operation</a>
                            </div>
                                
                            
                            <ul style="margin-top: 25px;">
                                <li><span><img src="{{asset('frontend_assets/images/location-icon-rental-1.svg')}}" alt=""></span>Address:
                                    <span class="phone-time" id="change_address">
                                        @foreach ($merchant_location as $locations)
                                            @if($locations->is_main == 1)
                                            {{$locations->businessLocation->address}},
                                            {{$locations->businessLocation->city}},
                                            {{$locations->businessLocation->states->name}},
                                            {{$locations->businessLocation->zip_code}}
                                            @endif
                                        @endforeach
                                    </span>
                                </li>
                                
                                <li><span><img src="{{asset('frontend_assets/images/allen-park-icon-2.svg')}}" alt="">
                                </span>Phone:<span class="phone-time"  id="change_phone">
                                    @foreach ($merchant_location as $locations)
                                        @if($locations->is_main == 1)
                                        {{$locations->businessLocation->business_phone}}
                                        @endif
                                    @endforeach
                                </span>
                                </li>
                            </ul>
                            <div class="day_appo_chart">
                                <ul>
                                    <li>
                                        <strong>Sunday:</strong> 9 AM - 9 PM, 9.30 PM - 11.30 PM
                                    </li>
                                    <li>
                                        <strong>Monday:</strong> 9 AM - 9 PM, 9.30 PM - 11.30 PM
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="right-middle-park-main-sec">
                        <button><img src="{{asset('frontend_assets/images/map-icon-allen.svg')}}" alt=""> Map it</button>
                    </div>
                </div>
                <div class="allen-part-tab-one-main">
                    <nav>
                        <div class="nav nav-tabs mb-3 nav-cutom-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                            type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                            <button class="nav-link" id="nav-orderonline-tab" data-bs-toggle="tab" data-bs-target="#nav-orderonline"
                                type="button" role="tab" aria-controls="nav-orderonline" aria-selected="true">Order
                                Online</button>
                            <button class="nav-link" id="nav-menu-tab" data-bs-toggle="tab" data-bs-target="#nav-menu"
                                type="button" role="tab" aria-controls="nav-menu" aria-selected="true">View Menu</button>
                            <button class="nav-link" id="nav-career-tab" data-bs-toggle="tab" data-bs-target="#nav-career"
                                type="button" role="tab" aria-controls="nav-career" aria-selected="true">Careers</button>
                            <button class="nav-link" id="nav-eventFlyer-tab" data-bs-toggle="tab" data-bs-target="#nav-eventFlyer"
                                type="button" role="tab" aria-controls="nav-eventFlyer" aria-selected="true">View Event Flyer</button>
                            <button class="nav-link" id="nav-website-tab1" data-bs-toggle="tab"
                                data-bs-target="#nav-website" type="button" role="tab" aria-controls="nav-website"
                                aria-selected="false">Visit Direct Website</button>

                            <div class="right-all-tab">
                                <p><a href="">Reward Progress</a>35%</p>
                            </div>

                        </div>
                    </nav>
                    <div class="tab-content allen-container-mid" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                            aria-labelledby="nav-home-tab">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-5">
                                                @if($business_profile != '')
                                                  <img src="{{url($business_profile->main_image)}}" class="allen-img-first" alt="">
                                                @else
                                                  <img src="{{asset('frontend_assets/images/r-allen.png')}}" class="allen-img-first" alt="">
                                                @endif
                                            </div>

                                            <div class="col-sm-7 allen-small-img scroll_area_panel">
                                                <div class="row hm_tab_img_grps">
                                                    <div class="col-lg-4 col-md-6 hm_tab_img_grps_items">
                                                        <a href="{{url('storage/'.$business_profile->video)}}" data-fancybox="lgtkk">
            
                                                            {{-- <video width="120" height="120" controls="false" autoplay="autoplay">
                                                                <source src="{{url('storage/'.$business_profile->video)}}" type="video/mp4">
                                                            </video> --}}
                                                            <img src="{{asset('frontend_assets/images/r-allen1.png')}}" alt="">
                                                        </a>
                                                    </div>
                                                   @if(count($business_photos) > 0)
                                                    @foreach($business_photos as $photo)
                                                        <div class="col-lg-4 col-md-6 hm_tab_img_grps_items"><img src="{{$photo->getUrl()}}" alt="">
                                                        </div>
                                                        @endforeach
                                                   @else
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen1.png')}}" alt="">
                                                    </div>
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen2.png')}}" alt="">
                                                    </div>
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen3.png')}}" alt="">
                                                    </div>
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen4.png')}}" alt="">
                                                    </div>
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen5.png')}}" alt="">
                                                    </div>
                                                    <div class="col-sm-4"><img src="{{asset('frontend_assets/images/r-allen6.png')}}" alt="">
                                                    </div>
                                                   @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">
                                                
                                            </table>
                                        </div>

                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-orderonline" role="tabpanel" aria-labelledby="nav-orderonline-tab1">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-12">
                                                @if($external_manage)
                                                    @if($external_manage->order_online_display != 0)
                                                        @if($external_manage->order_online_url != '')
                                                            <?php $order_online = $external_manage->order_online_url;?>
                                                        @else
                                                            <?php $order_online = '';?>
                                                        @endif
                                                    @else
                                                       <?php $order_online = '';?>
                                                    @endif
                                                @else
                                                    <?php $order_online = '';?>
                                                @endif
                                                    <p class="websitebutton" id="orderOnlineLink"><strong>Click On: </strong><a href="{{$order_online?$order_online:''}}" target="_blank">Order Online</a></p>
                                                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">
                                              
                                            </table>
                                        </div>
                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-menu" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-12 allen-small-img">
                                                <div class="row vw_item_rows">
                                                    @if($external_manage)
                                                        @if($external_manage->view_menu_display != 0)
                                                            @if($external_manage->menu_image1 != '')
                                                                <?php $image1 = $external_manage->menu_image1;?>
                                                            @endif
                                                            @if($external_manage->menu_image2 != '')
                                                               <?php $image2 = $external_manage->menu_image2;?>
                                                            @endif
                                                            @if($external_manage->menu_image3 != '')
                                                                <?php $image3 = $external_manage->menu_image3;?>
                                                            @endif
                                                        @else
                                                            <?php   $image1 = asset('frontend_assets/images/sampleimage.jpg');
                                                                    $image2 = asset('frontend_assets/images/sampleimage.jpg');
                                                                    $image3 = asset('frontend_assets/images/sampleimage.jpg');?>
                                                        @endif
                                                    @else
                                                            <?php   $image1 = asset('frontend_assets/images/sampleimage.jpg');
                                                                    $image2 = asset('frontend_assets/images/sampleimage.jpg');
                                                                    $image3 = asset('frontend_assets/images/sampleimage.jpg');?>
                                                    @endif
                                                   
                                                    <div class="col-lg-4 col-md-6 vw_item">
                                                        <div class="vw_item_img">
                                                            <a href="{{$image1}}" data-lightbox="lgt1" >
                                                                <img id="menu1image" src="{{$image1}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="vw_item_text">
                                                            <a href="{{$image1}}" data-lightbox="lgt1" >View</a>
                                                            <a href="#">Download</a>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-lg-4 col-md-6  vw_item">
                                                        <div class="vw_item_img">
                                                            <a href="{{$image2}}" data-lightbox="lgt1" >
                                                              <img id="menu2image"  src="{{$image2}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="vw_item_text">
                                                            <a href="{{$image2}}" data-lightbox="lgt1">View</a>
                                                            <a href="#">Download</a>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-lg-4 col-md-6  vw_item">
                                                        <div class="vw_item_img">
                                                            <a href="{{$image3}}" data-lightbox="lgt1" >
                                                             <img id="menu3image" src="{{$image3}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="vw_item_text">
                                                            <a href="{{$image3}}" data-lightbox="lgt1">View</a>
                                                            <a href="#">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">
                                            </table>
                                        </div>
                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-career" role="tabpanel" aria-labelledby="nav-career-tab1">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-12">
                                                @if($external_manage)
                                                @if($external_manage->carrer_display != 0)
                                                    @if($external_manage->carrer_url != '')
                                                        <?php $career = $external_manage->carrer_url;?>
                                                    @else
                                                        <?php $career = '';?>
                                                    @endif
                                                @else
                                                   <?php $career = '';?>
                                                @endif
                                            @else
                                                <?php $career = '';?>
                                            @endif
                                            <p class="websitebutton" id="careerLink"><strong>Click On: </strong><a href="{{$external_manage->carrer_url}}" target="_blank">Careers</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">
                                            </table>
                                        </div>
                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-eventFlyer" role="tabpanel" aria-labelledby="nav-eventFlyer-tab">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-12 allen-small-img">
                                                <div class="row vw_item_rows">
                                                    @if($external_manage)
                                                        @if($external_manage->view_flyer_display != 0)
                                                        
                                                            @if($external_manage->flyer_image1 != '')
                                                                    <?php $flyer1image = $external_manage->flyer_image1;?>
                                                            @endif
                                                                
                                                            @if($external_manage->flyer_image2 != '')
                                                                   <?php $flyer2image = $external_manage->flyer_image2;?>
                                                            @endif
                                                        @else
                                                                <?php  
                                                                 $flyer1image = asset('frontend_assets/images/sampleimage.jpg');
                                                                 $flyer2image = asset('frontend_assets/images/sampleimage.jpg');
                                                                 ?>
                                                        @endif
                                                    @else
                                                        <?php  
                                                        $flyer1image = asset('frontend_assets/images/sampleimage.jpg');
                                                        $flyer2image = asset('frontend_assets/images/sampleimage.jpg');
                                                        ?>
                                                    @endif
                                                    <div class="col-lg-6 col-md-12 vw_item">
                                                        <div class="vw_item_img">
                                                            <a href="{{$flyer1image}}" data-lightbox="lgt1" >
                                                                <img id="flyer1image" src="{{$flyer1image}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="vw_item_text">
                                                            <a href="{{$flyer1image}}" data-lightbox="lgt1" >View</a>
                                                            <a href="#">Download</a>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-lg-6 col-md-12  vw_item">
                                                        <div class="vw_item_img">
                                                            <a href="{{$flyer2image}}" data-lightbox="lgt1" >
                                                              <img id="flyer2image"  src="{{$flyer2image}}" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="vw_item_text">
                                                            <a href="{{$flyer2image}}" data-lightbox="lgt1">View</a>
                                                            <a href="#">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">

                                            </table>
                                        </div>
                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-website" role="tabpanel" aria-labelledby="nav-website-tab1">
                            <div class="allen-container-mid">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="row allen-container-mid-one">
                                            <div class="col-sm-12">
                                                @if($external_manage)
                                                  @if($external_manage->direct_website_display != 0)
                                                    @if($external_manage->direct_website_url != '')
                                                    <p class="websitebutton" id="directLink"><strong>Click On: </strong><a href="{{$external_manage->direct_website_url}}" target="_blank">{{$external_manage->direct_website_url}}</a></p>
                                                    @else
                                                    <p><strong>Comming Soon</strong></p>
                                                    @endif
                                                  @else
                                                    <p><strong>Visit Direct Website display off</strong></p>
                                                  @endif
                                                @else
                                                  <p><strong>Comming Soon</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="smart-rewards-deal-right-tab-sec rwrd_deals_hm_tab">
                                            <table class="loyalty_program">
                                                
                                            </table>
                                        </div>
                                        <div class="weekly-specials-right-tab-sec boardDisplay">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    $(document).ready(function() {
        lightbox.option({
            disableScrolling:true
        });

        var location_id = $("#main_location").val();
        $.ajax({
                    url: '{{ route('frontend.business_owner.account_setting_merchant_location') }}',
                    type: 'GET',
                    data: {
                        'location_id': location_id
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            $('#change_address').html('');
                            $('#change_phone').html('');
                            var address = response.data.address+','+response.data.city+','+response.data.states.name+','+response.data.zip_code;
                            $('#change_address').append(address);
                            var phone = response.data.business_phone;
                            $('#change_phone').html(phone);
                            $("#orderOnlineLink").html('');
                            $("#menu1image").attr('src','');
                            $("#menu2image").attr('src','');
                            $("#menu3image").attr('src','');
                            $("#careerLink").html('');
                            $("#directLink").html('');
                            $(".boardDisplay").html('');
                            $(".loyalty_program").html('');
                            
                            console.log(response.loyalty_reward.length);
                            var url = '{{asset('frontend_assets/images/sampleimage.jpg')}}';
                            if(response.external != null){
                                if(response.external.order_online_display != 0){
                                    if(response.external.order_online_url != ''){
                                        $("#orderOnlineLink").append('<strong>Click On: </strong><a href="'+response.external.order_online_url+'" target="_blank">Order Online</a>');
                                    }
                                    else{
                                        $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#orderOnlineLink").append('<strong>Order Online Display Off</strong>');
                                }
                                if(response.external.view_menu_display != 0){
                                    //console.log(response.external.menu_image1);
                                    $("#menu1image").attr('src',response.external.menu_image1);
                                    $("#menu2image").attr('src',response.external.menu_image2);
                                    $("#menu3image").attr('src',response.external.menu_image3);
                                }
                                else{
                                    $("#menu1image").attr('src',url);
                                    $("#menu2image").attr('src',url);
                                    $("#menu3image").attr('src',url);
                                }
                                if(response.external.view_flyer_display != 0){
                                    $("#flyer1image").attr('src',response.external.flyer_image1);
                                    $("#flyer2image").attr('src',response.external.flyer_image2);
                                }
                                else{
                                    $("#flyer1image").attr('src',url);
                                    $("#flyer2image").attr('src',url);
                                }
                                if(response.external.carrer_display != 0){
                                    if(response.external.carrer_url != ''){
                                       $("#careerLink").append('<strong>Click On: </strong><a href="'+response.external.carrer_url+'" target="_blank">Careers</a>');
                                    }
                                    else{
                                        $("#careerLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#careerLink").append('<strong>Comming Soon</strong>');
                                }
                                if(response.external.direct_website_display != 0){
                                    if(response.external.direct_website_url != ''){
                                       $("#directLink").append('<strong>Click On: </strong><a href="'+response.external.direct_website_url+'" target="_blank">Direct Website</a>');
                                    }
                                    else{
                                        $("#directLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#directLink").append('<strong>Comming Soon</strong>');
                                }
                            }
                            else{
                                $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                            }
                            if( response.message_board.status != 0){

                                if(response.message_board.display_board_id != 0){
                                    if(response.message_board.display_board_id != null){
                                        var display = '<table><tr>'+
                                                        '<th>'+response.message_board.boardone.title+'</th>'+
                                                      '</tr>';
                                       // $(".boardDisplay").html(display);
                                    //    console.log(response.message_board.display_board_id +'--------');
                                    }else{
                                        var display = '';
                                    }
                                    // if(response.message_board.add_message_date != 0){
                                    //     if(response.message_board.start_date != null){
                                    //         var startdate1 = new Date(response.message_board.start_date),
                                    //             startdate1yr = startdate1.getFullYear(),
                                    //             startdate1month = ("0" + (startdate1.getMonth() + 1)).slice(-2),
                                    //             startdate1day = startdate1.getDate() < 10 ? '0' + startdate1
                                    //             .getDate() : startdate1.getDate(),
                                    //             start1Date = startdate1month + '-' + startdate1day + '-' + startdate1yr;
                                    //     }
                                    //     if(response.message_board.end_date != null){
                                    //         var enddate1 = new Date(response.message_board.end_date),
                                    //         enddate1yr = enddate1.getFullYear(),
                                    //         enddate1month = ("0" + (enddate1.getMonth() + 1)).slice(-2),
                                    //         enddate1day = enddate1.getDate() < 10 ? '0' + enddate1
                                    //         .getDate() : enddate1.getDate(),
                                    //         end1Date = enddate1month + '-' + enddate1day + '-' + enddate1yr;
                                    //     }
                                    //     else{
                                    //         var end1Date = 'Open';
                                    //     }
                                    //     // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                    //     var display2 =  '<tr>'+
                                    //                         '<td>'+
                                    //                             '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                    //                             // '<p>From bbbbbbbbbb</p>'+

                                    //                         '</td>'+
                                    //                     '</tr>';
                                                        
                                    //     //$(".boardDisplay").append(display2);
                                    // }else{
                                    //     var display2 = '';
                                    // }
                                    if(response.message_board.description != null){
                                        var display3 =   '<tr>'+
                                                            '<td>'+
                                                                '<p>'+response.message_board.description+'</p>'+
                                                            '</td>'+
                                                        '</tr></table>';
                                    }else{
                                        var display3 ='';
                                    }
                                }else{
                                    var display = '';
                                    var display2 = '';
                                    var display3 ='';
                                }
                                    // console.log(display);
                                    // console.log(display2);
                                    // console.log(display3+'--3');

                                $(".boardDisplay").append(display+display3);

                                console.log(response.message_board.display_board_id2);
                                if(response.message_board.display_board_id2 !=0){
                                    if(response.message_board.display_board_id2 != null){
                                        var display4 = '<table><tr>'+
                                                        '<th>'+response.message_board.boardtwo.title+'</th>'+
                                                      '</tr>';
                                        //$(".boardDisplay").append(display4);
                                        
                                    }
                                    // if(response.message_board.add_message_date2 != 0){
                                    //     if(response.message_board.start_date2 != null){
                                    //         var startdate2 = new Date(response.message_board.start_date2),
                                    //             startdate2yr = startdate2.getFullYear(),
                                    //             startdate2month = ("0" + (startdate2.getMonth() + 1)).slice(-2),
                                    //             startdate2day = startdate2.getDate() < 10 ? '0' + startdate2
                                    //             .getDate() : startdate2.getDate(),
                                    //             start2Date = startdate2month + '-' + startdate2day + '-' + startdate2yr;
                                    //     }
                                    //     if(response.message_board.end_date2 != null){
                                    //         var enddate2 = new Date(response.message_board.end_date2),
                                    //         enddate2yr = enddate2.getFullYear(),
                                    //         enddate2month = ("0" + (enddate2.getMonth() + 1)).slice(-2),
                                    //         enddate2day = enddate2.getDate() < 10 ? '0' + enddate2
                                    //         .getDate() : enddate2.getDate(),
                                    //         end2Date = enddate2month + '-' + enddate2day + '-' + enddate2yr;
                                    //     }
                                    //     else{
                                    //         var end2Date = 'Open';
                                    //     }
                                    //     // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                    //     var display5 =  '<tr>'+
                                    //                         '<td>'+
                                    //                             '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                    //                         '</td>'+
                                    //                     '</tr>';
                                    //     //$(".boardDisplay").append(display5);
                                        

                                    // }

                                    if(response.message_board.description2 != null){
                                        var display6 =   '<tr>'+
                                                            '<td>'+
                                                                '<p>'+response.message_board.description2+'</p>'+
                                                            '</td>'+
                                                        '</tr></table>';
                                       // $(".boardDisplay").append(display6);
                                    }
                                }else{
                                    var display4 = '';
                                    var display6 ='';
                                }
                                    $(".boardDisplay").append(display4+display6);
                            }
                            else{
                                $(".boardDisplay").html('');
                            }
                            

                            if(response.loyalty_reward.length > 0){
                                var loyaltyTable = '<tr>'+
                                                        '<th>'+
                                                            '<button class="ltr_p_toggler" data-bs-toggle="collapse" href="#ltr_p_body" role="button">Loyalty Reward Program'+
                                                                '<img src="{{asset('frontend_assets/images/icon-caret-dw.png')}}" alt="">'+
                                                            '</button>'+
                                                        '</th>'+
                                                        '<th>Expires On</th>'+
                                                        '<th></th>'+
                                                    '</tr>';
                                $(".loyalty_program").html(loyaltyTable);
                               
                                for(var i = 0; i < response.loyalty_reward.length; i++){
                                    
                                    if(response.loyalty_reward[i].end_date != null){
                                        var enddate = new Date(response.loyalty_reward[i].end_date),
                                            enddateyr = enddate.getFullYear(),
                                            enddatemonth = ("0" + (enddate.getMonth() + 1)).slice(-2),
                                            enddateday = enddate.getDate() < 10 ? '0' + enddate
                                                .getDate() : enddate.getDate(),
                                            endDate = enddatemonth + '-' + enddateday + '-' + enddateyr;
                                        var today = new Date();
                                        if(response.loyalty_reward[i].end_date > today){
                                            var join = 'See Progress';
                                        }
                                        else{
                                            var join = 'Join Now';
                                        }
                                    }
                                    else{
                                       // console.log(response.loyalty_reward[i].end_date);
                                        var endDate ='No End Date';
                                        var join = 'Join Now';
                                    }
                                    //console.log(endDate);
                                    var loyaltytr = '<tr id="ltr_p_body" class="collapse show">'+
                                        '<td>'+
                                            ' <p>'+response.loyalty_reward[i].loyaltyprogram.program_name+'</p>'+
                                        '</td>'+
                                        '<td>'+
                                            '<h6>'+endDate+'</h6>'+
                                        '</td>'+
                                        '<td><a href="">'+join+'</a></td>'+
                                    '</tr>';
                                    $(".loyalty_program").append(loyaltytr);
                                    
                                }
                            }

                        }

                    }
                });
     
        $(document).on('change', '#main_location', function(){
            var location_id = $(this).val();
            console.log(location_id);
            $.ajax({
                    url: '{{ route('frontend.business_owner.account_setting_merchant_location') }}',
                    type: 'GET',
                    data: {
                        'location_id': location_id
                    },
                    success: function(response) {
                        if (response.success == 1) {
                            $('#change_address').html('');
                            $('#change_phone').html('');
                            var address = response.data.address+','+response.data.city+','+response.data.states.name+','+response.data.zip_code;
                            $('#change_address').append(address);
                            var phone = response.data.business_phone;
                            $('#change_phone').html(phone);
                            $("#orderOnlineLink").html('');
                            $("#menu1image").attr('src','');
                            $("#menu2image").attr('src','');
                            $("#menu3image").attr('src','');
                            $("#careerLink").html('');
                            $("#directLink").html('');
                            $(".boardDisplay").html('');
                            $(".loyalty_program").html('');
                            console.log(response.message_board);
                            var url = '{{asset('frontend_assets/images/sampleimage.jpg')}}';
                            if(response.external != null){
                                if(response.external.order_online_display != 0){
                                    if(response.external.order_online_url != ''){
                                        $("#orderOnlineLink").append('<strong>Click On: </strong><a href="'+response.external.order_online_url+'" target="_blank">Order Online</a>');
                                    }
                                    else{
                                        $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#orderOnlineLink").append('<strong>Order Online Display Off</strong>');
                                }
                                if(response.external.view_menu_display != 0){
                                    console.log(response.external.menu_image1);
                                    $("#menu1image").attr('src',response.external.menu_image1);
                                    $("#menu2image").attr('src',response.external.menu_image2);
                                    $("#menu3image").attr('src',response.external.menu_image3);
                                }
                                else{
                                    $("#menu1image").attr('src',url);
                                    $("#menu2image").attr('src',url);
                                    $("#menu3image").attr('src',url);
                                }
                                if(response.external.view_flyer_display != 0){
                                    $("#flyer1image").attr('src',response.external.flyer_image1);
                                    $("#flyer2image").attr('src',response.external.flyer_image2);
                                }
                                else{
                                    $("#flyer1image").attr('src',url);
                                    $("#flyer2image").attr('src',url);
                                }
                                if(response.external.carrer_display != 0){
                                    if(response.external.carrer_url != ''){
                                       $("#careerLink").append('<strong>Click On: </strong><a href="'+response.external.carrer_url+'" target="_blank">Careers</a>');
                                    }
                                    else{
                                        $("#careerLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#careerLink").append('<strong>Comming Soon</strong>');
                                }
                                if(response.external.direct_website_display != 0){
                                    if(response.external.direct_website_url != ''){
                                       $("#directLink").append('<strong>Click On: </strong><a href="'+response.external.direct_website_url+'" target="_blank">Direct Website</a>');
                                    }
                                    else{
                                        $("#directLink").append('<strong>Comming Soon</strong>');
                                    }
                                }
                                else{
                                    $("#directLink").append('<strong>Comming Soon</strong>');
                                }
                            }
                            else{
                                $("#orderOnlineLink").append('<strong>Comming Soon</strong>');
                            }

                            if( response.message_board.status != 0){

                                   if(response.message_board.display_board_id != null){
                                       var display = '<table><tr>'+
                                                       '<th>'+response.message_board.boardone.title+'</th>'+
                                                     '</tr>';
                                    // console.log(response.message_board.boardone.title);
                                   }
                                   else{
                                    var display = '';
                                   }
                                   if(response.message_board.add_message_date != 0){
                                       if(response.message_board.start_date != null){
                                           var startdate1 = new Date(response.message_board.start_date),
                                               startdate1yr = startdate1.getFullYear(),
                                               startdate1month = ("0" + (startdate1.getMonth() + 1)).slice(-2),
                                               startdate1day = startdate1.getDate() < 10 ? '0' + startdate1
                                               .getDate() : startdate1.getDate(),
                                               start1Date = startdate1month + '-' + startdate1day + '-' + startdate1yr;
                                       }
                                       if(response.message_board.end_date != null){
                                           var enddate1 = new Date(response.message_board.end_date),
                                           enddate1yr = enddate1.getFullYear(),
                                           enddate1month = ("0" + (enddate1.getMonth() + 1)).slice(-2),
                                           enddate1day = enddate1.getDate() < 10 ? '0' + enddate1
                                           .getDate() : enddate1.getDate(),
                                           end1Date = enddate1month + '-' + enddate1day + '-' + enddate1yr;
                                       }
                                       else{
                                           var end1Date = 'Open';
                                       }
                                       var display2 =  '<tr>'+
                                                           '<td>'+
                                                               '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                                           '</td>'+
                                                       '</tr>';
                                   }
                                   else{
                                    var display2 = '';
                                   }
                                   if(response.message_board.description != null){
                                       var display3 =   '<tr>'+
                                                           '<td>'+
                                                               '<p>'+response.message_board.description+'</p>'+
                                                           '</td>'+
                                                       '</tr></table>';
                                       
                                   }
                                   else{
                                    var display3 = '';
                                   }
                                   $(".boardDisplay").append(display+display2+display3);
                             
                                   if(response.message_board.display_board_id2 != null){
                                       var display4 = '<table><tr>'+
                                                       '<th>'+response.message_board.boardtwo.title+'</th>'+
                                                     '</tr>';
                                      
                                   }
                                   else{
                                    var display4 = '';
                                   }
                                   if(response.message_board.add_message_date2 != 0){
                                       if(response.message_board.start_date2 != null){
                                           var startdate2 = new Date(response.message_board.start_date2),
                                               startdate2yr = startdate2.getFullYear(),
                                               startdate2month = ("0" + (startdate2.getMonth() + 1)).slice(-2),
                                               startdate2day = startdate2.getDate() < 10 ? '0' + startdate2
                                               .getDate() : startdate2.getDate(),
                                               start2Date = startdate2month + '-' + startdate2day + '-' + startdate2yr;
                                       }
                                       if(response.message_board.end_date2 != null){
                                           var enddate2 = new Date(response.message_board.end_date2),
                                           enddate2yr = enddate2.getFullYear(),
                                           enddate2month = ("0" + (enddate2.getMonth() + 1)).slice(-2),
                                           enddate2day = enddate2.getDate() < 10 ? '0' + enddate2
                                           .getDate() : enddate2.getDate(),
                                           end2Date = enddate2month + '-' + enddate2day + '-' + enddate2yr;
                                       }
                                       else{
                                           var end2Date = 'Open';
                                       }
                                       // $("#diaplaydate1").html('From '+start1Date+' To '+end1Date);
                                       var display5 =  '<tr>'+
                                                           '<td>'+
                                                               '<p>From '+start1Date+' To '+end1Date+'</p>'+
                                                           '</td>'+
                                                       '</tr>';
                                      
                                   }
                                   else{
                                    var display5 = '';
                                   }

                                   if(response.message_board.description2 != null){
                                       var display6 =   '<tr>'+
                                                           '<td>'+
                                                               '<p>'+response.message_board.description2+'</p>'+
                                                           '</td>'+
                                                       '</tr></table>';
                                      
                                                       
                                   }
                                   else{
                                    var display6 = '';
                                   }
                                   $(".boardDisplay").append(display4+display5+display6);
                           }
                           else{
                               $(".boardDisplay").html('');
                           }

                            if(response.loyalty_reward.length > 0){
                                var loyaltyTable = '<tr>'+
                                                        '<th>'+
                                                            '<button class="ltr_p_toggler" data-bs-toggle="collapse" href="#ltr_p_body" role="button">Loyalty Reward Program'+
                                                                '<img src="{{asset('frontend_assets/images/icon-caret-dw.png')}}" alt="">'+
                                                            '</button>'+
                                                        '</th>'+
                                                        '<th>Expires On</th>'+
                                                        '<th></th>'+
                                                    '</tr>';
                                $(".loyalty_program").html(loyaltyTable);
                                for(var i = 0; i < response.loyalty_reward.length; i++){
                                    if(response.loyalty_reward[i].end_date != null){
                                        var enddate = new Date(response.loyalty_reward[i].end_date),
                                            enddateyr = enddate.getFullYear(),
                                            enddatemonth = ("0" + (enddate.getMonth() + 1)).slice(-2),
                                            enddateday = enddate.getDate() < 10 ? '0' + enddate
                                                .getDate() : enddate.getDate(),
                                            endDate = enddatemonth + '-' + enddateday + '-' + enddateyr;
                                        var today = new Date();
                                        if(response.loyalty_reward[i].end_date > today){
                                            var join = 'See Progress';
                                        }
                                        else{
                                            var join = 'Join Now';
                                        }
                                    }
                                    else{
                                        var date='No End Date';
                                        var join = 'Join Now';
                                    }
                                    var loyaltytr = '<tr id="ltr_p_body" class="collapse show">'+
                                        '<td>'+
                                            ' <p>'+response.loyalty_reward[i].loyaltyprogram.program_name+'</p>'+
                                        '</td>'+
                                        '<td>'
                                            '<h6>'+endDate+'</h6>'+
                                        '</td>'+
                                        '<td><a href="">'+join+'</a></td>'+
                                    '</tr>';
                                    $(".loyalty_program").append(loyaltytr);
                                }
                            }

                        }

                    }
            });
        });
    });
</script>
@endpush
</x-layouts.frontend-layout>