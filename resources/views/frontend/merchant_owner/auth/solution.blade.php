<x-layouts.frontend-layout title="Create Your Business solution">
    <header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m">
                <a class="navbar-brand" href="{{route('frontend.business_owner.index')}}"><img
                        src="{{asset('frontend_assets/images/logo-marchant.png')}}" /></a>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> --><span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication">
                        <li class="header_close_btn closebtn"> <a> Close</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
    </header>
    <div class="wizard-body">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left_step">
                        <ul>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"> </div>
                                    <div>
                                        <h6>Step One</h6>
                                        <p>Create your user login and tell us about your business</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="d-flex">
                                    <div class="grey_circle margin-right"></div>
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
                                        <p> 
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="text-center">
                            <button class="deal_btn btn">My Business Profile Page</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="right_box_section">
                        <div class="heading_sec">
                            <h1>Select a Solution to get started</h1>
                        </div>
                        <div class="select-solution-sec">
                            <div class="row">
                                <div class="col-md-6" id="localdeal">
                                    <div class="solution-sec">
                                        <img src="{{asset('frontend_assets/images/icon1.svg')}}">
                                        <h2>Local Deals</h2>
                                    </div>
                                </div>
                                <div class="col-md-6" id="traveldiscount">
                                    <div class="solution-sec">
                                        <img src="{{asset('frontend_assets/images/icon2.svg')}}">
                                        <h2>Travel Discounts</h2>
                                    </div>
                                </div>
                                <div class="col-md-6" id="liveevent">
                                    <div class="solution-sec">
                                        <img src="{{asset('frontend_assets/images/icon3.svg')}}">
                                        <h2>Live Events</h2>
                                    </div>
                                </div>
                                <div class="col-md-6" id="corporatedeal">
                                    <div class="solution-sec">
                                        <img src="{{asset('frontend_assets/images/icon4.svg')}}">
                                        <h2>Corporate and<br> Franchise Deals</h2>
                                    </div>
                                </div>
                            </div>
                            <span id="typeerror"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade points_add_modal"id="notclosemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="border_bottom">
                        
                        <p>Please create business profile to complete your registration process</p>
                        <br />
                    </div>
                    <button type="button" class="btn close_btn"
                        onclick="window.location.reload"
                        data-bs-dismiss="modal"aria-label="Close">
                        Ok
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
    $('.closebtn').click(function(){
        $('#notclosemodal').modal('show');
    })
    $(document).ready(function() {
        $("#localdeal").click(function() {
            var type = 'local deal';
            $("#typeerror").html('');
            $.ajax({
                url: '{{ route("frontend.business_owner.store_solution") }}',
                type: 'get',
                data: {
                    'type': type
                },
                success: function(result) {
                    // console.log(result);
                    if (result.success == 1) {

                        window.location =
                            '{{ route("frontend.business_owner.create_business_profile") }}';

                    } else {
                        $("#typeerror").html('Please select a solution type');
                        $("#typeerror").css('color', 'red');
                    }
                }
            });
        });
        $("#traveldiscount").click(function() {
            var type = 'travel discount';
            $("#typeerror").html('');
            $.ajax({
                url: '{{ route("frontend.business_owner.store_solution") }}',
                type: 'get',
                data: {
                    'type': type
                },
                success: function(result) {
                    // console.log(result);
                    if (result.success == 1) {

                        window.location =
                            '{{ route("frontend.business_owner.create_business_profile") }}';

                    } else {
                        $("#typeerror").html('Please select a solution type');
                        $("#typeerror").css('color', 'red');
                    }
                }
            });
        });
        $("#liveevent").click(function() {
            var type = 'live event';
            console.log(type);
            $("#typeerror").html('');
            $.ajax({
                url: '{{ route("frontend.business_owner.store_solution") }}',
                type: 'get',
                data: {
                    'type': type
                },
                success: function(result) {
                    // console.log(result.data);
                    if (result.success == 1) {

                        window.location =
                            '{{ route("frontend.business_owner.create_business_profile") }}';

                    } else {
                        $("#typeerror").html('Please select a solution type');
                        $("#typeerror").css('color', 'red');
                    }
                }
            });

        });
        $("#corporatedeal").click(function() {
            var type = 'corporate deal';
            $("#typeerror").html('');
            $.ajax({
                url: '{{ route("frontend.business_owner.store_solution") }}',
                type: 'get',
                data: {
                    'type': type
                },
                success: function(result) {
                    console.log(result);
                    if (result.success == 1) {

                        window.location =
                            '{{ route("frontend.business_owner.create_business_profile") }}';

                    } else {
                        $("#typeerror").html('Please select a solution type');
                        $("#typeerror").css('color', 'red');
                    }
                }
            });
        });
    });
    </script>
    @endpush
</x-layouts.frontend-layout>