<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form"> 
        <x-admin.form-group>
            <x-admin.lable value="Select Provider " required />
            <x-admin.dropdown wire:model.defer="hotel_id" placeHolderText="Please select one" autocomplete="off" id="provider"
                class="{{ $errors->has('hotel_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($providerList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->name.'('.$data->travel_and_tourism_id.')'" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="hotel_id" />
        </x-admin.form-group>
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable for="building_id" value="Select Building" required />
            <x-admin.dropdown wire:model.defer="building_id" placeHolderText="Please select one" autocomplete="off" id="building"
            class="{{ $errors->has('building_id') ? 'is-invalid' : '' }}">
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
        </x-admin.dropdown>  
        <x-admin.input-error for="building_id" />
        </x-admin.form-group>

        @else
        <x-admin.form-group>
            <x-admin.lable for="building_id" value="Select Building" required />
            <x-admin.dropdown wire:model.defer="building_id" placeHolderText="Please select one" autocomplete="off" id="building"
            class="{{ $errors->has('building_id') ? 'is-invalid' : '' }}">
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
            @foreach ($buildingList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->building_name.'('.$data->buildingId.')'" />
            @endforeach
        </x-admin.dropdown>  
        <x-admin.input-error for="building_id" />
        </x-admin.form-group>

        @endif

        <x-admin.form-group>
            <x-admin.lable value="Building Unit" required />
            <x-admin.input type="text" wire:model.defer="unit_name" placeholder="Unit"
                class="{{ $errors->has('unit') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="unit" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Status" required />
            <x-admin.dropdown wire:model.defer="status" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('status') ? 'is-invalid' : '' }}">
                @foreach ($statusList as $status)
                <x-admin.dropdown-item :value="$status['value']" :text="$status['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="status" />
        </x-admin.form-group>
        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('hotel-unit.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>
    @push('scripts')
    <script>
    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
    
    $(document).ready(function() {
        $("#provider").on('change',function() {
            var hotel_id = $(this).val();
            
            $.ajax({
                url: '{{ route('get.hotelbuilding') }}',
                type: 'get',
                data: {
                    'hotel_id' : hotel_id
                },
                success: function(result) {
                    if (result.success == 1)
                        $('#building').html('<option>Select Building</option>');
                        $.each(result.data, function(id, value) {
                        $("#building").append('<option value="' + value.id +'">' + value.building_name +'('+ value.buildingId +')'+'</option>');
                    });
                }
            });
        });
    });
    </script>
    @endpush