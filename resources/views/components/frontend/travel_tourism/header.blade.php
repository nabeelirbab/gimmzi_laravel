<header class="main-head">
    <div class="container top-header">

        <nav class="navbar navbar-expand-lg header-m">
        
              <a class="navbar-brand" href="{{route('frontend.index')}}"><img src="{{asset('frontend_assets/images/logo-travel-tourism-portal.png')}}"></a>
             
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                <ul class="navbar-nav ms-auto top-navication1">
                
                        @if(Auth::user()->travel_type == 'short-rental')
                            @if(Route::current()->getName() == 'frontend.short.users.view.profile')
                                <li class="goback-to-home-page-btn-smart-rental1"><a href="{{route('frontend.smart_guest_database')}}"><span style="margin-right: 8px;"><img src="{{asset('frontend_assets/images/icon9.svg')}}" style = "height:22px; width:25px;filter: brightness(0) invert(1);" alt=""/></span> Back to Database</a></li> 
                            @endif
                            @if(Route::current()->getName() != 'frontend.short_term.dashboard') 
                                 <li class="goback-to-home-page-btn-smart-rental"><a href="{{route('frontend.short_term.dashboard')}}"><span><img src="{{asset('frontend_assets/images/smart-rental-1-icon.svg')}}" alt=""/></span> Back to Home page</a></li> 
                            @endif
                        @elseif(Auth::user()->travel_type == 'hotel-resort') 
                            @if(Route::current()->getName() == 'frontend.hotel.users.view.profile')
                                <li class="goback-to-home-page-btn-smart-rental1"><a href="{{route('frontend.hotel_resort.smart-rental-db')}}"><span style="margin-right: 8px;"><img src="{{asset('frontend_assets/images/icon9.svg')}}" style = "height:22px; width:25px;filter: brightness(0) invert(1);" alt=""/></span> Back to Database</a></li> 
                            @endif
                            @if(Route::current()->getName() != 'frontend.hotel_resort.dashboard') 
                                <li class="goback-to-home-page-btn-smart-rental"><a href="{{route('frontend.hotel_resort.dashboard')}}"><span><img src="{{asset('frontend_assets/images/smart-rental-1-icon.svg')}}" alt=""/></span> Back to Home page</a></li> 
                            @endif
                        @else
                        @endif  
                        {{-- @if(Route::current()->getName() != 'frontend.short_term.dashboard')
                                <li class="goback-to-home-page-btn-smart-rental"><a href="{{route('frontend.short_term.dashboard')}}"><span><img src="{{asset('frontend_assets/images/smart-rental-1-icon.svg')}}" alt=""/></span> Back to Home page</a></li> 
                        @endif --}}
                  
                    <li>
                        <!-- <select class="form-select" aria-label="Default select example">
                            <option selected>{{Auth::user()->full_name}}</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select> -->
                        <div class="dropdown custom-menu-one1">
                            <button class="dropdown-toggle select-business-category" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">{{Auth::user()->full_name}}</button>
                            <ol class="dropdown-menu select-business-category-droup-down droupdown-custom-menu" aria-labelledby="dropdownMenuButton1">
                                @if(Auth::user()->travel_type == 'short-rental')
                                <li><a class="dropdown-item" href="{{route('frontend.short_term.dashboard')}}">Home</a></li>
                                @else
                                <li><a class="dropdown-item" href="{{route('frontend.hotel_resort.dashboard')}}">Home</a></li>
                                @endif
                                @if(Auth::user()->travel_type == 'short-rental')
                                <li><a class="dropdown-item" href="{{route('frontend.short_term.get_provider_profile')}}">My Profile Settings</a></li>
                                @else
                                <li><a class="dropdown-item" href="{{route('frontend.hotel.get_provider_profile')}}">My Profile Settings</a></li>
                                @endif
                                
                                @if(Auth::user()->travel_type == 'short-rental')
                                <li><a class="dropdown-item" href="{{route('frontend.short_term.logout')}}">Logout</a></li>
                                @else
                                <li><a class="dropdown-item" href="{{route('frontend.hotel_resort.logout')}}">Logout</a></li>
                                @endif
                             
                            </ol>
                        </div> 
                    </li>
                </ul>
            </div>
          </nav>
    </div>
</header>