<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">

        <x-admin.form-group>
            <x-admin.lable value="Name" required />
            <x-admin.input type="text" wire:model.defer="name" placeholder="Name"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Phone"  />
            <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone"
                class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="phone" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Address" required />
            <x-admin.input type="text" wire:model.defer="address" placeholder="Address"
                class="{{ $errors->has('address') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="address" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Zip code" required />
            <x-admin.input type="text" wire:model.defer="zip_code" placeholder="Zip Code" autocomplete="off"
                class="{{ $errors->has('zip_code') ? 'is-invalid' : '' }}" id="zipCode" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="zip_code" />
            <span id="ziperror"></span>
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="City" required />
            <x-admin.input type="text" wire:model.defer="city" placeholder="City"
                class="{{ $errors->has('city') ? 'is-invalid' : '' }}" id="profilecity" readonly/>
            <x-admin.input-error for="city" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="State" required />
            <x-admin.dropdown wire:model.defer="state_id"  placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('state_id') ? 'is-invalid' : '' }}" id="profileState">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($stateList as $states)
                    <x-admin.dropdown-item :value="$states->id" :text="$states->name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="state_id" />
        </x-admin.form-group>
       
       
    
        <x-admin.form-group>
            <x-admin.lable value="Points To Distribute" required />
            <x-admin.input type="text" wire:model.defer="points_to_distribute" onkeypress="return isNumber(event);" placeholder="Points To Distribute" autocomplete="off"
                class="{{ $errors->has('points_to_distribute') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="points_to_distribute" />
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

        
        <x-admin.form-group>
            @if ($isEdit)
                <x-admin.lable value="Photo" />
            @else
                <x-admin.lable value="Photo" required />
            @endif
            @if ($model_image)
                <img src="{{ $model_image->getUrl() }}" style="width: 100px; height:100px;" /><br />
            @endif
            <x-admin.filepond wire:model="photo" class="{{ $errors->has('photo') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb"/>
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="photo" />
            </div>
        </x-admin.form-group>

        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('hotel-resorts.index')" color="secondary">Cancel</x-admin.link>
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


        $("#zipCode").on('keyup',function() {
            var zipcode = $(this).val();
            if(zipcode.length == 5){
                $.ajax({
                    url: '{{ route('get.city') }}',
                    type: 'get',
                    data: {
                        'zipcode' : zipcode
                    },
                    success: function(result) {
                        console.log(result);
                        if(result.success == 1){
                            $("#profilecity").val(result.data.City);
                            $("#ziperror").html('');
                            @this.set('city',result.data.City);
                            $("#profileState").val(result.state_name);
                            @this.set('state_id',result.state_name);
                        }
                        else{
                            $("#ziperror").html(result.data[0]);
                            $("#ziperror").css('color','red');
                        }
                          
                    }
                });
            }
            else{
                //$("#profilecity").val('');
            }
        
        });

</script>
@endpush

