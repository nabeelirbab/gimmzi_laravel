<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Coupon Code" required />
            <x-admin.input type="text" wire:model.defer="coupon_code" placeholder="Coupon Code"
                class="{{ $errors->has('coupon_code') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="coupon_code" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Category" required/>
            <x-admin.dropdown wire:model.defer="category_id"  autocomplete="off"
                class="{{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                <option value=""disabled seleted>Select Category</option>
                @foreach ($categoryList as $data)
                    <x-admin.dropdown-item :value="$data->id" :text="$data->category_name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="category_id" />
        </x-admin.form-group>
          
        <x-admin.form-group>
            <x-admin.lable value="Point" required />
            <x-admin.input type="text" wire:model.defer="point" placeholder="Point"
                class="{{ $errors->has('point') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="point" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Expired Date" required />
            <x-admin.input type="date" wire:model.defer="expired_at" placeholder="2022-09-09"
                class="{{ $errors->has('expired_at') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="expired_at" />
        </x-admin.form-group>
        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('coupons.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>

@push('scripts')
<script>
    function isNumber(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>
@endpush
