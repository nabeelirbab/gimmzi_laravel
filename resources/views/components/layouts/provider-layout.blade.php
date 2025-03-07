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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body>

    @livewireStyles
@stack('style')


    <x-frontend.provider.header :title="$title"/>
        {{ $slot }}
    <x-frontend.provider.footer />







    <!-- <span id="scroll" style="display: none;"><i class="fas fa-angle-up"></i></span> -->

    @livewireScripts
    <!-- Jquery-->
    <script src="{{asset('frontend_assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend_assets/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend_assets/js/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" type="text/css"  href="{{asset('frontend_assets/js/toastr.min.css')}}">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" ></script>
    <script src="{{asset('admin_assets/vendors/general/summernote/dist/summernote.js')}}" type="text/javascript"></script>
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
        function addCommas(nStr)
        {
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

        $(document).ready(function(){
                $('#changepasswordModal').modal({
                        backdrop: 'static',
                        keyboard: false
                });
                $( "#autocomplete" ).autocomplete({
                    source: function( request, response ) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        // Fetch data
                        $.ajax({
                            url: "{{route('frontend.search-consumer')}}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                    search: request.term
                            },
                            success: function( data ) {
                                    response( data );
                            }
                        });
                    },
                    select: function (event, ui) {
                        // Set selection
                        $('#autocomplete').val(ui.item.label); // display the selected text
                        $('#selectitem_id').val(ui.item.value); // save selected id to input
                        return false;
                    },
                    focus: function(event, ui){
                        $("#autocomplete").val( ui.item.label );
                        ("#selectitem_id").val( ui.item.value );
                        return false;
                    },
                });  
                
                $(document).on('click','.searchConsumer',function(){
                    var base_url = window.location.origin;
                    var itemid = $("#selectitem_id").val();
                    if(itemid != ''){
                       var route = base_url +'/view-consumer-profile/'+ itemid;
                       window.location.href = route;
                    }
                    // frontend.property.consumer.view.profile
                })
            })
            
    </script>
    @stack('scripts')

</body>

</html>