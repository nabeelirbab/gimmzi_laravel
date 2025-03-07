<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form"> 
        <x-admin.form-group>
            <x-admin.lable value="Select Business Category " required />
            <x-admin.dropdown wire:model.defer="business_category_id" placeHolderText="Please select one" autocomplete="off" 
                class="{{ $errors->has('business_category_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($businessCategoryList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->category_name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="business_category_id" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Item Or Service Name" required />
            <x-admin.input type="text" wire:model.defer="item_name" placeholder="Item Or Service Name"
                class="{{ $errors->has('item_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="item_name" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Value" />
            <x-admin.input type="text" wire:model.defer="item_value" placeholder="Value"
                class="{{ $errors->has('item_value') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="item_value" />
        </x-admin.form-group>


        <x-admin.form-group>
            <x-admin.lable value="Note" />
            <x-admin.input type="text" wire:model.defer="note" placeholder="Note"
                class="{{ $errors->has('note') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="note" />
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
        <x-admin.link :href="route('item-service.index')" color="secondary">Cancel</x-admin.link>
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
