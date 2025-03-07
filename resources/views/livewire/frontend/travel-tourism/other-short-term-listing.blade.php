<div>

    @push('style')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.css" />
    @endpush
    <div class="notification-area">
        <div class="container">
            <a href="{{ route('frontend.travel-tourism.list') }}" class="nti-btn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 20C4.5 20 0 15.5 0 10C0 4.5 4.5 0 10 0C15.5 0 20 4.5 20 10C20 15.5 15.5 20 10 20ZM10 1.25C5.1875 1.25 1.25 5.1875 1.25 10C1.25 14.8125 5.1875 18.75 10 18.75C14.8125 18.75 18.75 14.8125 18.75 10C18.75 5.1875 14.8125 1.25 10 1.25Z"
                        fill="currentColor" />
                    <path
                        d="M14.4375 10.625H7.375L9.8125 12.625C10.0625 12.875 10.125 13.25 9.875 13.5C9.625 13.75 9.25 13.8125 9 13.5625L5.1875 10.4375C5.0625 10.375 5 10.1875 5 10C5 9.81253 5.0625 9.62503 5.25 9.50003L9.0625 6.37503C9.1875 6.25003 9.3125 6.25003 9.4375 6.25003C9.625 6.25003 9.8125 6.31253 9.9375 6.50003C10.1875 6.75003 10.125 7.18753 9.875 7.37503L7.375 9.37503H14.4375C14.8125 9.37503 15.0625 9.62503 15.0625 10C15.0625 10.375 14.75 10.625 14.4375 10.625Z"
                        fill="currentColor" />
                </svg>
                Go Back to search
            </a>
        </div>
    </div>
    <section class="hotel-portal">
        <div class="container">
            <div class="hotel-portal-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="hotel-portal-left-panel">
                            <div class="hotel-portal-logo">
                                <img src="{{ $travel_tourism->short_term_logo }}" style="border-radius: 5px;"
                                    alt="title">
                            </div>
                            <div class="hotel-portal-info">
                                <h1>{{ $travel_tourism->name }} - 
                                    {{$travel_tourism->city ?? ''}} {{$travel_tourism->city ? ',' : ''}} {{$travel_tourism->state->name}}</h1>
                                    
                                <ul class="info-list">
                                    <li>
                                        <img src="{{ asset('frontend_assets/images/location-icon44.svg') }}" class="info-icon" alt="">
                                        <strong>{{ $travel_tourism->address }}, {{ $travel_tourism->zip_code }}</strong>

                                    </li>
                                    <li>
                                        <img src="{{ asset('frontend_assets/images/phone-icon.svg') }}" class="info-icon" alt="">
                                        <strong>
                                            <a href="tel:264-392-7136">{{ $travel_tourism->phone }}</a>
                                        </strong>
                                    </li>
                                </ul>
                                <ul class="media-list">
                                    <li>
                                        <label class="media-save-lbl">
                                            <input type="checkbox" <?php if($travel_tourism->favourite_tourism == 1){ echo 'checked'; }else{ echo 'disabled';}?>>
                                            <span wire:click='saveList({{$travel_tourism->id}},"travel_type")'>
                                                <svg width="438" height="360" viewBox="0 0 438 360" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M412.28 45.4597C396.633 24.9023 374.531 10.2009 349.523 3.71724C324.515 -2.76639 298.054 -0.65589 274.39 9.7097C253.21 18.8497 234.32 34.2597 219 54.7597C203.68 34.2597 184.79 18.8497 163.61 9.7597C139.951 -0.611191 113.494 -2.72953 88.4864 3.74492C63.479 10.2194 41.3734 24.9108 25.72 45.4597C9.22 67.0797 0.5 94.0997 0.5 123.59C0.5 166.03 25.81 212.59 75.72 262.03C116.39 302.3 164.45 335.28 189.47 351.35C198.286 356.992 208.533 359.99 219 359.99C229.467 359.99 239.714 356.992 248.53 351.35C273.53 335.28 321.61 302.3 362.28 262.03C412.19 212.61 437.5 166.03 437.5 123.59C437.5 94.0997 428.78 67.0797 412.28 45.4597Z"
                                                        fill="black" />
                                                    <path class="heart-fill"
                                                        d="M412.5 123.59C412.5 159.11 389.69 199.71 344.69 244.27C305.69 282.93 259.22 314.77 235.02 330.27C230.242 333.322 224.69 334.944 219.02 334.944C213.35 334.944 207.798 333.322 203.02 330.27C178.82 314.73 132.39 282.89 93.35 244.27C48.35 199.71 25.54 159.11 25.54 123.59C25.54 99.5898 32.54 77.8498 45.63 60.5898C57.7039 44.8054 74.6164 33.4111 93.78 28.1498C101.415 26.0845 109.291 25.042 117.2 25.0498C147.68 25.0498 182.84 40.2898 208.26 83.6298C209.361 85.5115 210.935 87.0721 212.827 88.1566C214.718 89.2412 216.86 89.8118 219.04 89.8118C221.22 89.8118 223.362 89.2412 225.253 88.1566C227.145 87.0721 228.719 85.5115 229.82 83.6298C262.12 28.5698 310.13 18.8698 344.3 28.1498C363.464 33.4111 380.376 44.8054 392.45 60.5898C405.55 77.8498 412.5 99.6298 412.5 123.59Z"
                                                        fill="#ffffff" />
                                                </svg>
                                                Save this page
                                            </span>
                                        </label>
                                    </li>
                                    <li>
                                        <a href="Javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <svg width="338" height="438" viewBox="0 0 338 438" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M289.256 131.938H245.587C241.343 131.938 237.274 133.624 234.273 136.625C231.272 139.625 229.587 143.695 229.587 147.938C229.587 152.182 231.272 156.251 234.273 159.252C237.274 162.253 241.343 163.938 245.587 163.938H289.267C298.088 163.938 305.267 171.117 305.267 179.938V389.176C305.267 397.997 298.088 405.176 289.267 405.176H48.744C39.9227 405.176 32.744 397.997 32.744 389.176V179.938C32.744 171.117 39.9227 163.938 48.744 163.938H92.424C96.6675 163.938 100.737 162.253 103.738 159.252C106.738 156.251 108.424 152.182 108.424 147.938C108.424 143.695 106.738 139.625 103.738 136.625C100.737 133.624 96.6675 131.938 92.424 131.938H48.744C36.018 131.952 23.8172 137.014 14.8185 146.013C5.81979 155.011 0.758135 167.212 0.744019 179.938V389.176C0.744019 415.64 22.28 437.176 48.744 437.176H289.267C315.731 437.176 337.267 415.64 337.267 389.176V179.938C337.25 167.211 332.186 155.011 323.185 146.012C314.185 137.014 301.983 131.952 289.256 131.938ZM109.341 99.6397L153.533 55.4477V266.093C153.533 268.194 153.947 270.275 154.751 272.216C155.555 274.157 156.734 275.921 158.22 277.407C159.705 278.892 161.469 280.071 163.41 280.875C165.352 281.679 167.432 282.093 169.533 282.093C171.635 282.093 173.715 281.679 175.656 280.875C177.598 280.071 179.361 278.892 180.847 277.407C182.333 275.921 183.511 274.157 184.315 272.216C185.12 270.275 185.533 268.194 185.533 266.093V55.4477L229.725 99.6397C232.851 102.765 236.947 104.322 241.043 104.322C245.139 104.322 249.235 102.765 252.36 99.6397C255.36 96.6392 257.045 92.5703 257.045 88.3277C257.045 84.085 255.36 80.0161 252.36 77.0157L180.861 5.50632C179.375 4.0195 177.611 2.84003 175.669 2.03531C173.727 1.2306 171.646 0.816406 169.544 0.816406C167.442 0.816406 165.361 1.2306 163.419 2.03531C161.477 2.84003 159.713 4.0195 158.227 5.50632L86.7173 77.0157C85.1892 78.4916 83.9703 80.2571 83.1317 82.2092C82.2932 84.1612 81.8518 86.2608 81.8333 88.3852C81.8149 90.5097 82.2197 92.6166 83.0242 94.5829C83.8287 96.5493 85.0168 98.3357 86.519 99.838C88.0213 101.34 89.8077 102.528 91.7741 103.333C93.7404 104.137 95.8473 104.542 97.9718 104.524C100.096 104.505 102.196 104.064 104.148 103.225C106.1 102.387 107.865 101.168 109.341 99.6397Z"
                                                    fill="currentColor" />
                                            </svg>
                                            Share this page
                                        </a>
                                    </li>
                                    <li style="color: #24739a; font-size:18px; margin-left:2rem;">Rewards Badges starting at <span style="color:#4f7f18">{{ $badge_bonus_point }} points per day</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="hotel-portal-right-panel">
                            <a href="#url" class="page-btn page-btn-bright-cerulean">
                                <svg class="page-btn-icon" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.447 6.10523L15.447 3.10523C15.3081 3.03571 15.1549 2.99951 14.9995 2.99951C14.8441 2.99951 14.6909 3.03571 14.552 3.10523L9 5.88223L3.447 3.10523C3.2945 3.02902 3.12506 2.99307 2.95476 3.00079C2.78446 3.0085 2.61895 3.05962 2.47397 3.1493C2.32899 3.23897 2.20933 3.36422 2.12638 3.51315C2.04342 3.66209 1.99992 3.82975 2 4.00023V17.0002C2 17.3792 2.214 17.7252 2.553 17.8952L8.553 20.8952C8.69193 20.9647 8.84515 21.0009 9.0005 21.0009C9.15585 21.0009 9.30907 20.9647 9.448 20.8952L15 18.1182L20.553 20.8942C20.7051 20.9712 20.8744 21.0076 21.0446 21.0001C21.2149 20.9925 21.3803 20.9413 21.525 20.8512C21.82 20.6682 22 20.3472 22 20.0002V7.00023C22 6.62123 21.786 6.27523 21.447 6.10523ZM10 7.61823L14 5.61823V16.3822L10 18.3822V7.61823ZM4 5.61823L8 7.61823V18.3822L4 16.3822V5.61823ZM20 18.3822L16 16.3822V5.61823L20 7.61823V18.3822Z"
                                        fill="currentColor" />
                                </svg>
                                Map it
                            </a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>



    <div class="hotel-portal-navigate" style="padding: 0 0 60px">
        <div class="container">

            <div class="navigate-panel">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="navigate-panel-left">
                            <div class="qs">
                                <h4>Quick Search</h4>
                                <div class="qs-form">
                                    <form  >
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="qs-form-box">
                                                    @if ($listType)
                                                        <select wire:model.defer='searchByType'>
                                                            <option value="">All Property Types</option>
                                                            @foreach ($listType as $type)
                                                                <option value="{{ $type->id }}">{{ $type->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="qs-form-box">
                                                    <select wire:model.defer="searchByLocation">
                                                        <option value="">All Locations</option>
                                                        @if (count($listing_states) > 0)
                                                            @foreach ($listing_states as $state_data)
                                                                @foreach($state_data as $state_key=>$data)
                                                                    @if(count($data['listing']) > 0)
                                                                        @foreach($data['listing'] as $key=>$short_term)
                                                                            <option value="{{$short_term['states']['id']}}">{{$short_term['city']}} , {{$short_term['states']['name']}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endforeach
                                                        @endif
                                                     
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="qs-form-box">
                                                    <select wire:model.defer="searchByguest">
                                                        <option value="">All Guests</option>
                                                        @for ($i = 1; $i <= 10; $i++)
                                                            <option value="{{ $i }}">Guests
                                                                {{ $i }}</option>
                                                        @endfor
                                                        <option value="10+">Guests
                                                            10+</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="qs-form-box">
                                                    <input type="submit" wire:click.prevent="searchListing()" value="Search" class="qs-btn">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="m-filter">
                                <div class="m-filter-bx">
                                    <select wire:change.prevent="searchByListing" wire:model="searchListName">
                                        <option value="">Search by Listing</option>
                                        @foreach ($listingforSearch as $lists)
                                        <option value="{{$lists->name}}">{{$lists->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="qs-result">
                                <div class="qs-result-scroll">
                                    <div class="row">
                                        @if ($another_listings)
                                            @forelse ($another_listings as $short_lists)
                                                <div class="col-md-6">
                                                    <div class="qs-result-box">
                                                        <div class="qs-result-image">
                                                            <div class="hotel_slider_main">
                                                                <div class="hotel_slider">
                                                                    @if ($short_lists->main_img)
                                                                        <div class="hotel_item">
                                                                            <img src="{{ $short_lists->main_img }}"
                                                                                alt="">
                                                                        </div>
                                                                    @endif
                                                                    @if (count($short_lists->photo_img) > 0)
                                                                        @foreach ($short_lists->photo_img as $photo)
                                                                            <div class="hotel_item">
                                                                                <img src="{{ $photo }}"
                                                                                    alt="photo">
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="qs-result-image-overlay extra_img_wrap">
                                                                <div class="qs-wishlist">
                                                                    <label class="media-save-lbl">
                                                                        <input type="checkbox" <?php if($short_lists->favourite_travel == 1){ echo 'checked'; }else{ echo 'disabled';}?>>
                                                                        <span wire:click='saveList({{$short_lists->id}},"short_term_type")'>
                                                                            <svg width="438" height="360"
                                                                                viewBox="0 0 438 360" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path
                                                                                    d="M412.28 45.4597C396.633 24.9023 374.531 10.2009 349.523 3.71724C324.515 -2.76639 298.054 -0.65589 274.39 9.7097C253.21 18.8497 234.32 34.2597 219 54.7597C203.68 34.2597 184.79 18.8497 163.61 9.7597C139.951 -0.611191 113.494 -2.72953 88.4864 3.74492C63.479 10.2194 41.3734 24.9108 25.72 45.4597C9.22 67.0797 0.5 94.0997 0.5 123.59C0.5 166.03 25.81 212.59 75.72 262.03C116.39 302.3 164.45 335.28 189.47 351.35C198.286 356.992 208.533 359.99 219 359.99C229.467 359.99 239.714 356.992 248.53 351.35C273.53 335.28 321.61 302.3 362.28 262.03C412.19 212.61 437.5 166.03 437.5 123.59C437.5 94.0997 428.78 67.0797 412.28 45.4597Z"
                                                                                    fill="black"></path>
                                                                                <path class="heart-fill"
                                                                                    d="M412.5 123.59C412.5 159.11 389.69 199.71 344.69 244.27C305.69 282.93 259.22 314.77 235.02 330.27C230.242 333.322 224.69 334.944 219.02 334.944C213.35 334.944 207.798 333.322 203.02 330.27C178.82 314.73 132.39 282.89 93.35 244.27C48.35 199.71 25.54 159.11 25.54 123.59C25.54 99.5898 32.54 77.8498 45.63 60.5898C57.7039 44.8054 74.6164 33.4111 93.78 28.1498C101.415 26.0845 109.291 25.042 117.2 25.0498C147.68 25.0498 182.84 40.2898 208.26 83.6298C209.361 85.5115 210.935 87.0721 212.827 88.1566C214.718 89.2412 216.86 89.8118 219.04 89.8118C221.22 89.8118 223.362 89.2412 225.253 88.1566C227.145 87.0721 228.719 85.5115 229.82 83.6298C262.12 28.5698 310.13 18.8698 344.3 28.1498C363.464 33.4111 380.376 44.8054 392.45 60.5898C405.55 77.8498 412.5 99.6298 412.5 123.59Z"
                                                                                    fill="#ffffff"></path>
                                                                            </svg>
                                                                            Save
                                                                        </span>
                                                                    </label>
                                                                </div>
                                                                <div class="qs-share">
                                                                    <a href="Javascript:void(0);" wire:click="shareListing({{$short_lists->id}})">
                                                                        <svg width="338" height="438"
                                                                            viewBox="0 0 338 438" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M289.256 131.938H245.587C241.343 131.938 237.274 133.624 234.273 136.625C231.272 139.625 229.587 143.695 229.587 147.938C229.587 152.182 231.272 156.251 234.273 159.252C237.274 162.253 241.343 163.938 245.587 163.938H289.267C298.088 163.938 305.267 171.117 305.267 179.938V389.176C305.267 397.997 298.088 405.176 289.267 405.176H48.744C39.9227 405.176 32.744 397.997 32.744 389.176V179.938C32.744 171.117 39.9227 163.938 48.744 163.938H92.424C96.6675 163.938 100.737 162.253 103.738 159.252C106.738 156.251 108.424 152.182 108.424 147.938C108.424 143.695 106.738 139.625 103.738 136.625C100.737 133.624 96.6675 131.938 92.424 131.938H48.744C36.018 131.952 23.8172 137.014 14.8185 146.013C5.81979 155.011 0.758135 167.212 0.744019 179.938V389.176C0.744019 415.64 22.28 437.176 48.744 437.176H289.267C315.731 437.176 337.267 415.64 337.267 389.176V179.938C337.25 167.211 332.186 155.011 323.185 146.012C314.185 137.014 301.983 131.952 289.256 131.938ZM109.341 99.6397L153.533 55.4477V266.093C153.533 268.194 153.947 270.275 154.751 272.216C155.555 274.157 156.734 275.921 158.22 277.407C159.705 278.892 161.469 280.071 163.41 280.875C165.352 281.679 167.432 282.093 169.533 282.093C171.635 282.093 173.715 281.679 175.656 280.875C177.598 280.071 179.361 278.892 180.847 277.407C182.333 275.921 183.511 274.157 184.315 272.216C185.12 270.275 185.533 268.194 185.533 266.093V55.4477L229.725 99.6397C232.851 102.765 236.947 104.322 241.043 104.322C245.139 104.322 249.235 102.765 252.36 99.6397C255.36 96.6392 257.045 92.5703 257.045 88.3277C257.045 84.085 255.36 80.0161 252.36 77.0157L180.861 5.50632C179.375 4.0195 177.611 2.84003 175.669 2.03531C173.727 1.2306 171.646 0.816406 169.544 0.816406C167.442 0.816406 165.361 1.2306 163.419 2.03531C161.477 2.84003 159.713 4.0195 158.227 5.50632L86.7173 77.0157C85.1892 78.4916 83.9703 80.2571 83.1317 82.2092C82.2932 84.1612 81.8518 86.2608 81.8333 88.3852C81.8149 90.5097 82.2197 92.6166 83.0242 94.5829C83.8287 96.5493 85.0168 98.3357 86.519 99.838C88.0213 101.34 89.8077 102.528 91.7741 103.333C93.7404 104.137 95.8473 104.542 97.9718 104.524C100.096 104.505 102.196 104.064 104.148 103.225C106.1 102.387 107.865 101.168 109.341 99.6397Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        Share
                                                                    </a>
                                                                </div>
                                                                <div class="custm_arrw">
                                                                    <span class="cmn_arrw prev_arrw"><img
                                                                            src="{{ asset('frontend_assets/images/prev-arrw.svg') }}"
                                                                            alt=""></span>
                                                                    <span class="cmn_arrw next_arrw"><img
                                                                            src="{{ asset('frontend_assets/images/next-arrw.svg') }}"
                                                                            alt=""></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="qs-result-info">
                                                            <a href="{{route('frontend.short-term-website',base64_encode($short_lists->id))}}">
                                                                <h3>{{ $short_lists->name }}</h3>
                                                                <span>{{ $short_lists->type->name }}</span>
                                                                <ul>
                                                                    <li>Bed: {{ $short_lists->no_of_bedrooms }}</li>
                                                                    <li>Bath: {{ $short_lists->no_of_baths }}</li>
                                                                    <li>Guests: {{ $short_lists->no_of_guests }}</li>
                                                                </ul>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                <div>No listing found</div>
                                            @endforelse
                                        
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        @if ($travel_tourism->show_message_board == 1)
                      
                            <div class="navigate-panel-right">
                         
                                @if($message_board)
                                @if ($message_board->message_board_id)
                                    <div class="move-in-special">
                                        <div class="move-in-special-heading bg-color-special-one">
                                            {{ $message_board->messageBoard->title }}</div>
                                        <div class="move-spa-con">
                                            {{-- @dd($message_board) --}}
                                            @if($message_board->add_message_date != 0)
                                                <?php $start_date1 = date_format(date_create($message_board->start_date), 'm-d-Y');
                                                $end_date1 = date_format(date_create($message_board->end_date), 'm-d-Y');
                                                ?>
                                                @if ($message_board->end_date != '')
                                                    <h2>From {{ $start_date1 }} to {{ $end_date1 }} </h2>
                                                @else
                                                    <h2>From {{ $start_date1 }} to Open </h2>
                                                @endif
                                            @endif
                                            <p>{!! $message_board->message ?? '' !!}</p>
                                        </div>
                                    </div>
                                @endif
                                @if ($message_board->message_board_id2)
                                    <div class="move-in-special">
                                        <div class="move-in-special-heading bg-color-special-ten">
                                            {{ $message_board->messageBoardtwo->title }}</div>
                                        <div class="move-spa-con">
                                            @if($message_board->add_message_date2 != 0)
                                                <?php $start_date2 = date_format(date_create($message_board->start_date2), 'm-d-Y');
                                                $end_date2 = date_format(date_create($message_board->end_date2), 'm-d-Y');
                                                ?>
                                                @if ($message_board->end_date2 != '')
                                                    <h2>From {{ $start_date2 }} to {{ $end_date2 }} </h2>
                                                @else
                                                    <h2>From {{ $start_date2 }} to Open </h2>
                                                @endif
                                            @endif
                                            <p>{!! $message_board->message2 ?? '' !!}</p>
                                        </div>
                                    </div>
                                @endif
                                @endif
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- share modal -->
<div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-left">
                    <h2 class="modal-title" id="shareModalLabel">Share this Listing</h2>
                    <p>Share this listing on any device</p>
                </div>
                <a href="#" class="btn-close shareClose" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <div class="share-property">
                    <div class="share-property-image">
                        <img src="{{$travel_tourism->short_term_logo}}" alt="">
                    </div>
                    <div class="share-property-intro">
                        <h3 class="share-property-title">{{$travel_tourism->name}}</h3>
                        <p class="share-property-location">{{$travel_tourism->city ?? ''}} {{$travel_tourism->city ? ',' : ''}} {{$travel_tourism->state->name}}</p>
                        {{-- <ul class="share-property-facility">
                            <li>{{$travel_tourism->type->name}}</li>
                            <li>{{$short_rental->no_of_bedrooms}} Bedrooms</li>
                            <li>{{$short_rental->no_of_baths}} Bathrooms</li>
                        </ul> --}}
                    </div>
                </div>
                
                <div class="share-property-option">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <input type="hidden" value="{{url('/other-short-term-rental-listing/'. $encrypt_id)}}" id="myInput">
                                <a href="javascript:void(0);" wire:click="copyPageLink">
                                    <svg width="352" height="416" viewBox="0 0 352 416" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M304 416H112C99.2696 416 87.0606 410.943 78.0589 401.941C69.0571 392.939 64 380.73 64 368V112C64 99.2696 69.0571 87.0606 78.0589 78.0589C87.0606 69.0571 99.2696 64 112 64H304C316.73 64 328.939 69.0571 337.941 78.0589C346.943 87.0606 352 99.2696 352 112V368C352 380.73 346.943 392.939 337.941 401.941C328.939 410.943 316.73 416 304 416ZM112 96C107.757 96 103.687 97.6857 100.686 100.686C97.6857 103.687 96 107.757 96 112V368C96 372.243 97.6857 376.313 100.686 379.314C103.687 382.314 107.757 384 112 384H304C308.243 384 312.313 382.314 315.314 379.314C318.314 376.313 320 372.243 320 368V112C320 107.757 318.314 103.687 315.314 100.686C312.313 97.6857 308.243 96 304 96H112Z"
                                            fill="black" />
                                        <path
                                            d="M16 256C11.7565 256 7.68688 254.314 4.68629 251.314C1.68571 248.313 0 244.243 0 240V48C0 35.2696 5.05713 23.0606 14.0589 14.0589C23.0606 5.05713 35.2696 0 48 0H208C212.243 0 216.313 1.68571 219.314 4.68629C222.314 7.68687 224 11.7565 224 16C224 20.2435 222.314 24.3131 219.314 27.3137C216.313 30.3143 212.243 32 208 32H48C43.7565 32 39.6869 33.6857 36.6863 36.6863C33.6857 39.6869 32 43.7565 32 48V240C32 244.243 30.3143 248.313 27.3137 251.314C24.3131 254.314 20.2435 256 16 256Z"
                                            fill="black" />
                                    </svg>
                                    
                                    Copy Link
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" wire:click="mailBox">
                                    <svg width="512" height="384" viewBox="0 0 512 384" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M464 0H48.0003C21.5313 0 0 21.5313 0 48.0003V336C0 362.469 21.5313 384.001 48.0003 384.001H464C490.469 384.001 512 362.469 512 336V48.0003C512 21.5313 490.469 0 464 0ZM464 31.9999C466.174 31.9999 468.242 32.4509 470.132 33.2386L256 218.828L41.8667 33.2386C43.8089 32.4243 45.8933 32.0032 47.9993 31.9999H464ZM464 352H48.0003C39.1723 352 31.9999 344.828 31.9999 335.999V67.0468L245.515 252.094C248.531 254.703 252.266 256 256 256C259.734 256 263.469 254.704 266.485 252.094L480 67.0468V336C479.999 344.828 472.828 352 464 352Z"
                                            fill="black" />
                                    </svg>
                                    Email
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a target="_blank" href="https://wa.me/?text={{route('frontend.other-short-term-listing', $encrypt_id)}}">

                                    <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M442.182 0H69.8182C31.2587 0 0 31.2587 0 69.8182V442.182C0 480.741 31.2587 512 69.8182 512H442.182C480.741 512 512 480.741 512 442.182V69.8182C512 31.2587 480.741 0 442.182 0Z"
                                            fill="#29A71A" />
                                        <path
                                            d="M368.873 143.128C342.238 116.227 306.867 99.7301 269.14 96.612C231.414 93.4938 193.814 103.96 163.125 126.122C132.435 148.285 110.675 180.685 101.77 217.478C92.865 254.271 97.401 293.035 114.56 326.779L97.7163 408.553C97.5415 409.367 97.5366 410.208 97.7018 411.024C97.867 411.84 98.1987 412.613 98.6763 413.295C99.3759 414.33 100.375 415.126 101.539 415.579C102.703 416.031 103.978 416.117 105.193 415.826L185.338 396.83C218.987 413.554 257.477 417.798 293.961 408.807C330.445 399.816 362.556 378.173 384.58 347.729C406.605 317.285 417.114 280.014 414.237 242.548C411.361 205.083 395.286 169.853 368.873 143.128ZM343.884 342.575C325.455 360.952 301.725 373.082 276.037 377.258C250.349 381.433 223.998 377.442 200.698 365.848L189.527 360.32L140.393 371.957L140.538 371.346L150.72 321.891L145.251 311.099C133.346 287.717 129.146 261.168 133.253 235.254C137.361 209.34 149.564 185.391 168.116 166.837C191.427 143.533 223.039 130.442 256 130.442C288.961 130.442 320.573 143.533 343.884 166.837C344.082 167.064 344.296 167.278 344.524 167.477C367.545 190.84 380.397 222.358 380.277 255.158C380.157 287.958 367.075 319.38 343.884 342.575Z"
                                            fill="white" />
                                        <path
                                            d="M339.52 306.298C333.498 315.782 323.985 327.389 312.029 330.269C291.084 335.331 258.938 330.444 218.938 293.149L218.444 292.713C183.273 260.102 174.138 232.96 176.349 211.433C177.571 199.215 187.753 188.16 196.334 180.946C197.691 179.788 199.3 178.963 201.033 178.538C202.765 178.113 204.573 178.099 206.311 178.498C208.05 178.897 209.671 179.697 211.045 180.834C212.42 181.971 213.509 183.414 214.225 185.047L227.171 214.138C228.012 216.025 228.324 218.104 228.073 220.154C227.822 222.204 227.017 224.147 225.745 225.775L219.2 234.269C217.795 236.023 216.948 238.157 216.767 240.397C216.585 242.637 217.078 244.879 218.182 246.837C221.847 253.266 230.633 262.72 240.378 271.477C251.316 281.367 263.447 290.415 271.127 293.498C273.182 294.338 275.442 294.543 277.614 294.086C279.787 293.63 281.773 292.534 283.316 290.938L290.909 283.287C292.374 281.843 294.196 280.812 296.189 280.301C298.182 279.79 300.275 279.817 302.254 280.378L333.004 289.106C334.7 289.626 336.255 290.527 337.549 291.741C338.843 292.954 339.843 294.447 340.472 296.106C341.101 297.765 341.342 299.546 341.177 301.313C341.012 303.079 340.445 304.784 339.52 306.298Z"
                                            fill="white" />
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{route('frontend.other-short-term-listing', $encrypt_id)}}">
                                   
                                    <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M448 0H64C28.704 0 0 28.704 0 64V448C0 483.296 28.704 512 64 512H448C483.296 512 512 483.296 512 448V64C512 28.704 483.296 0 448 0Z"
                                            fill="#1976D2" />
                                        <path
                                            d="M432 256H352V192C352 174.336 366.336 176 384 176H416V96H352C298.976 96 256 138.976 256 192V256H192V336H256V512H352V336H400L432 256Z"
                                            fill="#FAFAFA" />
                                    </svg>
                                    Facebook
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a target="_blank" href="https://twitter.com/intent/tweet?text={{route('frontend.other-short-term-listing', $encrypt_id)}}"> 
                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="100px" height="100px"><path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"/></svg>
                                    X
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a target="_blank" href="https://www.linkedin.com/sharing/share-offsite?mini=true&url='{{route('frontend.other-short-term-listing', $encrypt_id)}}'&title=&summary="> 
                               
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 40 40">
                                    <path fill="#0078d4" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z"></path><path d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z" opacity=".05"></path><path d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z" opacity=".07"></path><path fill="#fff" d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z"></path>
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- share modal -->

<!-- share mail modal -->
<div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="mailBoxModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 37%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-left">
                    <h2 class="modal-title" id="shareModalLabel" style="font-size: 40px;">Share this Listing</h2>
                    <p>Share this Listing on any device. </p>
                </div>
                <a href="javascript:void(0);" class="btn-close shareClose" data-bs-dismiss="modal"
                    aria-label="Close">x</a>
            </div>
            
            <div class="modal-body">
                <form class="form-inline" wire:submit.prevent="shareByEmail"> 
                    <div class="form-group mb-2">
                        <div class="row">
                            <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                <h5>Your Name *</h5>
                                <input type="text" name="name" wire:model.defer='name'>
                                @error('name')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                <h5>Your Email *</h5>
                                <input type="email" name="email" wire:model.defer='email'>
                                @error('email')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="col-lg-12 custom_form_dsgn_pop_col mb-2">
                                <h5>Recipient Email(s) *</h5>
                                <input type="text" name="r_emails" wire:model.defer='r_emails'>
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    <i>Enter one or more recipient email address separeted by commas or space.</i>
                                </span>
                                <br>
                                @error('r_emails')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="col-lg-12 custom_form_dsgn_pop_col  mb-2">
                                <h5>Message</h5>
                                <textarea class="form-control" name="message" rows="5" wire:model.defer='message'></textarea>
                                <span class="invalid-message" role="alert"
                                    style="font-size: 12px; color:red;margin-bottom: 20px;">
                                    <i>Enter your message or notes here to be include in the email.</i>
                                </span>
                                @error('message')
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="popup-form-submit text-center">
                        <p>By clicking Share Now, I confirm I am permitted to send this email</p>
                        <p>The recipient's email address will only be used to send this email to them and will not
                            be collected or be available to anyone else. </p>
                        <div class="form-submit-btn">
                            <button type="submit" class="btn btn-primary">Share Now</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- success model --}}
<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="success_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="successmsg"></h3>
                    </div>

                    <div class="cmn_secthd_modals_btnnn">
                        <div class="btn_foot_end centr">
                            <button class="btn_table_s blu auto_wd" onclick="window.location.reload();">ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- listing share modal -->
<div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="listingShareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 85%;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-header-left">
                    <h2 class="modal-title" id="shareModalLabel">Share this Listing</h2>
                    <p>Share this listing on any device</p>
                </div>
                <a href="javascript:void(0);" class="btn-close shareClose" data-bs-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <div class="share-property">
                    <div class="share-property-image">
                        <img src="" class="short_rental_main_image" alt="">
                    </div>
                    <div class="share-property-intro">
                        <h3 class="share-property-title"></h3>
                        <p class="share-property-location"></p>
                        <ul class="share-property-facility">
                            <li class="type"></li>
                            <li class="bedroom"></li>
                            <li class="bathroom"></li>
                        </ul>
                    </div>
                </div>
                
                <div class="share-property-option">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <input type="hidden" class="listing_page_link" id="pageLink">
                                <a href="javascript:void(0);" class="copyLink">
                                    <svg width="352" height="416" viewBox="0 0 352 416" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M304 416H112C99.2696 416 87.0606 410.943 78.0589 401.941C69.0571 392.939 64 380.73 64 368V112C64 99.2696 69.0571 87.0606 78.0589 78.0589C87.0606 69.0571 99.2696 64 112 64H304C316.73 64 328.939 69.0571 337.941 78.0589C346.943 87.0606 352 99.2696 352 112V368C352 380.73 346.943 392.939 337.941 401.941C328.939 410.943 316.73 416 304 416ZM112 96C107.757 96 103.687 97.6857 100.686 100.686C97.6857 103.687 96 107.757 96 112V368C96 372.243 97.6857 376.313 100.686 379.314C103.687 382.314 107.757 384 112 384H304C308.243 384 312.313 382.314 315.314 379.314C318.314 376.313 320 372.243 320 368V112C320 107.757 318.314 103.687 315.314 100.686C312.313 97.6857 308.243 96 304 96H112Z"
                                            fill="black" />
                                        <path
                                            d="M16 256C11.7565 256 7.68688 254.314 4.68629 251.314C1.68571 248.313 0 244.243 0 240V48C0 35.2696 5.05713 23.0606 14.0589 14.0589C23.0606 5.05713 35.2696 0 48 0H208C212.243 0 216.313 1.68571 219.314 4.68629C222.314 7.68687 224 11.7565 224 16C224 20.2435 222.314 24.3131 219.314 27.3137C216.313 30.3143 212.243 32 208 32H48C43.7565 32 39.6869 33.6857 36.6863 36.6863C33.6857 39.6869 32 43.7565 32 48V240C32 244.243 30.3143 248.313 27.3137 251.314C24.3131 254.314 20.2435 256 16 256Z"
                                            fill="black" />
                                    </svg>
                                    
                                    Copy Link
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" wire:click="listingMailBox">
                                    <svg width="512" height="384" viewBox="0 0 512 384" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M464 0H48.0003C21.5313 0 0 21.5313 0 48.0003V336C0 362.469 21.5313 384.001 48.0003 384.001H464C490.469 384.001 512 362.469 512 336V48.0003C512 21.5313 490.469 0 464 0ZM464 31.9999C466.174 31.9999 468.242 32.4509 470.132 33.2386L256 218.828L41.8667 33.2386C43.8089 32.4243 45.8933 32.0032 47.9993 31.9999H464ZM464 352H48.0003C39.1723 352 31.9999 344.828 31.9999 335.999V67.0468L245.515 252.094C248.531 254.703 252.266 256 256 256C259.734 256 263.469 254.704 266.485 252.094L480 67.0468V336C479.999 344.828 472.828 352 464 352Z"
                                            fill="black" />
                                    </svg>
                                    Email
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" class="whatsapp_link" target="_blank">
                                    {{-- {!! Share::page(url('/short-term-rental-website/'. $encrypt_id))->whatsapp() !!} --}}
                                    <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M442.182 0H69.8182C31.2587 0 0 31.2587 0 69.8182V442.182C0 480.741 31.2587 512 69.8182 512H442.182C480.741 512 512 480.741 512 442.182V69.8182C512 31.2587 480.741 0 442.182 0Z"
                                            fill="#29A71A" />
                                        <path
                                            d="M368.873 143.128C342.238 116.227 306.867 99.7301 269.14 96.612C231.414 93.4938 193.814 103.96 163.125 126.122C132.435 148.285 110.675 180.685 101.77 217.478C92.865 254.271 97.401 293.035 114.56 326.779L97.7163 408.553C97.5415 409.367 97.5366 410.208 97.7018 411.024C97.867 411.84 98.1987 412.613 98.6763 413.295C99.3759 414.33 100.375 415.126 101.539 415.579C102.703 416.031 103.978 416.117 105.193 415.826L185.338 396.83C218.987 413.554 257.477 417.798 293.961 408.807C330.445 399.816 362.556 378.173 384.58 347.729C406.605 317.285 417.114 280.014 414.237 242.548C411.361 205.083 395.286 169.853 368.873 143.128ZM343.884 342.575C325.455 360.952 301.725 373.082 276.037 377.258C250.349 381.433 223.998 377.442 200.698 365.848L189.527 360.32L140.393 371.957L140.538 371.346L150.72 321.891L145.251 311.099C133.346 287.717 129.146 261.168 133.253 235.254C137.361 209.34 149.564 185.391 168.116 166.837C191.427 143.533 223.039 130.442 256 130.442C288.961 130.442 320.573 143.533 343.884 166.837C344.082 167.064 344.296 167.278 344.524 167.477C367.545 190.84 380.397 222.358 380.277 255.158C380.157 287.958 367.075 319.38 343.884 342.575Z"
                                            fill="white" />
                                        <path
                                            d="M339.52 306.298C333.498 315.782 323.985 327.389 312.029 330.269C291.084 335.331 258.938 330.444 218.938 293.149L218.444 292.713C183.273 260.102 174.138 232.96 176.349 211.433C177.571 199.215 187.753 188.16 196.334 180.946C197.691 179.788 199.3 178.963 201.033 178.538C202.765 178.113 204.573 178.099 206.311 178.498C208.05 178.897 209.671 179.697 211.045 180.834C212.42 181.971 213.509 183.414 214.225 185.047L227.171 214.138C228.012 216.025 228.324 218.104 228.073 220.154C227.822 222.204 227.017 224.147 225.745 225.775L219.2 234.269C217.795 236.023 216.948 238.157 216.767 240.397C216.585 242.637 217.078 244.879 218.182 246.837C221.847 253.266 230.633 262.72 240.378 271.477C251.316 281.367 263.447 290.415 271.127 293.498C273.182 294.338 275.442 294.543 277.614 294.086C279.787 293.63 281.773 292.534 283.316 290.938L290.909 283.287C292.374 281.843 294.196 280.812 296.189 280.301C298.182 279.79 300.275 279.817 302.254 280.378L333.004 289.106C334.7 289.626 336.255 290.527 337.549 291.741C338.843 292.954 339.843 294.447 340.472 296.106C341.101 297.765 341.342 299.546 341.177 301.313C341.012 303.079 340.445 304.784 339.52 306.298Z"
                                            fill="white" />
                                    </svg>
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" class="facebook_link" target="_blank">
                                    {{-- {!! Share::page(url('/short-term-rental-website/'. $encrypt_id))->facebook() !!} --}}
                                    <svg width="512" height="512" viewBox="0 0 512 512" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M448 0H64C28.704 0 0 28.704 0 64V448C0 483.296 28.704 512 64 512H448C483.296 512 512 483.296 512 448V64C512 28.704 483.296 0 448 0Z"
                                            fill="#1976D2" />
                                        <path
                                            d="M432 256H352V192C352 174.336 366.336 176 384 176H416V96H352C298.976 96 256 138.976 256 192V256H192V336H256V512H352V336H400L432 256Z"
                                            fill="#FAFAFA" />
                                    </svg>
                                    Facebook
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" class="twitter_link" target="_blank">
                                    {{-- {!! Share::page(url('/short-term-rental-website/'. $encrypt_id))->twitter() !!} --}}
                                    <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="100px" height="100px"><path d="M 11 4 C 7.134 4 4 7.134 4 11 L 4 39 C 4 42.866 7.134 46 11 46 L 39 46 C 42.866 46 46 42.866 46 39 L 46 11 C 46 7.134 42.866 4 39 4 L 11 4 z M 13.085938 13 L 21.023438 13 L 26.660156 21.009766 L 33.5 13 L 36 13 L 27.789062 22.613281 L 37.914062 37 L 29.978516 37 L 23.4375 27.707031 L 15.5 37 L 13 37 L 22.308594 26.103516 L 13.085938 13 z M 16.914062 15 L 31.021484 35 L 34.085938 35 L 19.978516 15 L 16.914062 15 z"/></svg>
                                    X
                                </a>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="share-property-option-box">
                                <a href="javascript:void(0);" class="linkedin_link" target="_blank">
                                {{-- {!! Share::page(url('/short-term-rental-website/'. $encrypt_id))->linkedin() !!} --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 40 40">
                                    <path fill="#0078d4" d="M42,37c0,2.762-2.238,5-5,5H11c-2.761,0-5-2.238-5-5V11c0-2.762,2.239-5,5-5h26c2.762,0,5,2.238,5,5	V37z"></path><path d="M30,37V26.901c0-1.689-0.819-2.698-2.192-2.698c-0.815,0-1.414,0.459-1.779,1.364	c-0.017,0.064-0.041,0.325-0.031,1.114L26,37h-7V18h7v1.061C27.022,18.356,28.275,18,29.738,18c4.547,0,7.261,3.093,7.261,8.274	L37,37H30z M11,37V18h3.457C12.454,18,11,16.528,11,14.499C11,12.472,12.478,11,14.514,11c2.012,0,3.445,1.431,3.486,3.479	C18,16.523,16.521,18,14.485,18H18v19H11z" opacity=".05"></path><path d="M30.5,36.5v-9.599c0-1.973-1.031-3.198-2.692-3.198c-1.295,0-1.935,0.912-2.243,1.677	c-0.082,0.199-0.071,0.989-0.067,1.326L25.5,36.5h-6v-18h6v1.638c0.795-0.823,2.075-1.638,4.238-1.638	c4.233,0,6.761,2.906,6.761,7.774L36.5,36.5H30.5z M11.5,36.5v-18h6v18H11.5z M14.457,17.5c-1.713,0-2.957-1.262-2.957-3.001	c0-1.738,1.268-2.999,3.014-2.999c1.724,0,2.951,1.229,2.986,2.989c0,1.749-1.268,3.011-3.015,3.011H14.457z" opacity=".07"></path><path fill="#fff" d="M12,19h5v17h-5V19z M14.485,17h-0.028C12.965,17,12,15.888,12,14.499C12,13.08,12.995,12,14.514,12	c1.521,0,2.458,1.08,2.486,2.499C17,15.887,16.035,17,14.485,17z M36,36h-5v-9.099c0-2.198-1.225-3.698-3.192-3.698	c-1.501,0-2.313,1.012-2.707,1.99C24.957,25.543,25,26.511,25,27v9h-5V19h5v2.616C25.721,20.5,26.85,19,29.738,19	c3.578,0,6.261,2.25,6.261,7.274L36,36L36,36z"></path>
                                    </svg>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--listing share modal -->

<!-- listing mail modal -->
    <div wire:ignore.self class="modal extra-listingWebsite-modal shareModal fade" id="listingMailBoxModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 37%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-header-left">
                        <h2 class="modal-title" id="shareModalLabel" style="font-size: 40px;">Share this Listing</h2>
                        <p>Share this Listing on any device. </p>
                    </div>
                    <a href="javascript:void(0);" class="btn-close shareClose" data-bs-dismiss="modal"
                        aria-label="Close">x</a>
                </div>
                <div class="modal-body">
                    <form class="form-inline" wire:submit.prevent="shareByEmail"> 
                        <div class="form-group mb-2">
                            <div class="row">
                                <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Your Name *</h5>
                                    <input type="text" name="name" wire:model.defer='name'>
                                    @error('name')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Your Email *</h5>
                                    <input type="email" name="email" wire:model.defer='email'>
                                    @error('email')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 custom_form_dsgn_pop_col mb-2">
                                    <h5>Recipient Email(s) *</h5>
                                    <input type="text" name="r_emails" wire:model.defer='r_emails'>
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        <i>Enter one or more recipient email address separeted by commas or space.</i>
                                    </span>
                                    <br>
                                    @error('r_emails')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
    
                                <div class="col-lg-12 custom_form_dsgn_pop_col  mb-2">
                                    <h5>Message</h5>
                                    <textarea class="form-control" name="message" rows="5" wire:model.defer='message'></textarea>
                                    <span class="invalid-message" role="alert"
                                        style="font-size: 12px; color:red;margin-bottom: 20px;">
                                        <i>Enter your message or notes here to be include in the email.</i>
                                    </span>
                                    @error('message')
                                        <span class="invalid-message" role="alert"
                                            style="font-size: 12px; color:red;margin-bottom: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="popup-form-submit text-center">
                            <p>By clicking Share Now, I confirm I am permitted to send this email</p>
                            <p>The recipient's email address will only be used to send this email to them and will not
                                be collected or be available to anyone else. </p>
                            <div class="form-submit-btn">
                                <button type="submit" class="btn btn-primary">Share Now</button>
                            </div>
                        </div>
                    </form>
    
                </div>
            </div>
        </div>
    </div>
<!-- listing mail modal -->
<div wire:ignore.self class="modal fade cmn_modal_designs gap_sec_modal2" id="favourite_modal" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: 2px solid #000;border-radius: 10px;">
            <div class="modal-body">
                <div class="wrap_modal_cntntr">
                    <div class="cmn_secthd_modals">
                        <h3 id="loginmsg"></h3>
                    </div>

                    <div class="cmn_secthd_modals_btnnn">
                        <div class="row checkbox_bottom_btn">
                            <div class="col-md-6">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s blu auto_wd" onclick="window.location.reload();">Close</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn_foot_end centr">
                                    <button class="btn_table_s grn auto_wd" wire:click="loginForFavorite">Login</button>
                                </div>
                            </div>

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>


    <script>
        function sliderInit() {
            var $slider = $('.hotel_slider');
            $slider.each(function () {
                var $sliderParent = $(this).parents(".qs-result-image");
                var slideControls = $sliderParent.find('.custm_arrw_wrp');
                $(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    prevArrow: $sliderParent.find('.cmn_arrw.prev_arrw'),
                    nextArrow: $sliderParent.find('.cmn_arrw.next_arrw'),
                    dots: false,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 2500,
                    centerMode: false,
                    speed: 1000,
                });
            })
        }
        sliderInit();
         document.addEventListener('livewire:load', function (event) {
            @this.on('shareListingDetail', function(){
                    $("#shareModal").modal('show');
                });

                @this.on('copy_page_link', data =>{
                   
                   navigator.clipboard.writeText(data.link);
                   alert('Link Copied');
               });

               @this.on('mail_box', function(){
                   $("#mailBoxModal").modal('show');
               });

                @this.on('mailSuccess', data =>{
                    $("#success_modal").modal('show');
                    $("#successmsg").html(data.message);
                });

                @this.on('shareOnSocialMedia', data=>{
                    $("#listingShareModal").modal('show');
                    $(".share-property-title").text(data.listing_name);
                    $(".short_rental_main_image").attr('src',data.main_image);
                    $(".share-property-location").text(data.city+' - '+data.state);
                    $(".type").text(data.type);
                    if(data.bedroom > 1){
                        $(".bedroom").text(data.bedroom+' Bedrooms');
                    }
                    else{
                        $(".bedroom").text(data.bedroom+' Bedroom');
                    }
                    if(data.bathroom > 1){
                        $(".bathroom").text(data.bathroom+' Bathrooms');
                    }
                    else{
                        $(".bathroom").text(data.bathroom+' Bathroom');
                    }
                    $(".listing_page_link").val(data.url);
                    
                    $(".whatsapp_link").attr('href','https://wa.me/?text='+data.url);
                    $(".facebook_link").attr('href','https://www.facebook.com/sharer/sharer.php?u='+data.url);
                    $(".twitter_link").attr('href','https://twitter.com/intent/tweet?text='+data.url);
                    $(".linkedin_link").attr('href','https://www.linkedin.com/sharing/share-offsite?mini=true&url='+data.url+'&title=&summary=');
                });

                $('.copyLink').on('click',function(){
                    var copyText = document.getElementById("pageLink");
                    navigator.clipboard.writeText(copyText.value);
                    alert('Link Copied');
                });
                @this.on('listing_mail_box', data=>{
                    $("#listingMailBoxModal").modal('show');
                    $(".share-property-title").text(data.listing_name);
                    $(".short_rental_main_image").attr('src',data.main_image);
                    $(".share-property-location").text(data.city+' - '+data.state);
                    $(".type").text(data.type);
                    if(data.bedroom > 1){
                        $(".bedroom").text(data.bedroom+' Bedrooms');
                    }
                    else{
                        $(".bedroom").text(data.bedroom+' Bedroom');
                    }
                    if(data.bathroom > 1){
                        $(".bathroom").text(data.bathroom+' Bathrooms');
                    }
                    else{
                        $(".bathroom").text(data.bathroom+' Bathroom');
                    }
                    $(".listing_page_link").val(data.url);
                    
                    $(".whatsapp_link").attr('href','https://wa.me/?text='+data.url);
                    $(".facebook_link").attr('href','https://www.facebook.com/sharer/sharer.php?u='+data.url);
                    $(".twitter_link").attr('href','https://twitter.com/intent/tweet?text='+data.url);
                    $(".linkedin_link").attr('href','https://www.linkedin.com/sharing/share-offsite?mini=true&url='+data.url+'&title=Gimmzi+Travel+Tourism&summary=');
                });

                @this.on('imageslick', function(){
                    sliderInit();
                })


                @this.on('loginMessagePopup', data =>{
                    $("#favourite_modal").modal('show');
                    $("#loginmsg").html(data.message);
                });
                @this.on('favoriteLogin', data =>{
                    $("#loginModal").modal('show');
                    $("#favourite_modal").modal('hide');
                    sessionStorage.setItem("get_page", "short_term_website_page");
                    sessionStorage.setItem("get_page_id", data.id);
                    $("#nav-home-tab").removeClass('active');
                    $("#nav-profile-tab").addClass('active');
                    $("#nav-home").removeClass('show');
                    $("#nav-home").removeClass('active');
                    $("#nav-profile").addClass('show');
                    $("#nav-profile").addClass('active');
                });

         })

         $(document).ready(function () {
            $(document).on('show.bs.modal', '.modal', function() {
                const zIndex = 1040 + 10 * $('.modal:visible').length;
                $(this).css('z-index', zIndex);
                setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
            });
        });  
    </script>

    @endpush
</div>
