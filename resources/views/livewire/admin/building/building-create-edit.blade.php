<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Select Provider" required />
            <x-admin.dropdown wire:model.defer="provider_type_id" placeHolderText="Please select one" autocomplete="off" id="provider"
                class="{{ $errors->has('provider_type_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($providerTypeList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->name.'('.$data->providerId.')'" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="provider_type_id" />
        </x-admin.form-group>
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable value="Provider User" />
            <x-admin.input type="text" placeholder="Provider User Name" class="{{ $errors->has('provider_id') ? 'is-invalid' : '' }}" id="providerUserName" disabled="true"/>
            {{-- <input type="hidden" wire:model.defer="provider_id"  id="providerUserId" /> --}}
            <x-admin.input-error for="provider_id" />
        </x-admin.form-group>
        @else
        <x-admin.form-group>
            <x-admin.lable value="Provider User" />
            <x-admin.input type="text" placeholder="Provider User Name" wire:model.defer="user_name" class="{{ $errors->has('provider_id') ? 'is-invalid' : '' }}" id="providerUserName" disabled="true"/>
            {{-- <input type="hidden" wire:model.defer="provider_id"  id="providerUserId" /> --}}
            <x-admin.input-error for="provider_id" />
        </x-admin.form-group>
        @endif
      
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
        <x-admin.link :href="route('buildings.index')" color="secondary">Cancel</x-admin.link>
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
            var provider_Id = $(this).val();
            $.ajax({
                url: '{{ route('get.providerUser') }}',
                type: 'get',
                data: {
                    'provider_Id' : provider_Id
                },
                success: function(result) {
                    // console.log(result.data);
                    if (result.success == 1)
                    {
                        
                        $('#providerUserName').val(result.data.first_name+' '+result.data.last_name+'('+result.data.userId+')');
                        // $('#providerUserId').val(result.data.id);
                        
                    }
                }
            });
        });
    });
    </script>
    @endpush