<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
    <x-admin.form-group>
            <x-admin.lable value="Select Provider Type" required />
            <x-admin.dropdown wire:model.defer="type_id" placeHolderText="Please select one" autocomplete="off" id="type_id"
                class="{{ $errors->has('type_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($typeList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="type_id" />
        </x-admin.form-group>
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable value="Select Provider" required />
            <x-admin.dropdown wire:model.defer="provider_id" placeHolderText="Please select one" autocomplete="off" id="provider_id"
                class="{{ $errors->has('provider_id') ? 'is-invalid' : '' }}" wire:ignore>
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
               
            </x-admin.dropdown>
            <x-admin.input-error for="provider_id" />
        </x-admin.form-group>
        @else
        <x-admin.form-group>
            <x-admin.lable value="Select Provider" required />
            <x-admin.dropdown wire:model.defer="provider_id" placeHolderText="Please select one" autocomplete="off" id="provider_id"
                class="{{ $errors->has('provider_id') ? 'is-invalid' : '' }}" wire:ignore>
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($providerList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="provider_id" />
        </x-admin.form-group>

        @endif
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable for="building_id" value="Select Provider Building(optional)"  />
            <x-admin.dropdown wire:model.defer="building_id" placeHolderText="Please select one" autocomplete="off" id="building_id"
            class="{{ $errors->has('building_id') ? 'is-invalid' : '' }}" wire:ignore>
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
        </x-admin.dropdown>  
        <x-admin.input-error for="building_id" />
        </x-admin.form-group>
        @else
        <x-admin.form-group>
            <x-admin.lable for="building_id" value="Select Provider Building(optional)"  />
            <x-admin.dropdown wire:model.defer="building_id" placeHolderText="Please select one" autocomplete="off" id="building_id"
            class="{{ $errors->has('building_id') ? 'is-invalid' : '' }}" wire:ignore>
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
            @foreach ($buildingList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->building_name" />
            @endforeach
        </x-admin.dropdown>  
        <x-admin.input-error for="building_id" />
        </x-admin.form-group>
        @endif
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable value=" Building Unit(optional)"  />
            <x-admin.dropdown wire:model.defer="unit_id" placeHolderText="Please select one" autocomplete="off" id="unit_id"
                class="{{ $errors->has('unit_id') ? 'is-invalid' : '' }}" wire:ignore>
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
            </x-admin.dropdown>
            <x-admin.input-error for="unit_id" />
        </x-admin.form-group>
        @else
        <x-admin.form-group>
            <x-admin.lable value=" Building Unit(optional)"  />
            <x-admin.dropdown wire:model.defer="unit_id" placeHolderText="Please select one" autocomplete="off" id="unit_id"
                class="{{ $errors->has('unit_id') ? 'is-invalid' : '' }}" wire:ignore>
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($unitList as $data)
                  <x-admin.dropdown-item :value="$data->id" :text="$data->unit" />
                @endforeach 
            </x-admin.dropdown>
            <x-admin.input-error for="unit_id" />
        </x-admin.form-group>
        @endif
        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.consumer.providers',$user_id)" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>
    @push('scripts')
    <script>
    $(document).ready(function() {
        $("#type_id").on('change',function() {
            var type_id = $(this).val();
            // console.log(provider_Id);
            $.ajax({
                url: '{{ route('get.provider.type') }}',
                type: 'get',
                data: {
                    'type_id' : type_id
                },
                success: function(result) {
                    console.log(result);
                    if (result.success == 1){
                        if(result.data.length > 0 ){
                            $('#provider_id').html('<option value="">Select Provider</option>');
                              $.each(result.data, function(id, value) {
                                $("#provider_id").append('<option value="' + value.id +'">' + value.name +'</option>');
                              });
                              $("#building_id").prop("disabled", false);
                              $('#unit_id').prop("disabled", false);
                        }
                        else{
                            $('#provider_id').html('<option value="">No Provider found</option>');
                        }
                    } 
                    else if(result.success == 2){

                        if(result.data.length > 0 ){
                            $('#provider_id').html('<option value="">Select Provider</option>');
                               $.each(result.data, function(id, value) {
                                 $("#provider_id").append('<option value="' + value.id +'">' + value.name +'</option>');
                               });
                            $("#building_id").html(" ");
                            $('#unit_id').html(" ");
                            $("#building_id").prop("disabled", true);
                            $('#unit_id').prop("disabled", true);
                        }
                        else{
                            $('#provider_id').html('<option value="">No Provider found</option>');
                        }
                        
                    }
                    else if(result.success == 3){
                        if(result.data.length > 0 ){
                            $('#provider_id').html('<option value="">Select Provider</option>');
                                $.each(result.data, function(id, value) {
                                $("#provider_id").append('<option value="' + value.id +'">' + value.name +'</option>');
                            });
                            $("#building_id").html(" ");
                            $('#unit_id').html(" ");
                            $("#building_id").prop("disabled", true);
                            $('#unit_id').prop("disabled", true);
                        }
                        else{
                            $('#provider_id').html('<option value="">No Provider found</option>');
                        }
                        
                    } 
                    else{
                        $('#provider_id').html('<option value="">No Provider found</option>');
                    }    
                }
            });
        });
    });


    $(document).ready(function() {
        $("#provider_id").on('change',function() {
            var provider_Id = $(this).val();
            // console.log(provider_Id);
            $.ajax({
                url: '{{ route('get.consumer.building') }}',
                type: 'get',
                data: {
                    'provider_Id' : provider_Id
                },
                success: function(result) {
                    // console.log(result);
                if (result.success == 1){
                    $('#building_id').html('<option value="">Select Building</option>');
                        $.each(result.data, function(id, value) {
                        $("#building_id").append('<option value="' + value.id +'">' + value.building_name +'</option>');
                    });
                } else{
                    $('#building_id').html('<option value="">No Building found</option>');
                }
                        
                }
            });
        });
    });

    $(document).ready(function() {
        $("#building_id").on('change',function() {
            var building_Id = $(this).val();
            // console.log(provider_Id);
            $.ajax({
                url: '{{ route('get.building.unit') }}',
                type: 'get',
                data: {
                    'building_Id' : building_Id
                },
                success: function(result) {
                     console.log(result);
                if (result.success == 1){
                    if(result.data.length > 0){
                        $('#unit_id').html('<option value="">Select Building Unit</option>');
                        $.each(result.data, function(id, value) {
                          $("#unit_id").append('<option value="' + value.id +'">' + value.unit +'</option>');
                        });
                    }
                    else{
                        $('#unit_id').html('<option value="">No Building Unit found</option>');
                    }
                    
                } else{
                    $('#unit_id').html('<option value="">No Building Unit found</option>');
                }
                        
                }
            });
        });
    });

    
    </script>
    @endpush
