@if (Auth::check() == true)
<header class="main-head">
        <div class="container top-header">
            <nav class="navbar navbar-expand-lg header-m new-corporate-lead-setting-1-header-main">
                
                <a class="navbar-brand" href="{{route('frontend.business_owner.index')}}"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}"></a>
                <div class="header-logo-flex">
                    <button class="id-gimiz">GIMMZI ID: {{Auth::user()->userId}}</button>
                </div>
                <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <span class="stick"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                        <span class="stick"></span>
                    </button>
                    <ul class="navbar-nav ms-auto top-navication1">
                       @if(Route::current()->getName() != 'frontend.business_owner.account') 
                            <li class="goback-to-home-page-btn-smart-rental"><a href="{{route('frontend.business_owner.account')}}"><span><img src="{{asset('frontend_assets/images/smart-rental-1-icon.svg')}}" alt=""/></span> Back to Home page</a></li>
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
                                    <li><a class="dropdown-item" href="{{route('frontend.business_owner.account')}}">Home</a></li>
                                    <li><a class="dropdown-item" href="{{route('frontend.business_owner.user_profile_settings')}}">My Profile Settings</a></li>
                                    <li><a class="dropdown-item" href="{{route('frontend.business_owner.logout')}}">Logout</a></li>
                                 
                                </ol>
                            </div> 
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <button class="navbar-toggler" id="navoverlay" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"></button>
</header>
@endif