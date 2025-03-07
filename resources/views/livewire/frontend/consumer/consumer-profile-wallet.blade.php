{{-- @dd($deals) --}}
<div>
    <div>    
        <div class="acc_filter_bar">
            {{-- <form action="#" class="cmn_form_elem"> --}}
                <div class="acc_filter_row">
                    <ul>
                        <li><a href="javascript:void(0);" wire:click="setFilter('all')"  class="{{ $selectedFilter === 'all' ? 'active' : '' }}">All ({{$all_count}})</a></li>
                        <li><a href="javascript:void(0);" wire:click="setFilter('deals')" class="{{ $selectedFilter === 'deals' ? 'active' : '' }}">Deals ({{$active_deal_count}})</a></li>
                        <li><a href="javascript:void(0);" wire:click="setFilter('loyalty')" 
                            class="{{ $selectedFilter === 'loyalty' ? 'active' : '' }}">Loyalty Punch Cards ({{$active_loyalty_count}})</a></li>
                        <li><a href="javascript:void(0);" wire:click="setFilter('expired')"  class="{{ $selectedFilter === 'expired' ? 'active' : '' }}">Expired ({{$loyaltyExpireCount}})</a></li>
                        <li><a href="javascript:void(0);" wire:click="setFilter('redeemed')"  class="{{ $selectedFilter === 'redeemed' ? 'active' : '' }}">Redeemed ({{$deal_redeemed_count}})</a></li>
                    </ul>
                    <div class="rgt_bar">
                        <label>Sort by:</label>
                        <select>
                            <option>Added to Wallet Date</option>
                        </select>
                    </div>
                </div>
            {{-- </form> --}}
        </div>
    </div>
    <div class="my_badges_wrapper">
        <h1 class="title_h1">Gimmzi Deals and Loyalty Rewards Programs </h1>
        <div class="com_list_row row">
            @if ($selectedFilter == 'all')
                @foreach($deals as $alldeal)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                                <div class="badge lg">{{$alldeal->deal->discount_amount}}  OFF</div>
                                <div class="com_list_box_top">
                                    @if($alldeal->deal->deal_image === '')
                                    <img src="{{asset($alldeal->business->logo_image)}}" alt="" class="com_list_box_top_img">
                                    @else
                                    {{-- <img src="{{$alldeal->deal->deal_image}}" alt="" class="com_list_box_top_img"> --}}
                                        @php
                                        $dealImageBaseName = basename($alldeal->deal->deal_image);
                                        $directoryPath = dirname($alldeal->deal->deal_image);
                                        $folderPath = $directoryPath.'/';
                                        $baseUrl = asset('');
                                        $relativeDirectoryPath = str_replace($baseUrl, '', $directoryPath);
                                        $filePath = public_path($relativeDirectoryPath . '/' . $dealImageBaseName);
                                        $fileExists = file_exists($filePath);
                                    
                                        @endphp

                                        @if($fileExists)
                                            <img src="{{$alldeal->deal->deal_image}}" alt="" class="com_list_box_top_img">
                                        @else
                                            <img src="{{$alldeal->business->logo_image}}" alt="" class="com_list_box_top_img">
                                        @endif
                                    @endif
                                    <div class="voucher_list">
                                        <ul>
                                            <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                            <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="com_list_box_btm">
                                    {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                    <h2 class="title_h3"><a href="#">{{$alldeal->business->business_name}}</a></h2>
                                    <div class="hgt_txt">
                                        {{$alldeal->deal->suggested_description}}<br>
                                        {{$alldeal->deal->point}} points to redeem
                                    </div>
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_deal_redeem({{$alldeal->id}})">Redeem</a>
                                    </div>
                                </div>
                                <div class="tt_card_btm_bar">
                                    <?php if($alldeal->deal->end_Date){
                                            $expire = 'Expires on '. date('F j, Y', strtotime($alldeal->deal->end_Date));
                                        }else{
                                            $expire = 'No Expiration Date'; 
                                        }
                                        ?>
                                    Redeemed on {{ date('F j, Y', strtotime($alldeal->deal->created_at)) }} | {{$expire}}
                                </div>
                            </div>
                    </div>
                @endforeach
                @foreach($loyalties as $all_loyalty)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                            @if($all_loyalty->loyalty->program_points != null)
                            <div class="badge">Earn Up to {{$all_loyalty->loyalty->program_points}} Points</div>
                            @else
                            @endif
                            <div class="com_list_box_top">
                                @if($all_loyalty->loyalty->loyalty_image === '')
                                    <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                @else
                                    @php
                                    $dealImageBaseName = basename($all_loyalty->loyalty->loyalty_image);
                                    $directoryPath = dirname($all_loyalty->loyalty->loyalty_image);
                                    $folderPath = $directoryPath.'/';
                                    $baseUrl = asset('');
                                    $relativeDirectoryPath = str_replace($baseUrl, '', $directoryPath);
                                    $filePath = public_path($relativeDirectoryPath . '/' . $dealImageBaseName);
                                    $fileExists = file_exists($filePath);
                                
                                    @endphp

                                    @if($fileExists)
                                        <img src="{{$all_loyalty->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img">
                                    @else
                                        <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                    @endif
                                @endif
                                <div class="voucher_list">
                                    <ul>
                                        <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                        <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="com_list_box_btm">
                                {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                <h2 class="title_h3"><a href="#">{{$all_loyalty->business->business_name}}</a></h2>
                                {{-- <p>$81.54 of $500,
                                    16% towards goal</p> --}}
                                <div class="hgt_txt">
                                    {{-- Spend $500 and get $10 OFF next purchase <br>
                                    Earn up to 20 points per purchase --}}
                                    {{$all_loyalty->loyalty->program_name}}
                                </div>
                                @if($all_loyalty->loyalty->purchase_goal == 'free')
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_free_loyalty_redeem({{$all_loyalty->id}})">Punch</a>
                                        
                                    </div>
                                @else
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_discount_loyalty_redeem({{$all_loyalty->id}})">Punch discount</a>
                                        
                                    </div>
                                @endif

                            </div>
                            <div class="tt_card_btm_bar">
                                <?php if($all_loyalty->loyalty->end_on != null){
                                    $expire = 'Expires on '.date('F j, Y', strtotime($all_loyalty->loyalty->end_on));
                                }else{
                                    $expire = 'No Expiration Date'; 
                                }
                                ?>
                                Added to Wallet on {{ date('F j, Y', strtotime($all_loyalty->loyalty->created_at)) }} | {{$expire}}
                            </div>
                        </div>
                    </div>
                @endforeach
            
            @elseif ($selectedFilter == 'deals')

                @foreach($finalDeals as $alldeal)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                                <div class="badge lg">{{$alldeal->deal->discount_amount}}  OFF</div>
                                <div class="com_list_box_top">
                                    
                                    @if(($alldeal->deal->deal_image === ''))
                                        <img src="{{$alldeal->business->logo_image}}" alt="" class="com_list_box_top_img">
                                    @else

                                        @php
                                            $dealImageBaseName = basename($alldeal->deal->deal_image);
                                            $directoryPath = dirname($alldeal->deal->deal_image);
                                            $folderPath = $directoryPath.'/';
                                            $baseUrl = asset('');
                                            $relativeDirectoryPath = str_replace($baseUrl, '', $directoryPath);
                                            $filePath = public_path($relativeDirectoryPath . '/' . $dealImageBaseName);
                                            $fileExists = file_exists($filePath);
                                        
                                        @endphp

                                        @if($fileExists)
                                            <img src="{{$alldeal->deal->deal_image}}" alt="" class="com_list_box_top_img">
                                        @else
                                            <img src="{{$alldeal->business->logo_image}}" alt="" class="com_list_box_top_img">
                                        @endif
                                    @endif
                                    <div class="voucher_list">
                                        <ul>
                                            <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                            <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="com_list_box_btm">
                                    {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                    <h2 class="title_h3"><a href="#">{{$alldeal->business->business_name}}</a></h2>
                                    <div class="hgt_txt">
                                        {{$alldeal->deal->suggested_description}}<br>
                                        {{$alldeal->deal->point}} points to redeem
                                    </div>
                                    {{-- <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_deal_redeem({{$alldeal->id}})">Redeem</a>
                                    </div> --}}
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_deal_redeem({{$alldeal->id}})">Redeem</a>
                                    </div>
                                </div>
                                <div class="tt_card_btm_bar">
                                    <?php if($alldeal->deal->end_Date){
                                            $expire = 'Expires on '. date('F j, Y', strtotime($alldeal->deal->end_Date));
                                        }else{
                                            $expire = 'No Expiration Date'; 
                                        }
                                        ?>
                                    Redeemed on {{ date('F j, Y', strtotime($alldeal->deal->created_at)) }} | {{$expire}}
                                </div>
                            </div>
                    </div>
                    {{-- @endif --}}

                @endforeach

            @elseif ($selectedFilter == 'loyalty')
                @foreach($loyalties as $all_loyalty)
                    @if ($all_loyalty->loyalty->end_on > $today)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                            @if($all_loyalty->loyalty->program_points != null)
                            <div class="badge">Earn Up to {{$all_loyalty->loyalty->program_points}} Points</div>
                            @else
                            @endif
                            <div class="com_list_box_top">
                                @if($all_loyalty->loyalty->loyalty_image === '')
                                        <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                        @else
                                        {{-- <img src="{{$all_loyalty->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img"> --}}
                                            @php
                                            $dealImageBaseName = basename($all_loyalty->loyalty->loyalty_image);
                                            $directoryPath = dirname($all_loyalty->loyalty->loyalty_image);
                                            $folderPath = $directoryPath.'/';
                                            $baseUrl = asset('');
                                            $relativeDirectoryPath = str_replace($baseUrl, '', $directoryPath);
                                            $filePath = public_path($relativeDirectoryPath . '/' . $dealImageBaseName);
                                            $fileExists = file_exists($filePath);
                                        
                                            @endphp

                                            @if($fileExists)
                                                <img src="{{$all_loyalty->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img">
                                            @else
                                                <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                            @endif
                                        @endif
                                {{-- <img src="{{asset('frontend_assets/images/com-list-bg1.jpeg')}}" alt="" class="com_list_box_top_img"> --}}
                                <div class="voucher_list">
                                    <ul>
                                        <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                        <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="com_list_box_btm">
                                {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                <h2 class="title_h3"><a href="#">{{$all_loyalty->business->business_name}}</a></h2>
                                {{-- <p>$81.54 of $500,
                                    16% towards goal</p> --}}
                                <div class="hgt_txt">
                                    {{-- Spend $500 and get $10 OFF next purchase <br>
                                    Earn up to 20 points per purchase --}}
                                    {{$all_loyalty->loyalty->program_name}}
                                </div>
                                @if($all_loyalty->loyalty->purchase_goal == 'free')
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_free_loyalty_redeem({{$all_loyalty->id}})">Punch</a>
                                        
                                    </div>
                                @else
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_discount_loyalty_redeem({{$all_loyalty->id}})">Punch discount</a>
                                        
                                    </div>
                                @endif
                                {{-- <div class="tt_btns_grp">
                                    <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_loyalty_redeem">Punch</a>
                                </div> --}}
                            </div>
                            <div class="tt_card_btm_bar">
                                <?php if($all_loyalty->loyalty->end_on != null){
                                    $expire = 'Expires on '.date('F j, Y', strtotime($all_loyalty->loyalty->end_on));
                                }else{
                                    $expire = 'No Expiration Date'; 
                                }
                                ?>
                                Added to Wallet on {{ date('F j, Y', strtotime($all_loyalty->loyalty->created_at)) }} | {{$expire}}
                            </div>
                        </div>
                    </div>
                    @elseif($all_loyalty->loyalty->end_on == null)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                            @if($all_loyalty->loyalty->program_points != null)
                            <div class="badge">Earn Up to {{$all_loyalty->loyalty->program_points}} Points</div>
                            @else
                            @endif
                            <div class="com_list_box_top">
                                @if($all_loyalty->loyalty->loyalty_image === '')
                                        <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                        @else
                                        {{-- <img src="{{$all_loyalty->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img"> --}}
                                        @php
                                    $dealImageBaseName = basename($all_loyalty->loyalty->loyalty_image);
                                    $directoryPath = dirname($all_loyalty->loyalty->loyalty_image);
                                    $folderPath = $directoryPath.'/';
                                    $baseUrl = asset('');
                                    $relativeDirectoryPath = str_replace($baseUrl, '', $directoryPath);
                                    $filePath = public_path($relativeDirectoryPath . '/' . $dealImageBaseName);
                                    $fileExists = file_exists($filePath);
                                
                                    @endphp

                                    @if($fileExists)
                                        <img src="{{$all_loyalty->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img">
                                    @else
                                        <img src="{{$all_loyalty->business->logo_image}}" alt="" class="com_list_box_top_img">
                                    @endif
                                        @endif
                                {{-- <img src="{{asset('frontend_assets/images/com-list-bg1.jpeg')}}" alt="" class="com_list_box_top_img"> --}}
                                <div class="voucher_list">
                                    <ul>
                                        <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                        <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="com_list_box_btm">
                                {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                <h2 class="title_h3"><a href="#">{{$all_loyalty->business->business_name}}</a></h2>
                                {{-- <p>$81.54 of $500,
                                    16% towards goal</p> --}}
                                <div class="hgt_txt">
                                    {{-- Spend $500 and get $10 OFF next purchase <br>
                                    Earn up to 20 points per purchase --}}
                                    {{$all_loyalty->loyalty->program_name}}
                                </div>
                                {{-- <div class="tt_btns_grp">
                                    <a href="#" class="cmn_theme_btn full">Punch</a>
                                </div> --}}
                                @if($all_loyalty->loyalty->purchase_goal == 'free')
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_free_loyalty_redeem({{$all_loyalty->id}})">Punch</a>
                                        
                                    </div>
                                @else
                                    <div class="tt_btns_grp">
                                        <a href="javascript:void(0);" class="cmn_theme_btn full" wire:click="all_discount_loyalty_redeem({{$all_loyalty->id}})">Punch discount</a>
                                        
                                    </div>
                                @endif
                            </div>
                            <div class="tt_card_btm_bar">
                                <?php if($all_loyalty->loyalty->end_on != null){
                                    $expire = 'Expires on '.date('F j, Y', strtotime($all_loyalty->loyalty->end_on));
                                }else{
                                    $expire = 'No Expiration Date'; 
                                }
                                ?>
                                Added to Wallet on {{ date('F j, Y', strtotime($all_loyalty->loyalty->created_at)) }} | {{$expire}}
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach

            @elseif($selectedFilter == 'expired')
                @if($loyaltyExpireQuery)
                    @foreach($loyaltyExpireQuery as $loyalty_expire)
                        <div class="col-md-4 com_list_col my_fab_col">
                            <div class="com_list_box">
                                <div class="badge">{{$loyalty_expire->business->business_name}}</div>
                                <div class="com_list_box_top">
                                    @if($loyalty_expire->loyalty->loyalty_image === '')
                                        <img src="{{asset($loyalty_expire->business->logo_image)}}" alt="" class="com_list_box_top_img">
                                    @else
                                        <img src="{{$loyalty_expire->loyalty->loyalty_image}}" alt="" class="com_list_box_top_img">
                                    @endif
                                    <div class="voucher_list">
                                        <ul>
                                            <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                            <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="com_list_box_btm">
                                    {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                    <h2 class="title_h3"><a href="#">{{$loyalty_expire->business->business_name}}</a></h2>
                                    <div class="hgt_txt">
                                        {{$loyalty_expire->loyalty->program_name}}
                                    </div>
                                    {{-- <div class="tt_btns_grp">
                                        <a href="#" class="cmn_theme_btn bordered full">Re-Add Deal to Wallet</a>
                                    </div> --}}
                                </div>
                                <div class="tt_card_btm_bar">
                                    <?php if($loyalty_expire->loyalty->end_on){
                                        $expire ='Expires on '. date('F j, Y', strtotime($loyalty_expire->loyalty->end_on));
                                    }else{
                                        $expire = 'No Expiration Date'; 
                                    }
                                    ?>
                                    Redeemed on {{ date('F j, Y', strtotime($loyalty_expire->loyalty->created_at)) }} | {{$expire}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @elseif($selectedFilter == 'redeemed')

                @if($dealRedeemedQuery)
                    @foreach($dealRedeemedQuery as $redeemed_deal)
                    <div class="col-md-4 com_list_col my_fab_col">
                        <div class="com_list_box">
                            <div class="badge">{{$redeemed_deal->business->business_name}}</div>
                            <div class="com_list_box_top">
                                @if($redeemed_deal->deal->deal_image === '')
                                    <img src="{{asset($redeemed_deal->business->logo_image)}}" alt="" class="com_list_box_top_img">
                                @else
                                    <img src="{{$redeemed_deal->deal->deal_image}}" alt="" class="com_list_box_top_img">
                                @endif
                                <div class="voucher_list">
                                    <ul>
                                        <li><a href="#"><img src="images/vou-share-icon.svg" alt=""></a></li>
                                        <li><a href="#"><img src="images/vou-wishlist-icon.svg" alt=""></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="com_list_box_btm">
                                {{-- <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a> --}}
                                <h2 class="title_h3"><a href="#">{{$redeemed_deal->business->business_name}}</a></h2>
                                <div class="hgt_txt">
                                    {{$redeemed_deal->deal->suggested_description}}<br>
                                    {{$redeemed_deal->deal->point}} points to redeem
                                </div>
                                {{-- <div class="tt_btns_grp">
                                    <a href="#" class="cmn_theme_btn bordered full">Re-Add Deal to Wallet</a>
                                </div> --}}
                            </div>
                            <div class="tt_card_btm_bar">
                                <?php if($redeemed_deal->deal->end_Date){
                                    $expire ='Expires on '. date('F j, Y', strtotime($redeemed_deal->deal->end_Date));
                                }else{
                                    $expire = 'No Expiration Date'; 
                                }
                                ?>
                                Redeemed on {{ date('F j, Y', strtotime($redeemed_deal->deal->created_at)) }} | {{$expire}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

            @endif
                    
            {{-- <div class="col-md-4 com_list_col my_fab_col">
                <div class="com_list_box">
                    <div class="badge">Wilson's Grocery Mart</div>
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
                        <a href="#" class="tt_info_btn"><img src="images/icon-info-blk.svg" alt=""></a>
                        <h2 class="title_h3"><a href="#">Wilson's Grocery Mart</a></h2>
                        <div class="hgt_txt">
                            25% OFF MEDIUM DRINK <br>
                            10 points to redeem
                        </div>
                        <div class="tt_btns_grp">
                            <a href="#" class="cmn_theme_btn bordered full">Re-Add Deal to Wallet</a>
                        </div>
                    </div>
                    <div class="tt_card_btm_bar">
                        Redeemed on December 1, 2023 | Expires on January 18, 2024
                    </div>
                </div>
            </div> --}}
    
    
        </div>
    </div>

    <div class="modal fade redeemModal" id="discountLoyaltyredeemModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="logo"><img src="{{asset('frontend_assets/images/logo-nw.svg')}}" alt=""></div>
                <div class="title_h2">{{$loyalty_business_name}}</div>
                <div class="cmn_sub_title">{{$loyalty_name}}</div>
                <div class="popup_nrml_list">
                    <ul>
                        <li>Confirm you are at a participating location below. Show this screen to an associate at checkout.</li>
                        <li>{{$loyalty_business_name}} Associate will provide to you or enter their Gimmzi ID and submit below at checkout.</li>
                    </ul>
                </div>
                <form >
                    <div class="popup_range_wrap">
                        <div class="range-slider">
                            <div id="tooltip"></div>
                            {{-- <input id="range" type="range" step="1" value="10" min="0" max="45"> --}}
                            <input id="range" type="range" step="1" value="{{$loyalty_discount_amount}}" min="0" max="{{$loyalty_spend_amount}}">
                        </div>
                        {{-- <div class="range-slider-new">
                            <input class="range-slider__range" type="range" value="{{$loyalty_discount_amount}}" min="0" max="{{$loyalty_spend_amount}}" step="1">
                            <span class="range-slider__value">{{$loyalty_discount_amount}}</span>
                        </div> --}}
                        <div class="range_dtls">
                            <span class="title">Dollar</span>
                            <div class="input_grp">
                                <input type="number" value=""> <span></span> <input type="number" value="">
                            </div>
                            {{-- <a href="#" class="cmn_theme_btn bordered full">Add reciept</a> --}}
                        </div>
                    </div>
                    <div class="select_loc_bar">
                        <select>
                            @if($loyalty_business_locations && $loyalty_business_locations->isNotEmpty())
                                @foreach($loyalty_business_locations as $location)
                                <option value="{{$location->id}}">{{$location->address}}</option>
                                @endforeach
                            @else
                            <option>No locations available</option>
                            @endif
                        </select>
                    </div>
                    <div class="loc_select_fileds">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                    </div>
                    <div class="popup_form_submit">
                        <input type="submit" value="Submit" class="cmn_theme_btn">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade redeemModal" id="freeLoyaltyredeemModal" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="logo"><img src="{{asset('frontend_assets/images/logo-nw.svg')}}" alt=""></div>
                <div class="title_h2">{{$loyalty_business_name}}</div>
                <div class="cmn_sub_title">{{$loyalty_name}}</div>
                <div class="popup_nrml_list">
                    <ul>
                        <li>Confirm you are at a participating location below. Show this screen to an associate at checkout.</li>
                        <li>{{$loyalty_business_name}} Associate will provide to you or enter their Gimmzi ID and submit below at checkout.</li>
                    </ul>
                </div>
                <form wire:submit.prevent="all_free_loyalty">
                    <div class="gift_card_choose_wrap">
                        <span>Remaining 0 out of {{$haveToBuy}}</span>
                        <div class="gift_card_choose_items for-wrap-items">
                            @for ($i = 0; $i < $haveToBuy; $i++)
                            <label>
                                <input type="checkbox" value="{{ $i }}">
                                {{-- <span class="gift_card_wrap_sm" ><span style="background-image: url('{{ asset('frontend_assets/images/gift-wrap-gr.svg') }}');"></span></span> --}}
                                <span class="gift_card_wrap_sm">
                                    <span 
                                        class="toggle-image" 
                                        style="background-image: url('{{ asset('frontend_assets/images/gift-wrap-gr.svg') }}');" 
                                        data-default="{{ asset('frontend_assets/images/gift-wrap-gr.svg') }}" 
                                        data-alternate="{{ asset('frontend_assets/images/gift-wrap-clr.svg') }}">
                                    </span>
                                </span>
                            </label>
                            @endfor
                            <button><img src="{{asset('frontend_assets/images/icon-gift-card-w.svg')}}" alt=""> FREE</button>
                        </div>
                    </div>
                    
                    <div class="select_loc_bar">
                        <select wire:model.defer="selected_location_id">
                            @if($loyalty_business_locations && $loyalty_business_locations->isNotEmpty())
                                @foreach($loyalty_business_locations as $location)
                                <option value="{{$location->id}}">{{$location->address}}</option>
                                @endforeach
                            @else
                            <option>No locations available</option>
                            @endif
                        </select>
                    </div>
                    <div class="loc_select_fileds">
                        <input type="text" wire:model.defer="number1">
                        <input type="text" wire:model.defer="number2">
                        <input type="text" wire:model.defer="number3">
                        <input type="text" wire:model.defer="number4">
                        <input type="text" wire:model.defer="number5">
                        <input type="text" wire:model.defer="number6">
                        <input type="text" wire:model.defer="number7">
                    </div>
                    {{-- <div wire:ignore> --}}
                    <input type="hidden" id="imageSelectCounter" wire:model.defer="selectedCount">

                    {{-- </div> --}}
                    <div class="popup_form_submit">
                        <input type="submit" value="Submit" class="cmn_theme_btn">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade redeemModal" id="dealredeemModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="logo"><img src="{{asset('frontend_assets/images/logo-nw.svg')}}" alt=""></div>
                <div class="title_h2">{{$deal_business_name}}</div>
                <div class="cmn_sub_title">{{$deal_name}}</div>
                <div class="popup_nrml_list">
                    <ul>
                        <li>Confirm you are at a participating location below.Show this screen to an associate at checkout.</li>
                        <li>{{$deal_business_name}} Associate will provide to you or enter their Gimmzi ID and submit below at checkout.</li>
                    </ul>
                </div>
                <form >

                    <div class="select_loc_bar">
                        <select>
                            @if($deal_business_locations && $deal_business_locations->isNotEmpty())
                                @foreach($deal_business_locations as $location)
                                <option value="{{$location->id}}">{{$location->address}}</option>
                                @endforeach
                            @else
                            <option>No locations available</option>
                            @endif
                        </select>
                    </div>
                    <div class="loc_select_fileds">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                        <input type="number">
                    </div>
                    <div class="popup_form_submit">
                        <input type="submit" value="Submit" class="cmn_theme_btn">
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function(event) {
            @this.on('redeemedOpenModalOpen', data => {
                $("#dealredeemModal").modal('show');
            });
            @this.on('punchOpenModalOpen', data => {
                $("#freeLoyaltyredeemModal").modal('show');
            });
            @this.on('discountPunchModalOpen', data => {
                $("#discountLoyaltyredeemModal").modal('show');
            });
            
            let selectedCount = 0;
            // const updateSelectedCount = () => {
            //     document.getElementById('imageSelectCounter').value = selectedCount;
            //     console.log('Selected images count:', selectedCount);
            // };
            const attachToggleImageListeners = () => {
                const toggleImages = document.querySelectorAll('.toggle-image');
                toggleImages.forEach(image => {
                    image.addEventListener('click', function (event) {
                        event.stopPropagation();
                        const defaultImage = this.getAttribute('data-default');
                        const alternateImage = this.getAttribute('data-alternate');
                        const currentBackground = this.style.backgroundImage;
                        if (currentBackground.includes(defaultImage)) {
                            this.style.backgroundImage = `url('${alternateImage}')`;
                            selectedCount++;
                        } else {
                            this.style.backgroundImage = `url('${defaultImage}')`;
                            selectedCount--;
                        }
                        document.getElementById('imageSelectCounter').value = selectedCount;
                        // $("#imageSelectCounter").val(selectedCount);
                        // @this.set('imageSelectCounter',selectedCount);
                        // setTimeout(() => {
                        //     Livewire.emit('updateSelectedCount', selectedCount);
                        // }, 3000);
                        console.log('Selected images count:', selectedCount);
                    });
                });
            };

            attachToggleImageListeners();
            Livewire.hook('message.processed', () => {
                attachToggleImageListeners();
            });









        });

        

    </script>
    @endpush

</div>
