<div>
    <div class="acc_filter_bar">
        <form action="#" class="cmn_form_elem">
            <div class="acc_filter_row">
                <ul>
                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('all_badge')"  class="{{ $BadgeselectedFilter === 'all_badge' ? 'active' : '' }}">All ({{$overall_count}})</a></li>
                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('small_business')" class="{{ $BadgeselectedFilter === 'small_business' ? 'active' : '' }}">Small Business (0)</a></li>

                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('vacation_listing')" class="{{ $BadgeselectedFilter === 'vacation_listing' ? 'active' : '' }}">Vacation Listings (0)</a></li>

                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('hotel_resort')" class="{{ $BadgeselectedFilter === 'hotel_resort' ? 'active' : '' }}">Hotels and Resorts ({{$hotel_short_total_count}})</a></li>

                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('apartment_community')" class="{{ $BadgeselectedFilter === 'apartment_community' ? 'active' : '' }}">Apartment Community ({{$active_apartment_count}})</a></li>

                    <li><a href="javascript:void(0);" wire:click="badgeSetFilter('student_housing')" class="{{ $BadgeselectedFilter === 'student_housing' ? 'active' : '' }}">Student Housing (O)</a></li>
                </ul>
                <div class="rgt_bar">
                    <label>Sort by:</label>
                    <select>
                        <option>Type</option>
                    </select>
                </div>
            </div>
        </form>
    </div>

    <div class="my_badges_wrapper">
        <div class="title_h1">My Gimmzi Badges</div>
        <div class="badge_row row">
            <div class="col-md-4 badge_col">
                @if ($BadgeselectedFilter == 'all_badge') 
                    <div class="badge_box">
                        <div class="badge_sec_top">
                            <div class="badge_sec_top_slider">
                                <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                                </div>
                            </div>
                            <div class="badge_indicators">
                                <div class="ind_lt">
                                </div>
                                <div class="ind_rt">
                                    <div class="ind_lt_txt">
                                        Starting at
                                        <span class="ind_txt">80</span>
                                        <span>Points per month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="badge_sec_btm">
                            <h2 class="title_h2">Your Gimmzi Badge</h2>
                            <p>
                                As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                            </p>
                            <div class="btn_cont">
                            </div>
                        </div>
                    </div>      
                @endif

                @if ($BadgeselectedFilter == 'small_business')
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">80</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Your Gimmzi Badge</h2>
                        <p>
                            As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                        </p>
                        <div class="btn_cont">
                        </div>
                    </div>
                </div>
                @endif

                @if ($BadgeselectedFilter == 'vacation_listing')
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">80</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Your Gimmzi Badge</h2>
                        <p>
                            As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                        </p>
                        <div class="btn_cont">
                        </div>
                    </div>
                </div>
                @endif

                @if ($BadgeselectedFilter == 'hotel_resort')
                    <div class="badge_box">
                        <div class="badge_sec_top">
                            <div class="badge_sec_top_slider">
                                <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                                </div>
                            </div>
                            <div class="badge_indicators">
                                <div class="ind_lt">
                                </div>
                                <div class="ind_rt">
                                    <div class="ind_lt_txt">
                                        Starting at
                                        <span class="ind_txt">80</span>
                                        <span>Points per month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="badge_sec_btm">
                            <h2 class="title_h2">Your Gimmzi Badge</h2>
                            <p>
                                As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                            </p>
                            <div class="btn_cont">
                            </div>
                        </div>
                    </div>
                @endif

                @if ($BadgeselectedFilter == 'apartment_community')
                    {{-- @if($active_apartment_count) --}}
                    <div class="badge_box">
                        <div class="badge_sec_top">
                            <div class="badge_sec_top_slider">
                                <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                                </div>
                            </div>
                            <div class="badge_indicators">
                                <div class="ind_lt">
                                </div>
                                <div class="ind_rt">
                                    <div class="ind_lt_txt">
                                        Starting at
                                        <span class="ind_txt">80</span>
                                        <span>Points per month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="badge_sec_btm">
                            <h2 class="title_h2">Your Gimmzi Badge</h2>
                            <p>
                                As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                            </p>
                            <div class="btn_cont">
                            </div>
                        </div>
                    </div>
                    {{-- @endif --}}
                @endif

                @if ($BadgeselectedFilter == 'student_housing')
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge" ></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">80</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Your Gimmzi Badge</h2>
                        <p>
                            As a Gimmzi Smart Rewards member, you have access to an exclusive Gimmzi badge. This badge unlocks our full database of deals offered by Gimmzi's small business partners. Be sure to use all 80 points each month to enjoy the maximum benifits! 
                        </p>
                        <div class="btn_cont">
                        </div>
                    </div>
                </div>
                @endif
            </div>
            {{-- <div class="col-md-4 badge_col">
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-2.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-3.png')}}" alt="badge"></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                                <div class="ind_lt_txt">
                                    Next badge level
                                    <span class="ind_txt">Networker</span>
                                </div>
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">30</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Scan QR Codes with select Gimmzi partners locations and share Gimmzi with family and friends</h2>
                        <p>You have a Gimmizi badge because you are a Gimmzi Smart Rewards member. This badge allows to the full database of deals offered by Gimmizi small business partners. This badge also gives you the opportunity to earn points....</p>
                        <div class="btn_cont">
                            <a href="#" class="cmn_theme_btn full">Check Badge Power</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 badge_col">
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="images/badge-gimmzi.png" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-2.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-3.png')}}" alt="badge"></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                                <div class="ind_lt_txt">
                                    Next badge level
                                    <span class="ind_txt">Networker</span>
                                </div>
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">30</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Scan QR Codes with select Gimmzi partners locations and share Gimmzi with family and friends</h2>
                        <p>You have a Gimmizi badge because you are a Gimmzi Smart Rewards member. This badge allows to the full database of deals offered by Gimmizi small business partners. This badge also gives you the opportunity to earn points....</p>
                        <div class="btn_cont">
                            <a href="#" class="cmn_theme_btn full">Check Badge Power</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 badge_col">
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-2.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-3.png')}}" alt="badge"></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                                <div class="ind_lt_txt">
                                    Next badge level
                                    <span class="ind_txt">Networker</span>
                                </div>
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">30</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Scan QR Codes with select Gimmzi partners locations and share Gimmzi with family and friends</h2>
                        <p>You have a Gimmizi badge because you are a Gimmzi Smart Rewards member. This badge allows to the full database of deals offered by Gimmizi small business partners. This badge also gives you the opportunity to earn points....</p>
                        <div class="btn_cont">
                            <a href="#" class="cmn_theme_btn full">Check Badge Power</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 badge_col">
                <div class="badge_box">
                    <div class="badge_sec_top">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-2.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-3.png')}}" alt="badge"></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                                <div class="ind_lt_txt">
                                    Next badge level
                                    <span class="ind_txt">Networker</span>
                                </div>
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">30</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Scan QR Codes with select Gimmzi partners locations and share Gimmzi with family and friends</h2>
                        <p>You have a Gimmizi badge because you are a Gimmzi Smart Rewards member. This badge allows to the full database of deals offered by Gimmizi small business partners. This badge also gives you the opportunity to earn points....</p>
                        <div class="btn_cont">
                            <a href="#" class="cmn_theme_btn full">Check Badge Power</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 badge_col">
                <div class="badge_box">
                    <div class="badge_sec_top disabled">
                        <div class="badge_sec_top_slider">
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-gimmzi.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-2.png')}}" alt="badge"></div>
                            </div>
                            <div class="item">
                                    <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo">
                                    <div class="badge_main_pic"><img src="{{asset('frontend_assets/images/badge-3.png')}}" alt="badge"></div>
                            </div>
                        </div>
                        <div class="badge_indicators">
                            <div class="ind_lt">
                                <div class="ind_lt_txt">
                                    Next badge level
                                    <span class="ind_txt">Networker</span>
                                </div>
                            </div>
                            <div class="ind_rt">
                                <div class="ind_lt_txt">
                                    Starting at
                                    <span class="ind_txt">30</span>
                                    <span>Points per month</span>
                                </div>
                            </div>
                        </div>
                        <div class="badge_nm danger">Badge Expired</div>
                    </div>
                    <div class="badge_sec_btm">
                        <h2 class="title_h2">Scan QR Codes with select Gimmzi partners locations and share Gimmzi with family and friends</h2>
                        <p>You have a Gimmizi badge because you are a Gimmzi Smart Rewards member. This badge allows to the full database of deals offered by Gimmizi small business partners. This badge also gives you the opportunity to earn points....</p>
                        <div class="btn_cont">
                            <a href="#" class="cmn_theme_btn full">Check Badge Power</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    
    @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            document.querySelectorAll("img").forEach(img => {
                img.src = img.src;
            });
        }, 500);
    });
</script
@endpush
</div>
