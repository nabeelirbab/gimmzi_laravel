<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Select Provider" required />
            <x-admin.dropdown wire:model.defer="hotel_id" placeHolderText="Please select one" autocomplete="off" 
                class="{{ $errors->has('hotel_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($providerTypeList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->name.'('.$data->travel_and_tourism_id.')'" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="hotel_id" />
        </x-admin.form-group>
        
      
        <x-admin.form-group>
            <x-admin.lable value="Building Name" required />
            <x-admin.input type="text" wire:model.defer="building_name" placeholder="Building Name" 
                class="{{ $errors->has('building_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="building_name" />
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
        <x-admin.link :href="route('hotel-buildings.index')" color="secondary">Cancel</x-admin.link>
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
    
    </script>
    @endpush