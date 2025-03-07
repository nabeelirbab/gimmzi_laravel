<div>
    <div class="acc_hd">
        <div class="container">
            <div class="acc_hd_row">
                <a href="#" class="cat_btn"><img src="{{asset('frontend_assets/images/hamburger-icon-blk.svg')}}" alt="hamburger icon"> Categories</a>
                <div class="srch_bar">
                    <form action="#">
                        <input type="text" placeholder="Zip Code, Town, or City">
                        <input type="submit">
                    </form>
                  </div>
            </div>
        </div>
    </div>

    <div class="acc_main_tab">
        <nav>
            <div class="container">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-wallet" type="button" role="tab">My Wallet</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-badges" type="button" role="tab">My Badges</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-favorites" type="button" role="tab">My Favorites</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-family-friends" type="button" role="tab">My Smart Family and Friends</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-inbox" type="button" role="tab">Inbox</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-account" type="button" role="tab">Account</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-referral" type="button" role="tab">Referral Program</button>
                  </div>
            </div>
        </nav>
          <div class="tab-content container" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-wallet" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>
                <livewire:frontend.consumer.consumer-profile-wallet/>

            </div>

            
            
            
            

            <div class="tab-pane fade" id="nav-badges" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>
                {{-- <img src="{{asset('frontend_assets/images/badge-logo1.png')}}" alt="logo" class="badge_top_logo"> --}}
                <livewire:frontend.consumer.consumer-profile-badges/>
               
            </div>


            <div class="tab-pane fade" id="nav-favorites" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>
                <livewire:frontend.consumer.consumer-profile-fevorites/>
                
            </div>
            <div class="tab-pane fade" id="nav-family-friends" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>

                <div class="ff_info_list">
                    <div class="row">
                        <div class="col-lg-6 ff_info_lt">
                            <div class="title_h3">My Smart Family and Family <span style="color: red;">(Coming Soon)</span></div>
                            <p>Introducing the My Smart Family and Friends Program — your
                                ticket to earning more points and strengthening your Gimmzi
                                community! Refer family and friends to join Gimmzi. Earn more
                                monthly points as your badge power increases!</p>

                            {{-- <div class="badge_info_listing">
                                <div class="title_h3">Badge Boosters and Gifts (coming soon)</div>
                                <div class="cmn_list_type">
                                    <ul>
                                        <li>Earn Badge Boosters from community or travel partners.</li>
                                        <li>Accept Badge Boosters from other Gimmzi members.</li>
                                        <li>Send Badge Boosters to new and existing Gimmzi members.</li>
                                        <li>Earn more points when you send Badge Boosters to new members.</li>
                                        <li>Re-gift the gifts you receive</li>
                                        <li>Accept gifts from members</li>
                                        <li>Share, exchange, and earn!</li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-6 ff_info_rt">
                            <div class="ff_info_box">
                                <div class="title_h3">Share using your unique link below with your family and friends:</div>
                                <div class="copylinkf cmn_form_elem">
                                    <form action="javascript:void(0);">
                                        <input type="text" value="" readonly>
                                        <button class="cmn_theme_btn"><img src="{{asset('frontend_assets/images/copy-icon-w.svg')}}" alt="copy" style="color:rgb(85, 84, 84) !important;">Copy</button>
                                    </form>
                                </div>
                                <div class="ff_info_scl">
                                    <ul>
                                        <li><a href="#" ><img src="{{asset('frontend_assets/images/fb-icon-un.svg')}}" alt="social icons"></a></li>
                                        <li><a href="#" ><img src="{{asset('frontend_assets/images/email-icon-un.svg')}}" alt="social icons"></a></li>
                                        <li><a href="#" ><img src="{{asset('frontend_assets/images/linked-in-icon-un.svg')}}" alt="social icons"></a></li>
                                        <li><a href="#" ><img src="{{asset('frontend_assets/images/x-icon-un.svg')}}" alt="social icons"></a></li>
                                        <li><a href="#" ><img src="{{asset('frontend_assets/images/whatsapp-icon-un.svg')}}" alt="social icons"></a></li>
                                    </ul>
                                </div>
                                <div class="ff_info_btm">
                                    <div class="ff_info_sm_card">
                                        <div class="title_h1">0/0</div>
                                        <div class="ff_info_sm_txt">Registered / Invites Sent</div>
                                    </div>
                                    <div class="ff_info_btm_txt">5 more registered to increase badge power</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="badge_table_sec">
                    <div class="badge_table_sec_label cmn_theme_btn">My List of Family and Friends</div>
                    <div class="cmn_table_elem">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="badge_gfts_row">
                                    <div class="table_lt">
                                        <div class="table-fluid">
                                            <table>
                                                <tr>
                                                    <th>Name <img src="{{asset('frontend_assets/images/icon-arw-down-blu.svg')}}" alt=""></th>
                                                    <th>New (members you added) or Existing</th>
                                                </tr>
                                                <tr>
                                                    <td>John Smith</td>
                                                    <td>New</td>
                                                </tr>
                                                <tr>
                                                    <td>Jane Smith</td>
                                                    <td>New</td>
                                                </tr>
                                                <tr>
                                                    <td>Sue Smith</td>
                                                    <td>Existing</td>
                                                </tr>
                                                <tr>
                                                    <td>Joe Smith</td>
                                                    <td>Existing</td>
                                                </tr>
                                                <tr>
                                                    <td>Sarah Smith</td>
                                                    <td>Existing</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> --}}


            </div>
            <div class="tab-pane fade" id="nav-inbox" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>
                <div class="acc_filter_bar">
                    <form action="#" class="cmn_form_elem">
                        <div class="acc_filter_row">
                            <ul>
                                {{-- <li><a href="#" class="active">All (5)</a></li>
                                <li><a href="#">Unread (2)</a></li>  --}}
                            </ul>
                        </div>
                    </form>
                </div>
                <div class="inbox_table">
                    <div class="title_h1">My Inbox <span style="color: red;">(Coming Soon)</span></div>
                    <div class="cmn_table_elem table_single">
                        <div class="badge_gfts_row">
                            <div class="table_lt">
                                <div class="table-fluid">
                                    {{-- <table class="double-colored">
                                        <tr>
                                            <th>From</th>
                                            <th>Subject</th>
                                            <th>Received <img src="images/table-arrow-down.svg" alt=""></th>
                                        </tr>
                                        <tr>
                                            <td>Tammy Jones</td>
                                            <td>Congratulations! You received 50 PO..</td>
                                            <td>1/20/2024 9:14 am</td>
                                        </tr>
                                        <tr>
                                            <td>Encore Apartments</td>
                                            <td>A new message board has been pos..</td>
                                            <td>210512024 5:52 pm</td>
                                        </tr>
                                        <tr>
                                            <td>Taco world</td>
                                            <td>A new deal has been added</td>
                                            <td>210712024 2:01 pm</td>
                                        </tr>
                                        <tr>
                                            <td>Frank's Tires</td>
                                            <td>A new loyal rewards program has..</td>
                                            <td>210712024 7:17 pm</td>
                                        </tr>
                                        <tr>
                                            <td>Sarah Smith</td>
                                            <td>Congratualtions! You received a rec..</td>
                                            <td>2/08/2024 5:52 pm</td>
                                        </tr>
                                    </table> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-account" role="tabpanel">
                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>

                <livewire:frontend.consumer.consumer-account/>
            </div>


            <div class="tab-pane fade" id="nav-referral" role="tabpanel">

                <div class="key_scores">
                    <div class="row">
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Points Available</span>
                                <span class="score_pnt">{{number_format($user->point)}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Deals in Wallets</span>
                                <span class="score_pnt">{{$deal_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Travel and Tourism Badges</span>
                                <span class="score_pnt">{{ $travel_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Family and Friends</span>
                                <span class="score_pnt">00</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Next Point Cycle</span>
                                <span class="score_pnt">{{$point_cycle}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Enrolled Loyalty Punch Cards</span>
                                <span class="score_pnt">{{$loyalty_count}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Community Badges</span>
                                <span class="score_pnt">{{ $community_badge_count }}</span>
                            </div>
                        </div>
                        <div class="col-lg-3 ks_col">
                            <div class="ks_box">
                                <span>Referral Cash Balance</span>
                                <span class="score_pnt">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="key_rwd_text title_h3">Smart Rewards Member Since: {{ $member_since }}</div>
                <div class="ref_prg_sec">
                    <div class="row">
                        <div class="col-lg-8 ref_prg_lt">
                            <div class="ref_prg_title">
                                <img src="{{asset('frontend_assets/images/site-icon.png')}}" alt="site-icon">
                                <div class="title_h1">immzi Referral Program <span style="color: red;">(Coming Soon)</span></div>
                            </div>
                            <p>Ready to earn? Earn
                                by referring businesses to join our
                                cash rewards
                                community. Ask the companies you refer to use your unique Gimmzi referral
                                code provided below so you can receive credit. Businesses must enter your
                                code during sign-up for tracking. Watch your rewards grow, and track progress.</p>
                        </div>
                        <div class="col-lg-4 ref_prg_rt">
                            <div class="ff_info_sm_card">
                                <div class="title_h1">$0.00</div>
                                <div class="ff_info_sm_txt">Total Payout Amount as of today's date</div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="ref_code_sec">
                    <h2 class="title_h1">Your Gimmzi Referral Code is <span>BH5855</span></h2>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="ref_code_box">
                                <h3 class="title_h3">Small Business Partner Referrals:</h3>
                                <ul>
                                    <li>Every 5 businesses you sign up on Gimmzi Intro Plan = <strong>$25</strong></li>
                                    <li>Every 2 businesses you sign up on Gimmzi Boost Plan or higher = <strong>$100</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ref_code_box">
                                <h3 class="title_h3">Travel Partner Referrals:</h3>
                                <ul>
                                    <li>Every 1 vacation agency and short term rental owner you sign on Essential Plan or higher =
                                         <strong>$100</strong></li>
                                    <li>Every 1 hotel or resort you sign on Essential Plan or Higher = <strong>$200</strong></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="ref_code_box">
                                <h3 class="title_h3">Community Partner Referrals:</h3>
                                <ul>
                                    <li>Every I community partner including apartment or student housing, HOA and COA you sign on any plan =
                                        <strong>$200</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ref_payout_sec">
                    <div class="ref_payout_head">
                        <h2 class="title_h1">Your Payout Progress</h2>
                        <div class="ref_pay_btn">
                            <a href="#">View Details</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 ref_payout_col">
                            <div class="ref_payout">
                                <ul>
                                    <li>Small Business Partners (Intro Plan): 0/0</li>
                                    <li>Expected Payout Amount: $0.00</li>
                                    <li>Expected Payout Date:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 ref_payout_col">
                            <div class="ref_payout">
                                <ul>
                                    <li>Small Business Partners (Intro Plan): 0/0</li>
                                    <li>Expected Payout Amount: $0.00</li>
                                    <li>Expected Payout Date:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 ref_payout_col">
                            <div class="ref_payout">
                                <ul>
                                    <li>Small Business Partners (Intro Plan): 0/0</li>
                                    <li>Expected Payout Amount: $0.00</li>
                                    <li>Expected Payout Date:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 ref_payout_col">
                            <div class="ref_payout">
                                <ul>
                                    <li>Small Business Partners (Intro Plan): 0/0</li>
                                    <li>Expected Payout Amount: $0.00</li>
                                    <li>Expected Payout Date:</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 ref_payout_col">
                            <div class="ref_payout">
                                <ul>
                                    <li>Small Business Partners (Intro Plan): 0/0</li>
                                    <li>Expected Payout Amount: $0.00</li>
                                    <li>Expected Payout Date:</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
          </div>
    </div>
    

    <!-- test popup section start -->
    <div class="cmn_gap">
        <div class="container">
            {{-- <button type="button" class="cmn_theme_btn" data-bs-toggle="modal" data-bs-target="#myFabModal">
                my favorite
            </button> --}}
            {{-- <button type="button" class="cmn_theme_btn" data-bs-toggle="modal" data-bs-target="#redeemModal">
                Redeem
            </button> --}}
            {{-- <button type="button" class="cmn_theme_btn" data-bs-toggle="modal" data-bs-target="#loyaltyProgram">
                terms and condition and deal popup
            </button> --}}
        </div>
    </div>
    <!-- test popup section end -->


</div>
