<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
       
        <x-admin.form-group>
            <x-admin.lable value="Select Business" required />
            <x-admin.dropdown wire:model.defer="business_profile_id" id="profile_id" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('business_profile_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($businessList as $data)
                <x-admin.dropdown-item :value="$data->id" :text="$data->business_name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="business_profile_id" />
            <span style="color:red;">{{$businessmessage}}</span>
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Location Type" required />
            <x-admin.dropdown wire:model.defer="location_type"  placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('location_type') ? 'is-invalid' : '' }}" wire:change="changeType($event.target.value)" >
                
                @foreach ($typeList as $list)
                <x-admin.dropdown-item :value="$list['value']" :text="$list['text']" />
                @endforeach
                </x-admin.dropdown>
            <x-admin.input-error for="location_type" />
            <span style="color:red;">{{$message}}</span>
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Location Name" required />
            <x-admin.input type="text" wire:model.defer="location_name" placeholder="Location Name"
                class="{{ $errors->has('location_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="location_name" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Business Phone Number" required />
            <x-admin.input type="text" wire:model.defer="business_phone" placeholder="Business Phone"
                class="{{ $errors->has('business_phone') ? 'is-invalid' : '' }}" onkeypress="return isNumber(event);"/>
            <x-admin.input-error for="business_phone" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Business Fax Number" />
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
            <x-admin.lable value="Address" required />
            <x-admin.input type="text" wire:model.defer="address" id="business_address" placeholder="Address" autocomplete="off"
                class="{{ $errors->has('address') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="address" />
        </x-admin.form-group>
        <input type="hidden" wire:model.defer="lat" id="business_lat" />

        <input type="hidden" wire:model.defer="long" id="business_long"/>
        <input type="hidden" wire:model.defer="state" id="business_state"/>


        <x-admin.form-group>
            <x-admin.lable value="Zip Code" required />
            <x-admin.input type="text" wire:model.defer="zip_code" placeholder="Zip Code" onkeypress="return isNumber(event);"
                autocomplete="off" class="{{ $errors->has('zip_code') ? 'is-invalid' : '' }}" id="zipCode" readonly/> 
            <x-admin.input-error for="zip_code" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="City" required />
            <x-admin.input type="text" wire:model.defer="city" placeholder="City" 
                autocomplete="off" class="{{ $errors->has('city') ? 'is-invalid' : '' }}" id="city" readonly/>
            <x-admin.input-error for="city" />
            <span id="ziperror"></span>
        </x-admin.form-group>
        
        {{-- <x-admin.form-group>
            <x-admin.lable value="State" required />
            <x-admin.dropdown wire:model.defer="state_id"  placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('state_id') ? 'is-invalid' : '' }}">
            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($stateList as $states)
                    <x-admin.dropdown-item :value="$states->id" :text="$states->name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="state_id" />
        </x-admin.form-group> --}}
       
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
                <x-admin.lable value="Business Photo" />
                <div class="d-flex flex-wrap  my-3">
                @foreach($model_image as $images)
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
        <x-admin.link :href="route('business-location.index')" color="secondary">Cancel</x-admin.link>
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

    $("#profile_id").on('change',function() {
        var profile_id = $(this).val();
        $.ajax({
                url: '{{ route('get.location.type') }}',
                type: 'get',
                data: {
                    'profile_id' : profile_id
                },
                success: function(result) {
                    console.log(result);
                   
                    if (result.success == 0){
                        $('#locationType').prop('disabled',true);
                    }
                    else if(result.success == 1){
                        //$('#locationType').val('Headquarters');
                        // $('#locationType').prop('disabled',true);
                        $("#locationType").html('');
                        $("#locationType").append('<option value="Headquarters" selected>Headquarters</option>');
                    }
                    else if(result.success == 1){
                        $('#locationType').val('');
                        $('#locationType').prop('disabled',false);
                    }
                    else{
                        //$('#locationType').val('');
                        $('#locationType').prop('disabled',false);
                    }

                }
            });

    })

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
                    //console.log(result);
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

    // $("#locationType").on('change',function() {
    //     var type = $(this).val();
    //     var profile_id = $("#profile_id").val();
    //     $.ajax({
    //             url: '{{ route('get.type.count') }}',
    //             type: 'get',
    //             data: {
    //                 'type' : type,
    //                 'profile_id' : profile_id
    //             },
    //             success: function(result) {
    //                 console.log(result);
    //                 if (result.success == 0){
    //                     $('#locationType').prop('disabled',true);
    //                 }
    //                 else if(result.success == 1){
    //                     $('#locationType').val('Headquarters');
    //                     $('#locationType').prop('disabled',true);
    //                 }
    //                 else{
    //                     $('#locationType').val('');
    //                     $('#locationType').prop('disabled',false);
    //                 }

    //             }
    //         });

    // })


    $("#business_address").on('keyup', function(){
                   
        var input = document.getElementById('business_address');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setComponentRestrictions({'country': ['us']});
        google.maps.event.addListener(autocomplete, 'place_changed', function(d) {
            var place = autocomplete.getPlace();
            console.log(place);
            
            $('#business_lat').val(place.geometry['location'].lat());
            $('#business_long').val(place.geometry['location'].lng());
            $('#business_address').val(place.formatted_address);
            @this.set('lat', place.geometry['location'].lat());
            @this.set('long', place.geometry['location'].lng());
            @this.set('address', place.formatted_address);
            for(var i = 0; i < place.address_components.length; i++){
                console.log(place.address_components[i]);
                for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "postal_code") {
                    
                        @this.set('zip_code', place.address_components[i].long_name);
                        $("#zipCode").val(place.address_components[i].long_name);
                    }
                    if (place.address_components[i].types[j] == "administrative_area_level_1") {
                        
                        $("#business_state").val(place.address_components[i].long_name);
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


    
    </script>
    @endpush