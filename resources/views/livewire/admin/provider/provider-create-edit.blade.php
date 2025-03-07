<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Provider Type" required />
            <x-admin.dropdown wire:model.defer="provider_sub_type_id" placeHolderText="Please select one"
                autocomplete="off" class="{{ $errors->has('provider_sub_type_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($typeList as $type)
                    <optgroup label="{{ $type->name }}">
                        @foreach ($type->subType as $data)
                            <x-admin.dropdown-item :value="$data->id" :text="$data->name" />
                        @endforeach
                    </optgroup>
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="provider_sub_type_id" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Name" required />
            <x-admin.input type="text" wire:model.defer="name" placeholder="Name"
                class="{{ $errors->has('name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Phone" />
            <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone"
                class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);" />
            <x-admin.input-error for="phone" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Address" required />
            <x-admin.input type="text" wire:model.defer="address" placeholder="Address"
                class="{{ $errors->has('address') ? 'is-invalid' : '' }}" id="autocomplete1" />
            <x-admin.input-error for="address" />
        </x-admin.form-group>

        <input type="hidden" wire:model.defer="latitude" id="latitude">

        <input type="hidden" wire:model.defer="longitude" id="longitude">

        <x-admin.input type="hidden" wire:model.defer="zip_code" placeholder="Zip Code" autocomplete="off"
            class="{{ $errors->has('zip_code') ? 'is-invalid' : '' }}" id="zipCode"
            onkeypress="return isNumber(event);" />
        <x-admin.input-error for="zip_code" />
        <span id="ziperror"></span>

        <x-admin.input type="hidden" wire:model.defer="city" placeholder="City"
            class="{{ $errors->has('city') ? 'is-invalid' : '' }}" id="profilecity" />
        <x-admin.input-error for="city" />

        <x-admin.input type="hidden" wire:model.defer="state" placeholder="state"
            class="{{ $errors->has('state') ? 'is-invalid' : '' }}" id="profilecity" />
        <x-admin.input-error for="state" />


        <x-admin.form-group>
            <x-admin.lable value="Business Website" />
            <x-admin.input type="text" wire:model.defer="business_website" placeholder="Business Website"
                autocomplete="off" class="{{ $errors->has('business_website') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="business_website" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Points To Distribute" required />
            <x-admin.input type="text" wire:model.defer="points_to_distribute" onkeypress="return isNumber(event);"
                placeholder="Points To Distribute" autocomplete="off"
                class="{{ $errors->has('points_to_distribute') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="points_to_distribute" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Point Cycle Date" required />
            <x-admin.dropdown wire:model.defer="points_cycle_date" placeHolderText="Please select one"
                autocomplete="off" class="{{ $errors->has('points_cycle_date') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($numberList as $number)
                    <x-admin.dropdown-item :value="$number['value']" :text="$number['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="points_cycle_date" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Join Date" required />
            <x-admin.input type="date" wire:model.defer="join_date" placeholder="Join Date" autocomplete="off"
                class="{{ $errors->has('join_date') ? 'is-invalid' : '' }} cycleDate" />
            <x-admin.input-error for="join_date" />
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
                <x-admin.lable value="Business Logo" />
            @else
                <x-admin.lable value="Business Logo" required />
            @endif
            @if ($model_image1)
                <img src="{{ $model_image1->getUrl() }}" style="width: 100px; height:100px;" /><br />
            @endif
            <x-admin.filepond wire:model="logo" class="{{ $errors->has('logo') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb" />
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="logo" />
            </div>
        </x-admin.form-group>

        <x-admin.form-group>
            @if ($isEdit)
                <x-admin.lable value="Photo" />
            @else
                <x-admin.lable value="Photo" required />
            @endif
            <div class="d-flex flex-wrap  my-3">
                @foreach ($model_image2 as $images)
                    <div>
                        <img src="{{ $images->getUrl() }}" style="width: 90px; height:90px;margin:10px 5px;" /><br />
                        <button type="button" wire:click="deleteImages({{ $images->id }})">&nbsp; | &nbsp;&nbsp;<i
                                class="fa fa-trash"></i>Delete</button><br />
                    </div>
                @endforeach
            </div>
            <x-admin.filepond wire:model="photos" class="{{ $errors->has('photos') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb" multiple />
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="photos" />
            </div>
        </x-admin.form-group>

        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('providers.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>
    @push('scripts')
        <script async defer type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_GEOCODE_API_KEY') }}&libraries=places"></script>

        <script>
            function isNumber(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            $("#autocomplete1").on('keyup', function() {
                var input = document.getElementById('autocomplete1');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.setComponentRestrictions({
                    'country': ['us']
                });
                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    console.log(place);
                    $('#latitude').val(place.geometry['location'].lat());
                    $('#longitude').val(place.geometry['location'].lng());
                    @this.set('latitude', place.geometry['location'].lat());
                    @this.set('longitude', place.geometry['location'].lng());
                    @this.set('address', place.formatted_address);



                    for (var i = 0; i < place.address_components.length; i++) {
                        console.log(place.address_components[i]);
                        for (var j = 0; j < place.address_components[i].types.length; j++) {
                            if (place.address_components[i].types[j] == "postal_code") {

                                $("#zipcode").val(place.address_components[i].long_name);
                                @this.set('zip_code', place.address_components[i].long_name);
                            }
                            if (place.address_components[i].types[j] == "administrative_area_level_1") {
                                window.livewire.emit('checkState', [place.address_components[i].long_name]);

                                $("#state").val(place.address_components[i].long_name);
                                @this.set('state', place.address_components[i].long_name);


                            }
                            if (place.address_components[i].types[j] == "locality") {

                                $("#city").val(place.address_components[i].long_name);
                                @this.set('city', place.address_components[i].long_name);
                            }

                        }

                    }

                });
            });
            // $("#zipCode").on('keyup', function() {
            //     var zipcode = $(this).val();
            //     if (zipcode.length == 5) {
            //         $.ajax({
            //             url: '{{ route('get.city') }}',
            //             type: 'get',
            //             data: {
            //                 'zipcode': zipcode
            //             },
            //             success: function(result) {
            //                 console.log(result);
            //                 if (result.success == 1) {
            //                     $("#profilecity").val(result.data.City);
            //                     $("#ziperror").html('');
            //                     @this.set('city', result.data.City);
            //                     $("#profileState").val(result.state_name);
            //                     @this.set('state_id', result.state_name);
            //                 } else {
            //                     $("#ziperror").html(result.data[0]);
            //                     $("#ziperror").css('color', 'red');
            //                 }

            //             }
            //         });
            //     } else {
            //         //$("#profilecity").val('');
            //     }

            // });
        </script>
    @endpush
