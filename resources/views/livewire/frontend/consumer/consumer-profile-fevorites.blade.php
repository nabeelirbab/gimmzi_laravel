<div>
    <div class="acc_filter_bar">
        <form action="#" class="cmn_form_elem">
            <div class="acc_filter_row">
                <ul>
                    <li><a href="javascript:void(0);" wire:click="setfilterValue('all')"  class="{{ $filterVal === 'all' ? 'active' : '' }}">All (5)</a></li>
                    {{-- <li><a href="#">Deals (0)</a></li> --}}
                    {{-- <li><a href="#">Loyalty Punch Cards (0)</a></li> --}}
                    <li><a href="javascript:void(0);" wire:click="setfilterValue('small_business')"  class="{{ $filterVal === 'small_business' ? 'active' : '' }}">Small Business (2)</a></li>
                    {{-- <li><a href="#">Vacation Listings (2)</a></li> --}}
                    <li><a href="javascript:void(0);" wire:click="setfilterValue('hotelresorts')"  class="{{ $filterVal === 'hotelresorts' ? 'active' : '' }}">Hotel and Resorts (0)</a></li>
                    <li><a href="javascript:void(0);" wire:click="setfilterValue('community')"  class="{{ $filterVal === 'community' ? 'active' : '' }}">Community (1)</a></li>
                </ul>
                <!-- <div class="rgt_bar">
                    <label>Sort by:</label>
                    <select>
                        <option>Type</option>
                        <option>Type 1</option>
                    </select>
                </div> -->
            </div>
        </form>
    </div>
    <div class="my_fab_cont">
        <div class="title_h1">My Favorites</div>
        <div class="com_list_row row">

            @if ($filterVal == 'all')
                <div class="col-md-4 com_list_col my_fab_col">
                    <div class="com_list_box">
                        <div class="com_list_box_top">
                            <img src="{{asset('frontend_assets/images/com-list-bg1.jpeg')}}" alt="" class="com_list_box_top_img">
                            <div class="voucher_list">
                                <ul>
                                    <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                    <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="com_list_box_btm">
                            <h2 class="title_h3"><a href="#">Wilson's Grocery Mart</a></h2>
                            <p>$81.54 of $500,
                                16% towards goal</p>
                            <div class="hgt_txt">
                                Spend $500 and get $10 OFF next purchase <br>
                                Earn up to 20 points per purchase
                            </div>
                            <div class="tt_btns_grp">
                                <a href="#" class="cmn_theme_btn full">View Gimmzi Page</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 com_list_col my_fab_col">
                    <div class="com_list_box">
                        <div class="com_list_box_top">
                            <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                            <div class="voucher_list">
                                <ul>
                                    <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                    <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="com_list_box_btm">
                            <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                            <p>Oak Island, NC</p>
                            <div class="tt_btns_grp">
                                <a href="#" class="cmn_theme_btn">Book Online</a>
                                <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($filterVal == 'small_business')
                <div class="col-md-4 com_list_col my_fab_col">
                    <div class="com_list_box">
                        <div class="com_list_box_top">
                            <img src="{{asset('frontend_assets/images/com-list-bg1.jpeg')}}" alt="" class="com_list_box_top_img">
                            <div class="voucher_list">
                                <ul>
                                    <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                    <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="com_list_box_btm">
                            <h2 class="title_h3"><a href="#">Wilson's Grocery Mart</a></h2>
                            <p>$81.54 of $500,
                                16% towards goal</p>
                            <div class="hgt_txt">
                                Spend $500 and get $10 OFF next purchase <br>
                                Earn up to 20 points per purchase
                            </div>
                            <div class="tt_btns_grp">
                                <a href="#" class="cmn_theme_btn full">View Gimmzi Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($filterVal == 'hotelresorts')
                <div class="col-md-4 com_list_col my_fab_col">
                    <div class="com_list_box">
                        <div class="com_list_box_top">
                            <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                            <div class="voucher_list">
                                <ul>
                                    <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                    <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="com_list_box_btm">
                            <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                            <p>Oak Island, NC</p>
                            <div class="tt_btns_grp">
                                <a href="#" class="cmn_theme_btn">Book Online</a>
                                <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($filterVal == 'community')
                <div class="col-md-4 com_list_col my_fab_col">
                    <div class="com_list_box">
                        <div class="com_list_box_top">
                            <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                            <div class="voucher_list">
                                <ul>
                                    <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                    <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="com_list_box_btm">
                            <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                            <p>Oak Island, NC</p>
                            <div class="tt_btns_grp">
                                <a href="#" class="cmn_theme_btn">Book Online</a>
                                <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif



            {{-- <div class="col-md-4 com_list_col my_fab_col">
                <div class="com_list_box">
                    <div class="com_list_box_top">
                        <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                        <div class="voucher_list">
                            <ul>
                                <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="com_list_box_btm">
                        <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                        <p>Oak Island, NC</p>
                        <div class="tt_btns_grp">
                            <a href="#" class="cmn_theme_btn">Book Online</a>
                            <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 com_list_col my_fab_col">
                <div class="com_list_box">
                    <div class="com_list_box_top">
                        <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                        <div class="voucher_list">
                            <ul>
                                <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="com_list_box_btm">
                        <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                        <p>Oak Island, NC</p>
                        <div class="tt_btns_grp">
                            <a href="#" class="cmn_theme_btn">Book Online</a>
                            <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 com_list_col my_fab_col">
                <div class="com_list_box">
                    <div class="com_list_box_top">
                        <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                        <div class="voucher_list">
                            <ul>
                                <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="com_list_box_btm">
                        <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                        <p>Oak Island, NC</p>
                        <div class="tt_btns_grp">
                            <a href="#" class="cmn_theme_btn">Book Online</a>
                            <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 com_list_col my_fab_col">
                <div class="com_list_box">
                    <div class="com_list_box_top">
                        <img src="{{asset('frontend_assets/images/com-list-bg3.jpeg')}}" alt="" class="com_list_box_top_img">
                        <div class="voucher_list">
                            <ul>
                                <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="com_list_box_btm">
                        <h2 class="title_h3"><a href="#">iTrip - Oak Island</a></h2>
                        <p>Oak Island, NC</p>
                        <div class="tt_btns_grp">
                            <a href="#" class="cmn_theme_btn">Book Online</a>
                            <a href="#" class="cmn_theme_btn bordered">View Gimmzi Page</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
