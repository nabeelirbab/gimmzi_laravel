<x-admin.form-section submit="saveOrUpdate">
    @push('style')
    <style>
        .select2-container{
            width:100%!important;
        }
    </style>
    @endpush
    <x-slot name="form">
        
                    <x-admin.form-group class="col-lg-6">
                        <x-admin.lable value="Title" required />
                        <x-admin.dropdown wire:model.defer="title_id" placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('title_id') ? 'is-invalid' : '' }}" >
                            <x-admin.dropdown-item  :value="$blankArr['value']" :text="$blankArr['text']"/> 
                            @foreach ($titleList as $data)
                                <x-admin.dropdown-item :value="$data->id" :text="$data->title_name" />
                            @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="title_id" />
                    </x-admin.form-group>
                  
                    <x-admin.form-group class="col-lg-6">
                        <x-admin.lable value="Type" required />
                        <x-admin.dropdown wire:model.defer="travel_type" placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('travel_type') ? 'is-invalid' : '' }}" wire:change="changeType" >
                          
                            @foreach ($typeList as $data)
                                <x-admin.dropdown-item :value="$data['value']" :text="$data['text']" />
                            @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="travel_type" />
                    </x-admin.form-group>

                    <x-admin.form-group class="col-lg-12">
                        <x-admin.lable value="Select Short Term Rental / Hotel" required />
                        <x-admin.dropdown wire:model.defer="travel_tourism_id" placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('travel_tourism_id') ? 'is-invalid' : '' }}" >
                            <x-admin.dropdown-item  :value="$blankArr['value']" :text="$blankArr['text']"/> 
                            @foreach ($providerArr as $data)
                                <x-admin.dropdown-item :value="$data->id" :text="$data->name" />
                            @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="travel_tourism_id" />
                    </x-admin.form-group>

                    <x-admin.form-group>
                        <x-admin.lable value="First Name" required />
                        <x-admin.input type="text" wire:model.defer="first_name" placeholder="First Name"  class="{{ $errors->has('first_name') ? 'is-invalid' :'' }}" />
                        <x-admin.input-error for="first_name" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Last Name"  required />
                        <x-admin.input type="text" wire:model.defer="last_name" placeholder="Last Name"  class="{{ $errors->has('last_name') ? 'is-invalid' :'' }}" />
                        <x-admin.input-error for="last_name" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Email" required />
                        <x-admin.input type="text" wire:model.defer="email" placeholder="Email" autocomplete="off" class="{{ $errors->has('email') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="email" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Phone" />
                        <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone" onkeypress="return isNumber(event);" autocomplete="off" class="{{ $errors->has('phone') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="phone" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Phone Ext" />
                        <x-admin.input type="text" readonly onfocus="this.removeAttribute('readonly');" wire:model.defer="phone_ext" placeholder="Phone Ext" onkeypress="return isNumberPlus(event);" autocomplete="off" class="{{ $errors->has('phone_ext') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="phone" />
                    </x-admin.form-group>
                    @if(!$isEdit)
                    <x-admin.form-group>
                        <x-admin.lable value="Password"  required />
                        <x-admin.input type="password" readonly onfocus="this.removeAttribute('readonly');" wire:model.defer="password" placeholder="Password" autocomplete="off" class="{{ $errors->has('password') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Confirm Password"  required />
                        <x-admin.input type="password" readonly onfocus="this.removeAttribute('readonly');" wire:model.defer="password_confirmation" placeholder="Reenter Password" autocomplete="off" class="{{ $errors->has('password_confirmation') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password_confirmation" />
                    </x-admin.form-group>
                    
                    @endif

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
                        <x-admin.lable value="Status" required/>
                        <x-admin.dropdown  wire:model.defer="active" placeHolderText="Please select one" autocomplete="off" class="{{ $errors->has('active') ? 'is-invalid' :'' }}">
                                @foreach ($statusList as $status)
                                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
                                @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="active" />
                    </x-admin.form-group>
                   
                
                    <x-admin.form-group >
                        @if($isEdit)
                        <x-admin.lable value="Profile Image" />
                        @else
                        <x-admin.lable value="Profile Image" />
                        @endif
                        @if($model_image)
                            <img src="{{ $model_image->getUrl() }}" style="width: 100px; height:100px;" /><br/>
                        @endif
                        <x-admin.filepond wire:model="photo" class="{{ $errors->has('photo') ? 'is-invalid' :'' }}"
                            allowImagePreview
                            imagePreviewMaxHeight="50"
                            allowFileTypeValidation
                            acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']"
                            allowFileSizeValidation
                            maxFileSize="4mb"/>
                        <div class="col-lg-6 er-msg">
                            <x-admin.input-error for="photo" />
                        </div>
                    </x-admin.form-group>

                    </div>
                    <br/>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('admin.travel_tourism.userlist')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    @push('scripts')
<script>
    function isNumber(evt)
    {
        console.log(evt);
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }

    $('#multi').select2();
    $('#multi').on('change', function (e) {
        let data = $(this).val();
            @this.set('provider_ids', data);
    });
   

 
        $("#selecttitle").on('change',function() {
            var titleid = $(this).val();
            var edit = "<?php echo $isEdit;?>";
          
            if(edit == ''){
                if(titleid != ''){
                    if((titleid == 3) || (titleid == 4)){
                        console.log(titleid);
                        $("#singleprovider").hide();
                        $("#mutipleprovider").show();

                    }
                    else{
                        $("#mutipleprovider").hide();
                        $("#singleprovider").show();
                    // $("#multivalue").val('');
                    }
                 
                }
            }
            else{
                if(titleid != ''){
                    var multiple = $("#oldeditmutipleprovider");
                    var single = $("#oldeditsingleprovider");
                    console.log(titleid);
                    if((titleid == 3) || (titleid == 4)){
                           
                        $(multiple).css('display','block');
                        $(single).css('display','none');
                        
                    }
                    else{
                         $(multiple).css('display','none');
                         $(single).css('display','block');
                         let data = '';
                        @this.set('provider_id', data);
                        
                    // $("#multivalue").val('');
                    }
                 
                }
            }
            
            
        
        });
    </script>
    <script>
        function isNumberPlus(evt)
        {
            console.log(evt);
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode != 43 && charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>

        

    @endpush
</x-form-section>


