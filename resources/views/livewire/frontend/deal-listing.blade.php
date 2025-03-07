<div>
    @push('style')
        <style>
            div.pac-container {
                z-index: 1000000 !important;
            }
        </style>
    @endpush
    <div class="purchase-sec cmn-gap pt-0">
        <div class="purchase-top">
            <div class="container">
                <div class="purchase-top-blk">
                    <h2 class="h1-title">
                        <span>Earn points on loyalty purchases</span>
                        <span>Redeem for deals</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="purchase-mdl">
            <div class="container">
                <div class="purchase-mdl-blk">
                    <div class="purchase-mdl-blk-lft">
                        <button type="button" class="categories-btn">
                            <span>
                                <img loading="lazy" src="{{ asset('frontend_assets/images/btn-ic.svg') }}"
                                    alt="button icon">
                            </span>
                            Categories
                        </button>
                    </div>
                    <div class="purchase-mdl-blk-rit">
                        <input type="text" placeholder="Zip Code, Town, or City" wire:model='location'
                            id="autocomplete1">
                        <input type="hidden" wire:model='latitude' id="latitude">
                        <input type="hidden" wire:model='longitude' id="longitude">
                    </div>
                </div>

            </div>
        </div>
        <div class="purchase-btm">
            <div class="container">
                <div class="purchase-ul">
                    <div class="row rowspan">
                        @forelse ($businesses as $business)
                            <div class="col-md-6">
                                <div class="purchase-box">
                                    <div class="purchase-box-lft">
                                        <div class="purchase-wishlst">
                                            <a href="javascript:void(0)" class="cmn-purchase">
                                                <img loading="lazy"
                                                    src="{{ asset('frontend_assets/images/hrtss.svg') }}"
                                                    alt="heart1 icon">
                                            </a>
                                            <span>Save</span>
                                        </div>
                                        <div class="purchase-wishlst share-blkss" data-bs-toggle="modal"
                                            data-bs-target="#shareModal">
                                            <a href="javascript:void(0)" class="cmn-purchase">
                                                <img loading="lazy"
                                                    src="{{ asset('frontend_assets/images/shrss.svg') }}"
                                                    alt="share icon">
                                            </a>
                                            <span>Share</span>
                                        </div>
                                        <figure class="purchase-fig">
                                            <a href="{{ route('frontend.merchant.website', $business->id) }}">
                                                <img loading="lazy" src="{{ asset($business->main_image_url) }}"
                                                    alt="{{ $business->business_name }}" width="234" height="166">
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="purchase-box-rit">
                                        <h3 class="h2-title">
                                            <a
                                                href="{{ route('frontend.merchant.website', $business->id) }}">{{ $business->business_name }}</a>
                                        </h3>
                                        @if ($business->head_location)
                                            <p>{{ $business->head_location }}
                                            </p>
                                        @endif
                                        <div class="purchase-btn-grp">
                                            <a href="javascript:void(0)"
                                                class="purchasecmnbtn">{{ $business->deals_count }} Deals
                                                Available</a>
                                            <a href="javascript:void(0)" class="purchasegrnbtn purchasecmnbtn">Loyalty
                                                Rewards</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Social Sharing Modal -->
                            <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered custom-modal">
                                    <div class="modal-content">
                                        <!-- Close Button at Top-Right -->
                                        <button type="button" class="btn-close position-absolute"
                                            style="top: 10px; right: 10px; z-index: 1050;" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>

                                        <div class="modal-body text-center">
                                            <span>{{ $business->business_name }}</span><br>
                                            <span>
                                                @if ($business->street_address != '')
                                                    {{ $business->street_address }}, {{ $business->city }},
                                                    {{ $business->states->name }}, {{ $business->zip_code }}
                                                @endif
                                            </span><br>
                                            <span>{{ $business->business_phone }}</span>

                                            <hr>
                                            <small>Share this business, earn points!</small>
                                            Start Earning Points and make every share count!
                                            <div class="row align-items-center">
                                                <!-- Left Side - Image -->
                                                <div class="col-md-5 text-center">
                                                    <img loading="lazy" src="{{ asset($business->main_image_url) }}"
                                                        alt="{{ $business->business_name }}" width="234"
                                                        height="166" class="img-fluid rounded">

                                                </div>
                                                <!-- Right Side - Text and Share Buttons -->
                                                <div class="col-md-7">
                                                    <!-- Share Buttons -->
                                                    <div class="row text-center my-3">
                                                        <!-- Facebook -->
                                                        <div class="col-6 mb-3">
                                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                                target="_blank"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/facebook.svg') }}"
                                                                    alt="Facebook"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>Facebook</span>
                                                            </a>
                                                        </div>
                                                        <!-- X (Example: Custom Social Network or Function) -->
                                                        <div class="col-6 mb-3">
                                                            <a href="https://x.com/intent/tweet?text={{ urlencode(url()->current()) }}"
                                                                target="_blank"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/X.svg') }}"
                                                                    alt="X"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>X</span>
                                                            </a>
                                                        </div>
                                                        <!-- LinkedIn -->
                                                        <div class="col-6 mb-3">
                                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title=YourPageTitle&summary=YourSummaryHere"
                                                                target="_blank"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/linkedin.svg') }}"
                                                                    alt="LinkedIn"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>LinkedIn</span>
                                                            </a>
                                                        </div>
                                                        <!-- WhatsApp -->
                                                        <div class="col-6 mb-3">
                                                            <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"
                                                                target="_blank"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/whatsapp.svg') }}"
                                                                    alt="WhatsApp"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>WhatsApp</span>
                                                            </a>
                                                        </div>
                                                        <!-- Email -->
                                                        <div class="col-6 mb-3">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#shareSocialModal"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/email.svg') }}"
                                                                    alt="Email"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>Email</span>
                                                            </a>
                                                        </div>
                                                        <!-- Copy Link -->
                                                        <div class="col-6 mb-3">
                                                            <a href="#"
                                                                onclick="copyToClipboard('{{ url()->current() }}'); return false;"
                                                                class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                                                                <img src="{{ asset('frontend_assets/images/copy.svg') }}"
                                                                    alt="Copy Link"
                                                                    style="height: 30px; margin-right: 8px;">
                                                                <span>Copy Link</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <p class="mt-3" style="background-color: #f2f4f7">Earn 1 point for each
                                                listing you share on
                                                Facebook, X
                                                (formerly Twitter)
                                                , and LinkedIn (10 point limit per day).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="h2-title text-center">No Result Found</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script async defer type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>
        <script>
            $("#autocomplete1").on('keyup', function() {

                var input = document.getElementById('autocomplete1');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.setComponentRestrictions({
                    'country': ['us']
                });
                google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
                    var place = autocomplete.getPlace();
                    console.log(place);
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                    @this.set('latitude', place.geometry['location'].lat());
                    @this.set('longitude', place.geometry['location'].lng());
                    @this.set('location', place.formatted_address);
                });
            });
        </script>
    @endpush
</div>
