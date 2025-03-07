<div>
    <div class="kt-portlet kt-portlet--mobile">
        <form wire:submit.prevent="deal_submit">
            <div class="kt-portlet__body">
                
                <div class="row">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-size:21px;"><strong>Edit Deal</strong></h3>
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
                        <label>Suggested Description</label>
                        <input type="text" class="form-control border-gray-200" wire:model = "suggested_description">
                        @error('suggested_description')
                            <span class="invalid-message" role="alert" style="font-size: 12px; color:red;margin-bottom: 20px;">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6"></div>
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
                    <div class="form-group col-lg-6">
                        <label>Sales Amount</label>
                        <input type="text" class="form-control border-gray-200" wire:model="sales_amount">
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Type</label>
                        <select class ="form-control border-gray-200" wire:model.defer="discount_type">
                            <option value="free">Free</option>
                            <option value="discount">Discount</option>
                            <option value="percentage">Percentage</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Amount</label>
                        <input type="text" class="form-control border-gray-200" wire:model="discount_amount" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Point</label>
                        <input type="text" class="form-control border-gray-200" wire:model="point">
                    </div>
                    
                    <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control border-gray-200" wire:model="deal_image" id="file-up" >
                        <div>
                            @if($deal_image != "")
                                <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{ asset('storage/tmp/'.$deal_image->getFilename()) }}" alt="">
                            @else
                                @if($deal_main_image)
                                    <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{asset($deal_main_image)}}">
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-lg-6"></div>
                    <div class="form-group col-lg-6">
                        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
                        <x-admin.link :href="route('deals.index')" color="secondary">Cancel</x-admin.link>
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
