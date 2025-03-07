<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gimmzi</title>

    <!-- fabicon -->
    <link rel="shortcut icon" type="images/x-icon" href="{{ asset('frontend_assets/images/favicon.ico') }}" />
    <!-- All CSS -->
    {{-- <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" /> --}}
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/regular.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/parsley/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style-new.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.theme.default.css') }}"> -->
    {{-- <link rel="stylesheet" href="{{ asset('frontend_assets/modal-one.css') }}"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="rental.css" /> -->
    <link rel="stylesheet" href="{{ asset('frontend_assets/wizard.css') }}" />
    <script src="{{ asset('frontend_assets/js/jquery-3.5.1.min.js') }}"></script>
    
    {{-- <link href="{{ asset('admin_assets/vendors/general/summernote/dist/summernote-bs4.css') }}" rel="stylesheet"> --}}

    @livewireStyles


    <style>
        div.pac-container {
            z-index: 1150 !important;
        }
        .carousel-wrapper {
            width: 1200px;
            margin: auto;
            position: relative;
            text-align: center;
            font-family: sans-serif;
        }

        .owl-carousel .owl-nav {
            overflow: hidden;
            height: 0px;
        }

        .owl-theme .owl-dots .owl-dot.active span,
        .owl-theme .owl-dots .owl-dot:hover span {
            background: #5110e9;
        }

        .owl-carousel .item {
            text-align: center;
        }

        .owl-carousel .nav-button {
            height: 50px;
            width: 25px;
            cursor: pointer;
            position: absolute;
            top: 110px !important;
        }

        .owl-carousel .owl-prev.disabled,
        .owl-carousel .owl-next.disabled {
            pointer-events: none;
            opacity: 0.25;
        }

        .owl-carousel .owl-prev {
            left: -35px;
        }

        .owl-carousel .owl-next {
            right: -35px;
        }

        .owl-theme .owl-nav [class*=owl-] {
            color: #ffffff;
            font-size: 39px;
            background: #000000;
            border-radius: 3px;
        }

        .owl-carousel .prev-carousel:hover {
            background-position: 0px -53px;
        }

        .owl-carousel .next-carousel:hover {
            background-position: -24px -53px;
        }
    </style>
    <!-- <link rel="stylesheet" href="custom.css"> </head> -->
    @stack('style')
</head>


<header class="main-head-new">
    <div class="nav_bar_top">
        <div class="container">
            <p>Small Businesses, Big Rewards!</p>
        </div>
    </div>
    <div class="nav_bar_btm">
        <div class="container">

            <nav class="navbar navbar-expand-lg">
            
                  <a class="navbar-brand" href="#"><img src="{{ asset('frontend_assets/images/logo-marchant.png') }}" alt="logo"></a>

                  {{-- <div class="searchbar_mobile">
                    <a href="#" class="search_hd_link nav_rgt_link"><img src="images/search-bar-icon-d.svg" alt="search-icon"></a>
                    <div class="srch_bar">
                        <form action="#">
                            <input type="text" placeholder="Find on Gimmzi">
                            <input type="submit">
                        </form>
                      </div>
                  </div> --}}
                  
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                        <span class="stick"></span>
                    </button>
                    {{-- <ul class="navbar-nav ms-auto">
                        <li class="current-menu-item"><a href="#url">Loyalty Rewards</a></li>
                        <li><a href="#url">Gimmzi Deals</a></li>
                        <li><a href="#url">Earn More points</a></li>
                        <li><a href="#url">Become a Partner</a></li>
                    </ul> --}}
                   
                  </div>

                  <div class="nav_rgt_items">
                    <ul>
                        {{-- <li><a href="#" class="nav_rgt_link"><img src="{{asset('images/wallet-icon-d.svg" alt="wallet-icon')}}"></a></li>
                        <li><a href="#" class="nav_rgt_link"><img src="images/wishlist-icon-d.svg" alt="wishlist-icon"></a></li> --}}
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img style = "max-width: 30px; height: auto;" src="{{ asset('frontend_assets/images/people.png') }}" alt="user-icon">
                                </button>
                                {{-- <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Admin Details</a></li>
                                    <li><a class="dropdown-item" href="#">Profile Details</a></li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul> --}}
                              </div>
                        </li>
                    </ul>
                  </div>

                  <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                  </button>
                
              </nav>

        </div>
    </div>
    


    <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"></button>

</header>

<div class="top_mod_bar">
    <div class="container">
        <div class="title_h3">Business Partner Intro Plan</div>
        <div class="plan_area">
            <span>$27 per month</span>
            {{-- <a href="#">Change plan</a> --}}
        </div>
    </div>
</div>

<body>
    {{ $slot }}
    <footer class="footer">
        © {{ date('Y') }} <a href="{{ route('frontend.index') }}">Gimmzi LLC.</a>
    </footer>
    

    {{-- @livewireScripts --}}
    <!-- <span id="scroll" style="display: none;"><i class="fas fa-angle-up"></i></span> -->

    <!-- Jquery-->
    
    <script src="{{ asset('frontend_assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/parsley/parsley.min.js') }}"></script>

    <script src="{{ asset('frontend_assets/js/common.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/toastr.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend_assets/js/toastr.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    {{-- <script src="{{ asset('admin_assets/vendors/general/summernote/dist/summernote-bs4.js') }}"></script> --}}
    <script>
        jQuery(document).ready(function() {
            var owl = jQuery('.owl-carousel');
            owl.owlCarousel({
                margin: 15,
                nav: true,
                navText: ["<div class='nav-button owl-prev1'>‹</div>",
                    "<div class='nav-button owl-next1'>›</div>"
                ],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        })
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    {{-- <script src="{{asset('frontend_assets/js/owl.carousel.js')}}"></script> --}}
    <script>
        function isNumber(evt) {
            console.log(evt);
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        $(".allow_decimal").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) {
                evt.preventDefault();
            }
        });
    </script>


    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif


        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @endif


        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif


        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.parsley-validate').parsley({});

        });

        function addCommas(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
