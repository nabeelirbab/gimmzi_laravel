<div class="">
    <div class="request-info-topper mt-4">
        {{-- <img class="itrip-logo-img" src="{{ $travel_tourism->short_term_logo}}" alt="title"> --}}
        <span class="cmn-sub-ttile">Request Info on Listing</span>
    </div>
    <div class="request-info-form">
        <p>
            Please fill out the form below and we will forward it to to get back to you as soon as possible
        </p>
        <form wire:submit.prevent="sendRequestForListing">
            <div class="row request-info-row">
                <div class="col-md-12 request-col">
                    <label>Name*</label>
                    <input type="text" wire:model.defer="guest_name">
                    @error('guest_name')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-md-6 request-col">
                    <label>Email*</label>
                    <input type="text" wire:model.defer="guest_email">
                    @error('guest_email')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-md-6 request-col">
                    <label>Phone*</label>
                    <input type="text" wire:model.defer="guest_phone" onkeypress="return isNumber(event);">
                    @error('guest_phone')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-md-6 request-col">
                    <div class="input-date" wire:ignore>
                        <label>Arrive Date</label>
                        <input type="text" class="custmArriveDatePicker" wire:model.defer="arrive_date">

                    </div>
                    @error('arrive_date')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                <div class="col-md-6 request-col">
                    <div class="input-date" wire:ignore>
                        <label>Departure Date</label>
                        <input type="text" class="custmDatePicker" wire:model.defer="departure_date">

                    </div>
                    @error('departure_date')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>

                {{-- <fieldset class="fieldset-col">


                </fieldset> --}}
                <div class="col-md-12 mb-3">
                    <span class="date-filed-para">
                        Please note that the dates you select are not guaranteed availability through Gimmzi
                        Smart Rewards. For accurate and up-to-date information on the availability of the listing,
                        we recommend visiting the direct website.
                    </span>
                </div>


                <div class="col-md-6 request-col">
                    <label>Adults</label>
                    <input type="text" wire:model.defer="adult" onkeypress="return isNumber(event);">
                    @error('adult')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 request-col">
                    <label>Children</label>
                    <input type="text" wire:model.defer="children" onkeypress="return isNumber(event);">
                    @error('children')
                    <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="col-md-6 request-col">
                    <div class="form_input_check">
                        <label>
                            <input type="checkbox" checked="" wire:mode.defer="is_flexible">
                            <span>My Travel Dates are flexible</span>
                        </label>
                    </div>
                </div>
                {{-- <div class="col-md-6 request-col" wire:ignore>
                    <label>Listing</label>
                    <input type="text">
                </div> --}}
                <div class="col-md-6 request-col">
                    <label>Listings</label>
                    <div class="multiSelect_wrap" wire:ignore>
                        <select class="multiSelect2" wire:model.defer="listing_id" data-placeholder="Choose anything"
                            multiple>
                            @if(count($shortTermRentalList) > 0)
                            @foreach($shortTermRentalList as $listings)
                            <option value="{{$listings->id}}">{{$listings->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-12 request-col">
                    <label>Comments / Request</label>
                    <textarea wire:mode.defer="comment"></textarea>
                </div>
                <div class="col-md-12 request-col submit-btn-wrp">
                    <!-- <input type="submit" value="Send"> -->
                    <!-- <button data-bs-toggle="modal" data-bs-target="#formsubmitpopup"
                        type="submit">Send</button> -->
                    <button type="submit" class="page-btn page-btn-green-peas" disabled>
                        Send
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function (event) {
            $('.multiSelect2' ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                closeOnSelect: false,
            });   
   });
        
</script>
@endpush