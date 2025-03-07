<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('admin.dashboard') }}" class="logo_text_custom">
                <img alt="Logo" src="{{ asset('admin_assets/logo/logo.png') }}" width="100%" height="auto" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                id="Path-94" fill="#000000" fill-rule="nonzero"
                                transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                            <path
                                d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                        </g>
                    </svg></span>
                <span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon id="Shape" points="0 0 24 0 24 24 0 24" />
                            <path
                                d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
                                id="Path-94" fill="#000000" fill-rule="nonzero" />
                            <path
                                d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
                                id="Path-94" fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
                        </g>
                    </svg></span>
            </button>

            <!--
   <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
   -->
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  {{ Request::is('admin/dashboard*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('admin.dashboard') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon flaticon-home"></i><span
                            class="kt-menu__link-text">Dashboard</span></a></li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Property Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/providers*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('providers.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-map-marker"></i><span
                            class="kt-menu__link-text">Provider</span></a>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/building*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('buildings.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-building"></i><span class="kt-menu__link-text">Provider
                            Building</span></a>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/provider-unit*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('provider-unit.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-th-large"></i><span class="kt-menu__link-text">Building
                            Unit</span></a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Travel & Tourism Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/short-rentals*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('short-rentals.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-map-marker"></i><span class="kt-menu__link-text">Short
                            Term Rental</span></a>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/hotel-resorts*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('hotel-resorts.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-map-marker"></i><span
                            class="kt-menu__link-text">Hotel/Resort</span></a>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/hotel-buildings*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('hotel-buildings.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-building"></i><span class="kt-menu__link-text">Hotel
                            Building</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/hotel-unit*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('hotel-unit.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-th-large"></i><span class="kt-menu__link-text">Hotel
                            Unit</span></a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">User Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/travel-tourism-user*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('admin.travel_tourism.userlist') }}"
                        class="kt-menu__link "><i class="kt-menu__link-icon fa fa-users"></i><span
                            class="kt-menu__link-text">Travel & Tourism Providers</span></a></li>

                <li class="kt-menu__item  {{ Request::is('admin/provider-user*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('provider-user.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-users"></i><span
                            class="kt-menu__link-text">Providers</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/consumers*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('consumers.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-user"></i><span
                            class="kt-menu__link-text">Consumers</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/apartment*') ? 'kt-menu__item--active' : '' }}"
                            aria-haspopup="true"><a href="{{ route('apartment-badge-consumers') }}" class="kt-menu__link "><i
                                    class="kt-menu__link-icon fa fa-user"></i><span
                                    class="kt-menu__link-text">Apartment Badge Consumers</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/merchants*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('merchants.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-user-circle"></i><span
                            class="kt-menu__link-text">Merchants</span></a></li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Merchant Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/business-profile*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('business-profile.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-briefcase"></i><span class="kt-menu__link-text">Merchant
                            Business</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/business-location*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('business-location.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-location-arrow"></i><span
                            class="kt-menu__link-text">Business Location</span></a></li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Faq Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/cms/faq*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('cms.faq.list') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-question-circle"></i><span
                            class="kt-menu__link-text">FAQ</span></a></li>
                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Master Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/badges*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('badges.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-archive"></i><span
                            class="kt-menu__link-text">Badges</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/titles*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('titles.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-check"></i><span class="kt-menu__link-text">User
                            Title</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/business-category*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('business-category.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-handshake"></i><span class="kt-menu__link-text">Business
                            Category</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/service-type*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('service-type.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-handshake"></i><span class="kt-menu__link-text">Service
                            Type</span></a>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/messages*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('admin.default.message') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-check"></i><span class="kt-menu__link-text">Tenant
                            Recognition</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/message-board*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('message-board.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-check"></i><span class="kt-menu__link-text">Message
                            Board</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/item-service*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('item-service.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-check"></i><span class="kt-menu__link-text">Item Or
                            Service</span></a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Plan Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/plans*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('plans.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-credit-card"></i><span
                            class="kt-menu__link-text">Plans</span></a>
                </li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">CMS Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/cms/privacy-policy*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true">
                    <a href="{{ route('cms.privacy_policy.edit') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-user-secret"></i><span class="kt-menu__link-text">Privacy
                            Policy</span>
                    </a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/cms/terms-condition*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('cms.terms_condition.edit') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-tasks"></i><span class="kt-menu__link-text">Terms &
                            Condition</span></a></li>

                <li class="kt-menu__item  {{ Request::is('admin/page-edit*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('admin.page-edit') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-tasks"></i><span class="kt-menu__link-text">Page</span></a></li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Deal Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/deals*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('deals.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fas fa-wallet"></i><span
                            class="kt-menu__link-text">Deals</span></a></li>
                <li class="kt-menu__item  {{ Request::is('admin/loyaltys*') ? 'kt-menu__item--active' : '' }}"
                aria-haspopup="true"><a href="{{ route('loyaltys.index') }}" class="kt-menu__link "><i
                        class="kt-menu__link-icon fas fa-wallet"></i><span
                        class="kt-menu__link-text">Loyalty Reward Program</span></a></li>

                <li class="kt-menu__section ">
                    <h4 class="kt-menu__section-text">Support Management</h4>
                    <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  {{ Request::is('admin/supports*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('supports.index') }}" class="kt-menu__link "><i
                            class="kt-menu__link-icon fa fa-check-square"></i><span class="kt-menu__link-text">Trouble
                            Ticket</span></a>
                </li>

                <li class="kt-menu__item  {{ Request::is('admin/prospective-apartment*') ? 'kt-menu__item--active' : '' }}"
                    aria-haspopup="true"><a href="{{ route('prospective-apartment.index') }}"
                        class="kt-menu__link "><i class="kt-menu__link-icon fa fa-building"></i><span
                            class="kt-menu__link-text">Prospective Providers</span></a>
                </li>

            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>

<!-- end:: Aside -->
