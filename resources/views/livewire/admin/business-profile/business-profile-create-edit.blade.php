<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Business Type" required />
            <x-admin.dropdown wire:model.defer="business_type" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('business_type') ? 'is-invalid' : '' }}">
                @foreach ($businessType as $business)
                    <x-admin.dropdown-item :value="$business['value']" :text="$business['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="business_type" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Business Category" required />
            <x-admin.dropdown wire:model.defer="business_category_id" placeHolderText="Please select one" id="category_id"
                autocomplete="off" class="{{ $errors->has('business_category_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($categoryList as $category)
                <x-admin.dropdown-item :value="$category->id" :text="$category->category_name" />
            
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="business_category_id" />
        </x-admin.form-group>
        @if (!$isEdit)
        <x-admin.form-group>
            <x-admin.lable value="Service Type" required />
            <x-admin.dropdown wire:model.defer="service_type_id" placeHolderText="Please select one" id="service_id"
                autocomplete="off" class="{{ $errors->has('service_type_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
            </x-admin.dropdown>
            <x-admin.input-error for="service_type_id" />
        </x-admin.form-group>
        @else
        <x-admin.form-group>
            <x-admin.lable  value="Service Type" required />
            <x-admin.dropdown wire:model.defer="service_type_id" placeHolderText="Please select one" autocomplete="off" id="service_id"
            class="{{ $errors->has('service_type_id') ? 'is-invalid' : '' }}">
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
            @foreach ($serviceList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->service_name" />
            @endforeach
        </x-admin.dropdown>  
        <x-admin.input-error for="service_type_id" />
        </x-admin.form-group>
        @endif
      

        <x-admin.form-group>
            <x-admin.lable value="Business Name" required />
            <x-admin.input type="text" wire:model.defer="business_name" placeholder="Business Name"
                class="{{ $errors->has('business_name') ? 'is-invalid' : '' }}" id="business"/>
            <x-admin.input-error for="business_name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Business Phone Number" required />
            <x-admin.input type="text" wire:model.defer="business_phone" placeholder="Business Phone"
                class="{{ $errors->has('business_phone') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="business_phone" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Business Fax Number"  />
            <x-admin.input type="text" wire:model.defer="business_fax_number" placeholder="Business Fax Number"
                class="{{ $errors->has('business_fax_number') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="business_fax_number" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Business Email" required />
            <x-admin.input type="text" wire:model.defer="business_email" placeholder="Business Email"
                class="{{ $errors->has('business_email') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="business_email" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Street Address (or Mailing Address if Business Type is Mobile or Online Only)" required />
            <x-admin.input type="text" wire:model.defer="street_address" placeholder="Address" id="mailingaddress"
                class="{{ $errors->has('street_address') ? 'is-invalid' : '' }}" onkeyup="mailinitAutocomplete()"/>
            <x-admin.input-error for="street_address" />
        </x-admin.form-group>
        <input type="hidden" wire:model.defer="latitude" id="latitude"> 
        <input type="hidden" wire:model.defer="longitude" id="longitude">
        <x-admin.form-group>
            <x-admin.lable value="Zip code" required />
            <x-admin.input type="text" wire:model.defer="zip_code" placeholder="Zip Code" autocomplete="off"
                class="{{ $errors->has('zip_code') ? 'is-invalid' : '' }}" id="zipCode" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="zip_code" />
            <span id="ziperror"></span>
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="City" required />
            <x-admin.input type="text" wire:model="city" placeholder="City" autocomplete="off"
                class="{{ $errors->has('city') ? 'is-invalid' : '' }}"  id="profilecity"/>
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
            <x-admin.lable value="Business Website"  />
            <x-admin.input type="text" wire:model.defer="business_page_link" placeholder="Business Website" autocomplete="off"
                class="{{ $errors->has('business_page_link') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="business_page_link" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Number of Location" required />
            <x-admin.input type="text" wire:model.defer="number_of_location" onkeypress="return isNumber(event);"  placeholder="Number of Location" autocomplete="off"
                class="{{ $errors->has('number_of_location') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="number_of_location" />
        </x-admin.form-group>
        @if(!$isEdit)
        <x-admin.form-group>
            <x-admin.lable value="Merchant Type" required />
            <x-admin.dropdown wire:model.defer="merchant_type" id="merchant_Type" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('merchant_type') ? 'is-invalid' : '' }}">
                @foreach ($merchantType as $merchant)
                    <x-admin.dropdown-item :value="$merchant['value']" :text="$merchant['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="merchant_type" />
        </x-admin.form-group>
        @endif

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
                <x-admin.lable value="Business Logo" />
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
                <x-admin.lable value="Business Image" />
            @else
                <x-admin.lable value="Business Image"/>
            @endif
            <div class="d-flex flex-wrap  my-3">
            @foreach($model_image2 as $images)
            
                <div>
                <img src="{{ $images->getUrl() }}" style="width: 90px; height:90px;margin:10px 5px;" /><br />
                <button type="button" wire:click="deleteImages({{ $images->id }})">&nbsp; | &nbsp;&nbsp;<i
                    class="fa fa-trash"></i>Delete</button><br/>
                </div>
            
            @endforeach
            </div>
            <x-admin.filepond wire:model="photos" class="{{ $errors->has('photos') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb" multiple/>
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="photos" />
            </div>
        </x-admin.form-group>

        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('business-profile.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>
    @push('scripts')
    {{-- <script src="https://maps.googleapis.com/maps/api/place/textsearch/output_type?query=your_query&location=latitude,longitude" type="text/javascript"></script> --}}
    <script async defer type="text/javascript" src="https://maps.google.com/maps/api/js?key={{env('GOOGLE_GEOCODE_API_KEY')}}&libraries=places"></script>
<script>
    function isNumber(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

        $(function() {
          $(document).ready(function () {
            var todaysDate = new Date();
            var year = todaysDate.getFullYear();
            var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
            var day = ("0" + todaysDate.getDate()).slice(-2);
            var maxDate = (year +"-"+ month +"-"+ day);
            $('.cycleDate').attr('min',maxDate);
          });
        });


    $(document).ready(function() {
        $("#category_id").on('change',function() {
            var category_Id = $(this).val();
            $.ajax({
                url: "{{ route('get.service.type') }}",
                type: 'get',
                data: {
                    'category_Id' : category_Id
                },
                success: function(result) {
                    if (result.success == 1)
                        $('#service_id').html('<option>Select Service Type</option>');
                        $.each(result.data, function(id, value) {
                        $("#service_id").append('<option value="' + value.id +'">' + value.service_name +'</option>');
                    });
                }
            });
        });
    

        // $("#zipCode").on('keyup',function() {
        //     var zipcode = $(this).val();
        //     if(zipcode.length == 5){
        //         $.ajax({
        //             url: "{{ route('get.city') }}",
        //             type: 'get',
        //             data: {
        //                 'zipcode' : zipcode
        //             },
        //             success: function(result) {
        //                 //console.log(result.data);
        //                 if(result.success == 1){
        //                     $("#profilecity").val(result.data.City);
        //                     $("#ziperror").html('');
        //                     @this.set('city',result.data.City);
        //                     $("#profileState").val(result.state_name);
        //                     @this.set('state_id',result.state_name);
        //                 }
        //                 else{
        //                     $("#ziperror").html(result.data[0]);
        //                     $("#ziperror").css('color','red');
        //                 }
                          
        //             }
        //         });
        //     }
        //     else{
        //         //$("#profilecity").val('');
        //     }
        
        // });

        $('#business').on('keyup',function() {
            var location = "<?php echo $location;?>";
           
            console.log(location);

        });
    });

    let mailautocomplete;
    function mailinitAutocomplete(){
        const input = document.getElementById('mailingaddress');

        if (!mailautocomplete) {
            mailautocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: { country: "us" },
            });

            // Listen for the place selection event
            mailautocomplete.addListener('place_changed', () => {
                const place = mailautocomplete.getPlace();
                console.log(place.formatted_address+'-0-0')
                if (place.formatted_address) {
                    Livewire.emit('mailupdateStreetAddress', place.formatted_address);
                }

                place.address_components.forEach(component => {
                    const types = component.types;

                    if (types.includes('locality')) {
                        Livewire.emit('mailupdateCity', component.long_name); // City
                    }
                    if (types.includes('administrative_area_level_1')) {
                        Livewire.emit('mailupdateState', component.short_name); // State
                    }
                    if (types.includes('postal_code')) {
                        Livewire.emit('mailupdateZipCode', component.long_name); // Zip Code
                    }
                });
                if (place.geometry && place.geometry.location) {
                    const lat = place.geometry.location.lat();
                    const lng = place.geometry.location.lng();
                    console.log('Latitude:', lat, 'Longitude:', lng);

                    // Emit the latitude and longitude to Livewire
                    Livewire.emit('mailupdateLatLng', { lat, lng });
                }
            });
        }
        console.log('1111');
    }

</script>
@endpush
