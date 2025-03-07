<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <div class="form-group col-lg-12">
            <h3 style="font-size: 19px;color: #35a9e0;">#Business Detail</h3>
            <hr>
        </div>

        <x-admin.form-group>
            <x-admin.lable value="Merchant Business" required />
            <x-admin.dropdown wire:model.defer="business_id" id="businessid" placeHolderText="Please select one"
                autocomplete="off" class="{{ $errors->has('business_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($businessList as $data)
                    <x-admin.dropdown-item :value="$data->id" :text="$data->business_name . '(' . $data->merchant_type . ' - ' . $data->businessId . ')'" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="business_id" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Location Type" /><span style="color: #fd397a;"> ( If you select any 'Plus' business
                then select 'Location Type' )</span>
            <x-admin.dropdown wire:model.defer="location_type" id="locationType" placeHolderText="Please select one"
                autocomplete="off" class="{{ $errors->has('location_type') ? 'is-invalid' : '' }}">
                @foreach ($typeList as $data)
                    <x-admin.dropdown-item :value="$data['value']" :text="$data['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="location_type" />
        </x-admin.form-group>
        @if (!$isEdit)

            <x-admin.form-group class="col-lg-12">
                <div id="singletype" wire:ignore style="display:none;">
                    <x-admin.lable value="Select Single Location" /><span style="color: #fd397a;"> ( If you select
                        'Single' location type then select 'Single Location' )</span>
                    <x-admin.dropdown wire:model.defer="location" id="locationid" placeHolderText="Please select one"
                        autocomplete="off" class="{{ $errors->has('location') ? 'is-invalid' : '' }}" wire:ignore>

                    </x-admin.dropdown>
                </div>
                @if ($errors->has('location') == true)
                    <div class="invalid-feedback loc">The Single Location field is required</div>
                @else
                    <div class="invalid-feedback"></div>
                @endif
            </x-admin.form-group>

            <x-admin.form-group class="col-lg-12">
                <div id="multipletype" wire:ignore style="display:none;">
                    <x-admin.lable value="Select Multiple Location" /><span style="color: #fd397a;"> ( If you select
                        'Multiple' location type then select 'Multiple Location' )</span><br>
                    <span style="color: #0a5900;">For multi-select press, ctrl+click</span>
                    <x-admin.dropdown wire:model.defer="locations" id="locationids" placeHolderText="Please select one"
                        autocomplete="off" class="{{ $errors->has('locations') ? 'is-invalid' : '' }}" multiple
                        wire:ignore>
                    </x-admin.dropdown>
                </div>
                @if ($errors->has('locations') == true)
                    <div class="invalid-feedback loc">The Multiple Location field is required</div>
                @else
                    <div class="invalid-feedback"></div>
                @endif

            </x-admin.form-group>
            <x-admin.form-group class="col-lg-12">
                <div id="mainlocation" wire:ignore style="display:none;" >
                    <x-admin.lable value="Select Main Location" required />
                    <x-admin.dropdown wire:model.defer="mainlocation" id="mainlocationid"
                        placeHolderText="Please select one" class="{{ $errors->has('mainlocation') ? 'is-invalid' : '' }}">
                        <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                        {{-- @foreach ($locationList as $data)
                                                <x-admin.dropdown-item :value="$data->id" :text="$data->location_name"/>
                                            @endforeach --}}
                    </x-admin.dropdown>
                </div>
                <x-admin.input-error for="mainlocation" />
            </x-admin.form-group>
        @else
            @if ($merchant->location_type == 'single')
                <x-admin.form-group class="col-lg-12">
                    <div id="singletype" wire:ignore style="display:block;">
                        <x-admin.lable value="Select Single Location" /><span style="color: #fd397a;"> (If you select
                            'Single' location type then select 'Single Location' )</span>
                        <x-admin.dropdown wire:model.defer="location" id="locationid"
                            placeHolderText="Please select one"
                            class="{{ $errors->has('location') ? 'is-invalid' : '' }}">
                            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                            @foreach ($locationList as $data)
                                <x-admin.dropdown-item :value="$data->id" :text="$data->location_name" />
                            @endforeach
                        </x-admin.dropdown>
                    </div>
                    @if ($errors->has('location') == true)
                        <div class="invalid-feedback loc">The Single Location field is required</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @endif
                </x-admin.form-group>
                <x-admin.form-group class="col-lg-12">
                    <div id="mainlocation" wire:ignore style="display:block;" >
                        <x-admin.lable value="Select Main Location" required />
                        <x-admin.dropdown wire:model.defer="mainlocation" id="mainlocationid"
                            placeHolderText="Please select one" class="{{ $errors->has('mainlocation') ? 'is-invalid' : '' }}">
                                    <option value="{{ $singleLocation->id }}"{{$singleLocation->is_main == 1 ? 'selected' : ''}}>{{ $singleLocation->businessLocation->location_name }}</option>
                        </x-admin.dropdown>
                    </div>
                    <x-admin.input-error for="mainlocation" />
                </x-admin.form-group>
            @else
                <x-admin.form-group class="col-lg-12">
                    <div id="singletype" wire:ignore style="display:none;">
                        <x-admin.lable value="Select Single Location" /><span style="color: #fd397a;"> (If you select
                            'Single' location type then select 'Single Location' ) </span>
                        <x-admin.dropdown wire:model.defer="location" id="locationid"
                            placeHolderText="Please select one"
                            class="{{ $errors->has('location') ? 'is-invalid' : '' }}">
                            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                            @foreach ($locationList as $data)
                                <x-admin.dropdown-item :value="$data->id" :text="$data->location_name" />
                            @endforeach
                        </x-admin.dropdown>
                    </div>
                    @if ($errors->has('location') == true)
                        <div class="invalid-feedback loc">The Single Location field is required</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @endif
                </x-admin.form-group>
            @endif
            @if ($merchant->location_type == 'multiple')
                <x-admin.form-group class="col-lg-12">
                    <div id="multipletype" wire:ignore style="display:block;">
                        <x-admin.lable value="Select Multiple Location" /><span style="color: #fd397a;"> (If you select
                            'Multiple' location type then select 'Multiple Location' ) </span><br>
                        <span style="color: #0a5900;">For multi-select press, ctrl+click</span>
                        <x-admin.dropdown wire:model.defer="locations" id="edit_locationids"
                            placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('locations') ? 'is-invalid' : '' }}"  multiple>
                            @if (!empty($locations))
                                @foreach ($locationList as $data)
                                    <option value="{{ $data->id }}"
                                        {{ isset($locations) && in_array($data->id, $locations) ? 'selected' : '' }}>
                                        {{ $data->location_name }}</option>
                                @endforeach
                            @endif
                        </x-admin.dropdown>
                    </div>
                    @if ($errors->has('locations') == true)
                        <div class="invalid-feedback loc">The Multiple Location field is required</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @endif
                </x-admin.form-group>
                <x-admin.form-group class="col-lg-12">
                    <div id="mainlocation" wire:ignore style="display:block;" >
                        <x-admin.lable value="Select Main Location" required />
                        <x-admin.dropdown wire:model.defer="mainlocation" id="mainlocationid"
                            placeHolderText="Please select one" class="{{ $errors->has('mainlocation') ? 'is-invalid' : '' }}">
                           @if (!empty($locations))
                                @foreach ($multipleLocationList as $maindata)
                                    <option value="{{ $maindata->location_id }}"{{$maindata->is_main == 1 ? 'selected' : ''}}>{{ $maindata->businessLocation->location_name }}</option>
                                @endforeach
                            @endif 
                            
                        </x-admin.dropdown>
                    </div>
                    <x-admin.input-error for="mainlocation" />
                </x-admin.form-group>
            @else
                <x-admin.form-group class="col-lg-12">
                    <div id="multipletype" wire:ignore style="display:none;">
                        <x-admin.lable value="Select Multiple Location" /><span style="color: #fd397a;"> (If you select
                            'Multiple' location type then select 'Multiple Location') </span><br>
                        <span style="color: #0a5900;">For multi-select press, ctrl+click</span>
                        <x-admin.dropdown wire:model.defer="locations" id="locationids"
                            placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('locations') ? 'is-invalid' : '' }}" multiple>
                            @if (!empty($locations))
                                @foreach ($locationList as $data)
                                    <option value="{{ $data->id }}"
                                        {{ isset($locations) && in_array($data->id, $locations) ? 'selected' : '' }}>
                                        {{ $data->location_name }}</option>
                                @endforeach
                            @endif
                        </x-admin.dropdown>
                    </div>
                    @if ($errors->has('locations') == true)
                        <div class="invalid-feedback loc">The Multiple Location field is required</div>
                    @else
                        <div class="invalid-feedback"></div>
                    @endif
                </x-admin.form-group>
            @endif
        @endif
        <div class="form-group col-lg-12">
            <h3 style="font-size: 19px;color: #35a9e0;">#User Detail</h3>
            <hr>
        </div>
        <x-admin.form-group>
            <x-admin.lable value="Title" required />
            <x-admin.dropdown wire:model.defer="title_id" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('title_id') ? 'is-invalid' : '' }}">
                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                @foreach ($titleList as $data)
                    <x-admin.dropdown-item :value="$data->id" :text="$data->title_name" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="title_id" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="First Name" required />
            <x-admin.input type="text" wire:model.defer="first_name" placeholder="First Name"
                class="{{ $errors->has('first_name') ? 'is-invalid' : '' }}"  id="f_name"/>
            <x-admin.input-error for="first_name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Last Name" required />
            <x-admin.input type="text" wire:model.defer="last_name" placeholder="Last Name"
                class="{{ $errors->has('last_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="last_name" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Email" required />
            <x-admin.input type="text" wire:model.defer="email" placeholder="Email" autocomplete="off"
                class="{{ $errors->has('email') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="email" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Phone" required />
            <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone"
                onkeypress="return isNumber(event);" autocomplete="off"
                class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="phone" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Phone Ext" />
            <x-admin.input type="text" wire:model.defer="phone_ext" placeholder="Phone Ext"
                onkeypress="return isNumberPlus(event);" autocomplete="off"
                class="{{ $errors->has('phone_ext') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="phone_ext" />
        </x-admin.form-group>
        @if (!$isEdit)
            <x-admin.form-group>
                <x-admin.lable value="Password" required />
                <x-admin.input type="password" wire:model.defer="password" placeholder="Password" autocomplete="off"
                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="password" />
            </x-admin.form-group>
            <x-admin.form-group>
                <x-admin.lable value="Confirm Password" required />
                <x-admin.input type="password" wire:model.defer="password_confirmation"
                    placeholder="Reenter Password" autocomplete="off"
                    class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="password_confirmation" />
            </x-admin.form-group>
        @endif

        {{-- @if($this->showpassfield)
            <x-admin.form-group style="display:none;">
                <a class="btn btn-info" style="color: white;" wire:click='showpasswordfield'>Change Password</a>
                <br/>
            </x-admin.form-group>
        @else
            <x-admin.form-group>
                <a class="btn btn-info" style="color: white;" wire:click='showpasswordfield'>Change Password</a>
                <br/>
            </x-admin.form-group>
        @endif --}}
        @if(!$isEdit)       
            <x-admin.form-group style="display:none;">
                <a class="btn btn-info" style="color: white;" wire:click='showpasswordfield'>Change Password</a>
                <br/>
            </x-admin.form-group>  
        @else
        @if($this->showpassfield)
            <x-admin.form-group style="display:none;">
                <a class="btn btn-info" style="color: white;" wire:click='showpasswordfield'>Change Password</a>
                <br/>
            </x-admin.form-group>
            <x-admin.form-group >
                <a class="btn btn-info" style="background-color: rgb(248, 183, 183); color:rgb(245, 8, 8)" wire:click='hidepasswordfield'>Cancel Password Change</a>
                <br/>
            </x-admin.form-group>
        @else
            <x-admin.form-group >
                <a class="btn btn-info" style="color: white;" wire:click='showpasswordfield'>Change Password</a>
                <br/>
            </x-admin.form-group>
        @endif
        @endif
       
        @if($this->showpassfield)
        <x-admin.form-group>
            <x-admin.lable value="Password"  required />
            <x-admin.input type="password" wire:model.defer="password" readonly="" onfocus="this.removeAttribute('readonly');" placeholder="Password" autocomplete="off" class="{{ $errors->has('password') ? 'is-invalid' :'' }}"/>
            <x-admin.input-error for="password" />
        </x-admin.form-group>
        <x-admin.form-group>
            <x-admin.lable value="Confirm Password"  required />
            <x-admin.input type="password" wire:model.defer="password_confirmation" readonly="" onfocus="this.removeAttribute('readonly');" placeholder="Confirm Password" autocomplete="off" class="{{ $errors->has('password_confirmation') ? 'is-invalid' :'' }}"/>
            <x-admin.input-error for="password_confirmation" />
        </x-admin.form-group>
        @endif


        <x-admin.form-group>
            <x-admin.lable value="Status" />
            <x-admin.dropdown wire:model.defer="active" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('active') ? 'is-invalid' : '' }}">
                @foreach ($statusList as $status)
                    <x-admin.dropdown-item :value="$status['value']" :text="$status['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="active" required />
        </x-admin.form-group>

        <x-admin.form-group>
            @if ($isEdit)
                <x-admin.lable value="Profile Image" />
            @else
                <x-admin.lable value="Profile Image" />
            @endif
            @if ($model_image)
                <img src="{{ $model_image->getUrl() }}" style="width: 100px; height:100px;" /><br />
            @endif
            <x-admin.filepond wire:model="photo" class="{{ $errors->has('photo') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb" />
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="photo" />
            </div>
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Gimmzi Id" required />
            <x-admin.input type="text" wire:model.defer="userId" placeholder="Gimmzi Id"
                class="{{ $errors->has('userId') ? 'is-invalid' : '' }}"  disabled/>
            <x-admin.input-error for="userId" />
            <br>

            <a href="javascript:void(0)" class="btn btn-info" style="color: white;" id="generatenewid">Create Gimmzi Id</a>
            <br/>
        </x-admin.form-group>

        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('merchants.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>

    @push('scripts')
        <script>
            function isNumber(evt) {
                console.log(evt);
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

                return true;
            }

            function isNumberPlus(evt) {
                console.log(evt);
                var charCode = (evt.which) ? evt.which : event.keyCode
                if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;
                return true;
            }


            $(document).ready(function() {
                
                
                $("#businessid").on('change', function() {
                    // $("#locationType").prop('disabled',true);
                    $("#locationType").val(0);
                    $("#locationid").html('');
                    $("#locationids").html('');
                    var businessid = $(this).val();
                    $.ajax({
                        url: '{{ route('get.merchenttype') }}',
                        type: 'get',
                        data: {
                            'businessid': businessid
                        },
                        success: function(result) {
                            if (result.success == 1) {
                                // $("#locationType").prop('disabled',false);
                                // $.each(result.data, function(id, value) {
                                //         $("#locationid").append('<option value="'+value.id+'">'+value.location_name+'('+value.locationId+')</option>');
                                // });

                            } else if (result.success == 2) {
                                // $("#locationType").prop('disabled',false);
                                $('#locationid').html('No locations for this business...');

                            } else {
                                // $("#locationType").prop('disabled',true);
                                $('#locationid').html('No locations for this business...');
                            }

                        }
                    });
                });
                $("#locationType").on('change', function() {
                    $("#locationid").html('');
                    $("#locationids").html('');
                    $(".loc").html('');
                    var type = $(this).val();
                    var businessid = $("#businessid").val();
                    $.ajax({
                        url: "{{ route('get.location') }}",
                        type: 'get',
                        data: {
                            'businessid': businessid
                        },
                        success: function(result) {
                            if (result.success == 1) {

                                if (type == 'single') {
                                    $("#multipletype").hide();
                                    $("#mainlocationid").html('');
                                    $("#singletype").show();
                                    $("#mainlocation").show();
                                    $("#locationid").append(
                                        '<option value="">--select one--</option>');
                                    $.each(result.data, function(id, value) {
                                        $("#locationid").append('<option value="' + value
                                            .id + '">' + value.location_name + '(' +
                                            value.locationId + ')</option>');
                                    });
                                } else if (type == 'multiple') {
                                    $("#singletype").hide();
                                    $("#mainlocationid").html('');
                                    $("#multipletype").show();
                                    $("#mainlocation").show();
                                    $.each(result.data, function(id, value) {
                                        $("#locationid").html('');
                                        $("#locationids").append('<option value="' + value
                                            .id + '">' + value.location_name + '(' +
                                            value.locationId + ')</option>');

                                    });

                                } else {
                                    $("#singletype").hide();
                                    $("#multipletype").hide();
                                }

                            } else {
                                $('#locationid').html('No locations for this business...');
                            }

                        }
                    });

                    $('#locationids').on('change', function() {
                        var data = $('#locationids').val();  
                        //console.log(data);
                        $.ajax({
                            url: "{{ route('get.multiple.main.location') }}",
                            type: 'get',
                            data: {
                                'data': data
                            },
                            success: function(result) {
                                if (result.success == 1) {
                                    $("#mainlocationid").html('');
                                    if (result.data.length > 0) {
                                        for (var i = 0; i < result.data.length; i++) {
                                            var maindata = '<option value="' + result.data[i].id + '">' + result.data[i].location_name +'</option>';
                                            $("#mainlocationid").append(maindata);
                                            @this.set('mainlocation', result.data[i].id);
                                        }
                                    }
                                }
                            }
                        });
                    });

                    $('#edit_locationids').on('change',function(){
                        var data = $('#edit_locationids').val();  
                        console.log(data);
                        $.ajax({
                            url: "{{ route('get.multiple.main.location') }}",
                            type: 'get',
                            data: {
                                'data': data
                            },
                            success: function(result) {
                                if (result.success == 1) {
                                    $("#mainlocationid").html('');
                                    if (result.data.length > 0) {
                                        for (var i = 0; i < result.data.length; i++) {
                                            var maindata = '<option value="' + result.data[i].id + '">' + result.data[i].location_name +'</option>';
                                            $("#mainlocationid").append(maindata);
                                            
                                        }
                                    }
                                }
                            }
                        });
                    })

                    $(document).on('change', '#locationid', function() {
                        var data = $('#locationid').val(); 
                        $.ajax({
                            url: "{{ route('get.single.main.location') }}",
                            type: 'get',
                            data: {
                                'data': data
                            },
                            success: function(result) {
                                if (result.success == 1) {
                                    $("#mainlocationid").html('');
                                    var maindata = '<option value="' + result.data.id + '">' + result.data.location_name +'</option>';
                                    $("#mainlocationid").append(maindata);
                                    @this.set('mainlocation', result.data.id);  
                                
                                }
                            }
                        });
                    });

                });

                $('input[type="checkbox"]').on('change', function() {

                    if ($("#locationType").val() == 'single') {
                        $('input[name="' + this.name + '"]').not(this).prop('checked', false);
                    }

                });

            });

            $(document).on('click', '#generatenewid', function(){
                var fName = $("#f_name").val();
                mystring = fName.substring(0, 3);
                var length = 4;
                var mynumber = Math.floor(Math.pow(10, length-1) + Math.random() * (Math.pow(10, length) - Math.pow(10, length-1) - 1));
                var gimmziId = mynumber + mystring;
                Livewire.emit('updateGimmziId', gimmziId);
                // $("#userId").val(mynumber+mystring);
                console.log(mynumber+mystring);

            });
        </script>
    @endpush
    </x-form-section>
