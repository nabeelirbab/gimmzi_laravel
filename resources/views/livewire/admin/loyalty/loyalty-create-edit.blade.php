<div>
    <div class="kt-portlet kt-portlet--mobile">
        <form wire:submit.prevent="loyalty_submit">
            <div class="kt-portlet__body">
                
                <div class="row">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-size:21px;"><strong>Edit Loyalty Reward Program</strong></h3>
                        </div>
                        
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    {{-- <div class="form-group col-lg-6">
                        <label>Merchant Name</label>
                        <input type="text" class="form-control border-gray-200" wire:model ="deal_merchant_name" readonly>
                    </div> --}}
                    
                    <div class="form-group col-lg-6">
                        <label>Program Name</label>
                        <input type="text" class="form-control border-gray-200" wire:model = "loyalty_name">
                        @error('suggested_description')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Program Type</label>
                        <input type="text" class="form-control border-gray-200" wire:model = "program_type" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Start Date</label>
                        <input type="text" class="form-control border-gray-200 start_datepicker" wire:model= "start_date" id="start_datepicker">
                        @error('start_date')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-6">
                        <label>End Date</label>
                        <input type="text" class="form-control border-gray-200 end_datepicker" wire:model = "end_date" id="end_datepicker">
                        @error('start_date')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    @if($program_type == 'free')
                    <div class="form-group col-lg-6">
                        <label>Have To Buy</label>
                        <input type="text" class="form-control border-gray-200" wire:model="have_to_buy">
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Free Item Number</label>
                        <input type="text" class="form-control border-gray-200" wire:model="free_item_no">
                    </div>
                    @else
                    <div class="form-group col-lg-6">
                        <label>Spend Amount</label>
                        <input type="text" class="form-control border-gray-200" wire:model="spend_amount" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Amount</label>
                        <input type="text" class="form-control border-gray-200" wire:model="discount_amount" readonly>
                    </div>
                    @endif
                    <div class="form-group col-lg-6">
                        <label>Point</label>
                        <input type="text" class="form-control border-gray-200" wire:model="point">
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control border-gray-200" wire:model="loyalty_image" id="file-up" >
                        <div>
                            @if($loyalty_image != "")
                                <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{ asset('storage/tmp/'.$loyalty_image->getFilename()) }}" alt="">
                            @else
                                @if($loyalty_main_image)
                                    <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{asset($loyalty_main_image)}}">
                                @endif
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group col-lg-6"></div> --}}
                    <div class="form-group col-lg-6">
                        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
                        <x-admin.link :href="route('loyaltys.index')" color="secondary">Cancel</x-admin.link>
                    </div>
                </div>
            </div>
        </form>
    </div>
@push('scripts')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
    document.addEventListener('livewire:load', function(event) {
        $('#start_datepicker').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText) {
                @this.set('start_date', dateText);
            }
        });

        $('#end_datepicker').datepicker({
            dateFormat: 'mm-dd-yy',
            onSelect: function (dateText) {
                @this.set('end_date', dateText);
            }
        });
    });

</script>
@endpush
</div>
