{{-- <header class="main-head">
    <div class="container top-header">
        <nav class="navbar navbar-expand-lg header-m new-corporate-lead-setting-1-header-main">
            
            <a class="navbar-brand" href="{{route('frontend.consumer-dashboard')}}"><img src="{{asset('frontend_assets/images/logo-marchant.png')}}"></a>
            <div class="header-logo-flex">
                <button class="id-gimiz">Zip code: {{Auth::user()->zip_code}}</button>
                <a href=""><span>Change</span></a>
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
                 
                         {{-- <select class="form-select" aria-label="Default select example">
                            <option selected>{{Auth::user()->full_name}}</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select> --}}
                        {{-- <div class="dropdown custom-menu-one1">
                            <button class="dropdown-toggle select-business-category" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                aria-expanded="false">{{Auth::user()->full_name}}</button>
                            <ol class="dropdown-menu select-business-category-droup-down droupdown-custom-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('frontend.consumer-dashboard')}}">Account</a></li>
                                <li><a class="dropdown-item" href="{{route('frontend.consumer-logout')}}">Logout</a></li>
                             
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
</header>  --}}



<header class="main-head-new">
    <div class="nav_bar_top">
        <div class="container">
            <p>Small Businesses, Big Rewards!</p>
        </div>
    </div>
    <div class="nav_bar_btm">
        <div class="container">

            <nav class="navbar navbar-expand-lg">
            
                  <a class="navbar-brand" href="#"><img src="{{asset('frontend_assets/images/logo-nw.svg')}}" alt="logo"></a>

                  <div class="searchbar_mobile">
                    <a href="#" class="search_hd_link nav_rgt_link"><img src="{{asset('frontend_assets/images/search-bar-icon-d.svg')}}" alt="search-icon"></a>
                    <div class="srch_bar">
                        <form action="#">
                            <input type="text" placeholder="Find on Gimmzi">
                            <input type="submit">
                        </form>
                      </div>
                  </div>

                  <div class="ext_link">
                    <a href="#">Gimmzi Universe</a>
                  </div>
                  
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <button class="navbar-toggler navbar-toggler-main" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <!-- <span class="navbar-toggler-icon"></span> -->
                        <span class="stick"></span>
                    </button>
                    <ul class="navbar-nav">
                        <li class="current-menu-item"><a href="#url">Loyalty Rewards</a></li>
                        <li><a href="#url">Gimmzi Deals</a></li>
                        <li><a href="#url">Earn More points</a></li>
                        <li><a href="#url">Become a Partner</a></li>
                    </ul>
                   
                  </div>

                  <div class="nav_rgt_items">
                    <ul>
                        <li><a href="#" class="nav_rgt_link"><img src="{{asset('frontend_assets/images/wallet-icon-d.svg')}}" alt="wallet-icon"></a></li>
                        <li><a href="#" class="nav_rgt_link"><img src="{{asset('frontend_assets/images/wishlist-icon-d.svg')}}" alt="wishlist-icon"></a></li>
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{asset('frontend_assets/images/user-profile-icon-d.svg')}}" alt="user-icon">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#"><i><img src="{{asset('frontend_assets/images/icon-user-mn.svg')}}" alt=""></i> My Account</a></li>
                                    <li><a class="dropdown-item" href="{{route('frontend.consumer-logout')}}"><i><img src="{{asset('frontend_assets/images/icon-logout-mn.svg')}}" alt=""></i> Logout</a></li>
                                </ul>
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