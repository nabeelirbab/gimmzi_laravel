<header class="main-head">
    <div class="container top-header">

        <nav class="navbar navbar-expand-lg header-m">
        
              <a class="navbar-brand" href="{{route('frontend.index')}}"><img src="{{asset('frontend_assets/images/logo_community.png')}}"></a>
             
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                <ul class="navbar-nav ms-auto top-navication1">
                    @if(Route::current()->getName() != 'frontend.property-manager-profile') 
                        <li class="goback-to-home-page-btn-smart-rental"><a href="{{route('frontend.property-manager-profile')}}"><span><img src="{{asset('frontend_assets/images/smart-rental-1-icon.svg')}}" alt=""/></span> Back to Home page</a></li> 
                        <li>
                    @endif
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
                                <li><a class="dropdown-item" href="{{route('frontend.property-manager-profile')}}">Home</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.provider.get_user_profile')}}">My Profile Settings</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.property-manager-logout')}}">Logout</a></li>
                             
                            </ol>
                        </div> 
                    </li>
                </ul>
            </div>
          </nav>

    </div>



</header>