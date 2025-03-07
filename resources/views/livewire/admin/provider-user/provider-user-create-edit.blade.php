<x-admin.form-section submit="saveOrUpdate">
    @push('style')
    <style>
        .select2-container{
            width:100%!important;
        }
    </style>
    @endpush
    <x-slot name="form">
        
                    <x-admin.form-group class="col-lg-12">
                        <x-admin.lable value="Title" required />
                        <x-admin.dropdown wire:model.defer="title_id" placeHolderText="Please select one" autocomplete="off"
                            class="{{ $errors->has('title_id') ? 'is-invalid' : '' }}" id="selecttitle">
                            <x-admin.dropdown-item  :value="$blankArr['value']" :text="$blankArr['text']"/> 
                            @foreach ($titleList as $data)
                                <x-admin.dropdown-item :value="$data->id" :text="$data->title_name" />
                            @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="title_id" />
                    </x-admin.form-group>
                   @if(!$isEdit)
                    <x-admin.form-group class="col-lg-12">
                       <div id="singleprovider" wire:ignore style="display:block;">
                       <x-admin.lable value="Select Provider" required/>
                            <x-admin.dropdown  wire:model.defer="provider_id" placeHolderText="Please select one" id="provider" autocomplete="off" class="{{ $errors->has('provider_id') ? 'is-invalid' :'' }}">
                            <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                                @foreach ($providerList as $list)
                                    <x-admin.dropdown-item  :value="$list->id" :text="$list->name.'('.$list->providerId.')'"/>  
                                @endforeach
                            </x-admin.dropdown>
                       </div>
                        @if($errors->has('provider_id') == true)
                            <div class="invalid-feedback ">Please select one Provider</div>
                        @else
                            <div class="invalid-feedback"></div>
                        @endif
                    </x-admin.form-group>
                   
                    <x-admin.form-group class="col-lg-12">
                       <div  id="mutipleprovider" wire:ignore style="display:none;">
                            <x-admin.lable value="Select Multiple Provider" required/>
                            <x-admin.dropdown class="{{ $errors->has('provider_id') ? 'is-invalid' :'' }}" wire:model.defer="provider_ids" id="multi" multiple="multiple">
                                @foreach ($providerList as $list)
                                    <option value="{{$list->id}}" >{{$list->name}}({{$list->providerId}})</option>
                                @endforeach
                            </x-admin.dropdown>
                       </div>
                        @if($errors->has('provider_ids') == true)
                            <div class="invalid-feedback ">Please select atleast one Provider</div>
                        @else
                            <div class="invalid-feedback"></div>
                        @endif
                    </x-admin.form-group>
                    @else
                        @if(($provider_user->title_id == 3) || ($provider_user->title_id == 4))
                           
                            <x-admin.form-group class="col-lg-12">
                                <div id="oldeditmutipleprovider" wire:ignore  >
                                    <x-admin.lable value="Select Multiple Provider"  required/>
                                    <x-admin.dropdown  wire:model="provider_ids" placeHolderText="Please select one" id="multi" multiple="multiple"
                                    autocomplete="off" class="{{ $errors->has('provider_ids') ? 'is-invalid' :'' }}"  >
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}"{{ (isset($provider_ids) && in_array($list->id,$provider_ids))  ? 'selected' : '' }} >{{$list->name}}({{$list->providerId}})</option>
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                            
                                @if($errors->has('provider_ids') == true)
                                    <div class="invalid-feedback ">Please select atleast one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>
                            <x-admin.form-group class="col-lg-12">
                                <div id="oldeditsingleprovider" wire:ignore style = "display:none;">
                                    <x-admin.lable value="Select Provider" required/>
                                    <x-admin.dropdown  wire:model="provider_id" placeHolderText="Please select one" autocomplete="off" 
                                    class="{{ $errors->has('provider_id') ? 'is-invalid' :'' }}">
                                    <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}" <?php  if($provider_id == $list->id) {echo 'selected'; } ?> >{{$list->name}}({{$list->providerId}})</option>
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                                
                                @if($errors->has('provider_id') == true)
                                    <div class="invalid-feedback ">Please select one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>
                        @else

                           <x-admin.form-group class="col-lg-12">
                                <div id="oldeditmutipleprovider" wire:ignore style="display:none;" >
                                    <x-admin.lable value="Select Multiple Provider"  required/>
                                    <x-admin.dropdown  wire:model="provider_ids" placeHolderText="Please select one" id="multi" multiple="multiple"
                                    autocomplete="off" class="{{ $errors->has('provider_ids') ? 'is-invalid' :'' }}"  >
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}"{{ (isset($provider_ids) && in_array($list->id,$provider_ids))  ? 'selected' : '' }} >{{$list->name}}({{$list->providerId}})</option>
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                            
                                @if($errors->has('provider_ids') == true)
                                    <div class="invalid-feedback ">Please select atleast one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>
                            <x-admin.form-group class="col-lg-12">
                                <div id="oldeditsingleprovider" wire:ignore >
                                    <x-admin.lable value="Select Provider" required/>
                                    <x-admin.dropdown  wire:model="provider_id" placeHolderText="Please select one" autocomplete="off" 
                                    class="{{ $errors->has('provider_id') ? 'is-invalid' :'' }}">
                                    <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}" <?php  if($provider_id == $list->id) {echo 'selected'; } ?> >{{$list->name}}({{$list->providerId}})</option>
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                                
                                @if($errors->has('provider_id') == true)
                                    <div class="invalid-feedback ">Please select one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>

                        @endif
                        {{--@if(($title_id != 3) || ($title_id != 4))
                            <x-admin.form-group class="col-lg-12">
                                <div id="neweditsingleprovider" wire:ignore style="display:block;">
                                    <x-admin.lable value="Select Provider" required/>
                                    <x-admin.dropdown  wire:model.defer="provider_ids" placeHolderText="Please select one" autocomplete="off" class="{{ $errors->has('provider_ids') ? 'is-invalid' :'' }}">
                                    <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}" {{ (isset($provider_ids) && in_array($list->id,$provider_ids))  ? 'selected' : '' }} >{{$list->name}}({{$list->providerId}})</option>
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                                
                                @if($errors->has('provider_ids') == true)
                                    <div class="invalid-feedback ">Please select one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>
                        @else
                            <x-admin.form-group class="col-lg-12">
                                <div id="neweditmutipleprovider" wire:ignore  style="display:none;">
                                    <x-admin.lable value="Select Multiple Provider"  required/>
                                    <x-admin.dropdown  wire:model="provider_ids" placeHolderText="Please select one" id="multi" multiple="multiple"
                                    autocomplete="off" class="{{ $errors->has('provider_ids') ? 'is-invalid' :'' }}"  >
                                    
                                        @foreach ($providerList as $list)
                                        <option value="{{$list->id}}"{{ (isset($provider_ids) && in_array($list->id,$provider_ids))  ? 'selected' : '' }} >{{$list->name}}({{$list->providerId}})</option>
                                    
                                        @endforeach
                                    </x-admin.dropdown>
                                </div>
                            
                                @if($errors->has('provider_ids') == true)
                                    <div class="invalid-feedback ">Please select atleast one Provider</div>
                                @else
                                    <div class="invalid-feedback"></div>
                                @endif
                            </x-admin.form-group>
                        @endif--}}
                    @endif
                   
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
                        <x-admin.lable value="Phone Ext " />
                        <x-admin.input type="text" wire:model.defer="phone_ext" placeholder="Phone Ext" onkeypress="return isNumberPlus(event);" autocomplete="off" class="{{ $errors->has('phone_ext') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="phone" />
                    </x-admin.form-group>
                    @if(!$isEdit)
                    <x-admin.form-group>
                        <x-admin.lable value="Password"  required />
                        <x-admin.input type="password" wire:model.defer="password" placeholder="Password" autocomplete="off" class="{{ $errors->has('password') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Confirm Password"  required />
                        <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Reenter Password" autocomplete="off" class="{{ $errors->has('password_confirmation') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password_confirmation" />
                    </x-admin.form-group>
                    
                    @else
                    {{-- <x-admin.form-group>
                        <x-admin.lable value="Password"  />
                        <x-admin.input type="password" wire:model.defer="password" placeholder="Password" autocomplete="off" class="{{ $errors->has('password') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Confirm Password"  />
                        <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Reenter Password" autocomplete="off" class="{{ $errors->has('password_confirmation') ? 'is-invalid' :'' }}"/>
                        <x-admin.input-error for="password_confirmation" />
                    </x-admin.form-group> --}}
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
        <x-admin.link :href="route('provider-user.index')" color="secondary">Cancel</x-admin.link>
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


