<footer class="main-new-footer">
    <div class="ftr-top">
        <div class="container">
            <div class="ftr-top-blk">
                <ul class="ftr-ul">
                    <li>
                        <a href="{{ route('frontend.market-universe', ['type' => 'loyaltyRewards']) }}">Loyalty Rewards</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.market-universe', ['type' => 'gimmziDeals']) }}">Gimmzi Deals</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Earn More Points</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Become a Partner</a>
                    </li>
                </ul>
                <a href="javascript:void(0)" class="ftr-logo">
                    <img loading="lazy" src="{{ asset('frontend_assets/images/ftr-logo.svg') }}"
                        alt="footer logo">
                </a>
                <p>Do Not Sell My Personal Information</p>
                <ul class="ssl-ftr">
                    <li>
                        <a target="_blank" href="https://www.facebook.com/gimmzismartrewards">
                            <img loading="lazy" src="{{ asset('frontend_assets/images/fb.svg') }}"
                                alt="fb icon">
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://www.instagram.com/gimmzi">
                            <img loading="lazy" src="{{ asset('frontend_assets/images/insta.svg') }}"
                                alt="insta icon">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="ftr-btm">
        <div class="container">
            <div class="ftr-btm-wrap">
                <div class="ftr-btm-wrap-lft">
                    © {{ now()->format('Y') }} <a href="/">Gimmzi LLC</a>. All rights reserved.
                </div>
                <ul class="ftr-btm-wrap-rit">
                    <li>
                        <a href="{{ route('frontend.terms-of-use') }}">Terms of Services</a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.privacy-policy') }}">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>