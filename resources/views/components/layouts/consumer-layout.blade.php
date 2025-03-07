<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gimmzi</title>
   
    <!-- fabicon -->
    <link rel="shortcut icon" type="images/x-icon" href="{{asset('frontend_assets/images/favicon.ico')}}" />
    <!-- All CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('frontend_assets/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/brands.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/regular.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/solid.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/parsley/parsley.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/custom-style.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('frontend_assets/modal-one.css')}}"> --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="{{asset('frontend_assets/css/style-new.css')}}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" href="rental.css" /> -->
	<link rel="stylesheet" href="{{asset('frontend_assets/wizard.css')}}" />
	<!-- <link rel="stylesheet" href="custom.css"> </head> -->
  @stack('style')
  @livewireStyles

</head>

    @if(Auth::check())
      @if(Auth::user()->hasRole('CONSUMER'))
         <x-frontend.consumer.header />
      @endif
    @endif
       
        <body>
           {{ $slot }}
           <footer>
            <div class="footer_top">
                <div class="container">
                    <div class="ft_logo">
                        <a href="javascript:void();"><img src="{{asset('frontend_assets/images/gimmzi-ft-logo.svg')}}" alt="footer logo"></a>
                    </div>
                    <div class="ft_nav">
                        <ul>
                            <li><a href="javascript:void();">Loyalty Rewards</a></li>
                            <li><a href="javascript:void();">Gimmzi Deals</a></li>
                            <li><a href="javascript:void();">Earn More points</a></li>
                            <li><a href="javascript:void();">Become a Partner</a></li>
                        </ul>
                    </div>
                    <div class="ft_info">
                        <p>Do Not Sell My Personal Information</p>
                    </div>
                    <div class="ft_social">
                        <ul>
                            <li><a href="javascript:void();" target="_blank"><img src="{{asset('frontend_assets/images/fb-icon-d.svg')}}" alt=""></a></li>
                            <li><a href="javascript:void();" target="_blank"><img src="{{asset('frontend_assets/images/insta-icon-d.svg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer_btm">
                <div class="container">
                    <div class="ft_btm_row">
                        <p>© {{ date('Y') }}  Gimmzi LLC. All rights reserved.</p>
                        <ul>
                            <li><a href="javascript:void();">Terms of Services</a></li>
                            <li><a href="javascript:void();">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

    <!-- <span id="scroll" style="display: none;"><i class="fas fa-angle-up"></i></span> -->

    <!-- Jquery-->
    <script src="{{asset('frontend_assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend_assets/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/common.js')}}"></script>
    <script src="{{asset('frontend_assets/js/toastr.min.js')}}"></script>
    <link rel="stylesheet" type="text/css"  href="{{asset('frontend_assets/js/toastr.min.css')}}">
    <script>
        function isNumber(evt)
          {
            console.log(evt);
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
          }
          $(".allow_decimal").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
            {
              evt.preventDefault();
            }
          });
    </script>
    <script>
  
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif


    @if(Session::has('info'))
    toastr.info("{{ Session::get('info') }}");
    @endif


    @if(Session::has('warning'))
    toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if(Session::has('error'))
    toastr.error("{{ Session::get('error') }}");
    @endif

    
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.parsley-validate').parsley({});
    } );
</script>
  @stack('scripts')
  @livewireScripts

</body>

</html>