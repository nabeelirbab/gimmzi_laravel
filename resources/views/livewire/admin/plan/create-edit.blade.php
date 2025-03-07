<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        
        <x-admin.form-group>
            <x-admin.lable value="Plan Name" required />
            <x-admin.input type="text" wire:model.defer="plan_name" placeholder="Plan Name"
                class="{{ $errors->has('plan_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="plan_name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Plan Color" required />
            <x-admin.input type="color" wire:model.defer="plan_color" placeholder="Plan Color"
                class="{{ $errors->has('plan_color') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="plan_color" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Monthly Amount($)" required />
            <x-admin.input type="text" wire:model.defer="monthly_amount" placeholder="Monthly Amount"
                class="{{ $errors->has('monthly_amount') ? 'is-invalid' : '' }}"/>
            <x-admin.input-error for="monthly_amount" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Yearly Amount($)" required />
            <x-admin.input type="text" wire:model.defer="yearly_amount" placeholder="Yearly Amount"
                class="{{ $errors->has('yearly_amount') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="yearly_amount" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Is Free" required />
            <x-admin.dropdown wire:model.defer="is_free" id="is_free" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('is_free') ? 'is-invalid' : '' }}">
                @foreach ($freeList as $freeValue)
                    <x-admin.dropdown-item :value="$freeValue['value']" :text="$freeValue['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="is_free" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Total Active Deal" required />
            <x-admin.input type="text" wire:model.defer="active_deal_number" placeholder="Total Active Deal"
                class="{{ $errors->has('active_deal_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="active_deal_number" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Total Access User" required />
            <x-admin.input type="text" wire:model.defer="access_user_number" placeholder="Total Access User"
                class="{{ $errors->has('access_user_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="access_user_number" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Total Participating Location" required />
            <x-admin.input type="text" wire:model.defer="location_number" placeholder="Total Participating Location"
                class="{{ $errors->has('location_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="location_number" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Total Loyalty Program" required />
            <x-admin.input type="text" wire:model.defer="loyalty_program_number" placeholder="Total Loyalty Program"
                class="{{ $errors->has('loyalty_program_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="loyalty_program_number" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Total Item-service" required />
            <x-admin.input type="text" wire:model.defer="item_services_number" placeholder="Total Item-service"
                class="{{ $errors->has('item_services_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="item_services_number" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Discount(%)" required />
            <x-admin.input type="text" wire:model.defer="discount" placeholder="Discount"
                class="{{ $errors->has('discount') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="discount" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Free Trial Days" required />
            <x-admin.input type="text" wire:model.defer="free_trial_Days" placeholder="Free Trial Days"
                class="{{ $errors->has('free_trial_Days') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="free_trial_Days" />
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
        <x-admin.link :href="route('plans.index')" color="secondary">Cancel</x-admin.link>
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


    $("#is_free").on('change',function(){
        if($(this).val() == 1){
            @this.set('monthly_amount', 0);
            @this.set('yearly_amount', 0);
            @this.set('discount', 0);
            @this.set('free_trial_Days', 0);
        }
        
    })

</script>
@endpush
