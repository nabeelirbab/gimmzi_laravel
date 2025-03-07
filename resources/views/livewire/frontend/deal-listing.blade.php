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
                                        <div class="purchase-wishlst share-blkss">
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
