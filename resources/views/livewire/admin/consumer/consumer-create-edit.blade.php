<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
       
        <x-admin.form-group>
            <x-admin.lable value="First Name" required />
            <x-admin.input type="text" wire:model.defer="first_name" placeholder="First Name"
                class="{{ $errors->has('first_name') ? 'is-invalid' : '' }}" />
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
            <x-admin.lable value="Phone"  />
            <x-admin.input type="text" wire:model.defer="phone" placeholder="Phone" onkeypress="return isNumber(event);"
                autocomplete="off" class="{{ $errors->has('phone') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="phone" />
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
            <x-admin.input type="password" wire:model.defer="password_confirmation" placeholder="Reenter Password"
                autocomplete="off" class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="password_confirmation" />
        </x-admin.form-group>
        
        @endif
        {{-- @dd($showpassfield) --}}

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


        @if($isEdit)
            <x-admin.form-group>
                <x-admin.lable value="Join Date"  />
                <x-admin.input type="text" wire:model.defer="created" autocomplete="off" readonly
                    class="{{ $errors->has('created') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="created" />
            </x-admin.form-group>
        @else
            <x-admin.form-group>
                <x-admin.lable value="Join Date" required />
                <x-admin.input type="date" wire:model.defer="join_date" autocomplete="off"
                    class="{{ $errors->has('join_date') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="join_date" />
            </x-admin.form-group>
        @endif
        {{-- <x-admin.form-group>
            <x-admin.lable value="Date of Birth"  />
            <x-admin.input type="date" wire:model.defer="date_of_birth" autocomplete="off"
                class="{{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"/>
            <x-admin.input-error for="date_of_birth" />
        </x-admin.form-group> --}}

        {{-- <x-admin.form-group>
            <x-admin.lable value="Date of Birth" />
            <x-admin.input 
                type="date" 
                id="date_of_birth" 
                autocomplete="off"
                wire:model.defer="date_of_birth"
                class="{{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" 
                onchange="updateDateValue(this.value)" 
            />
            <x-admin.input-error for="date_of_birth" />
        </x-admin.form-group> --}}

        <x-admin.form-group>
            <x-admin.lable value="Date of Birth" />
            <x-admin.input 
                type="text" 
                id="date_of_birth" 
                autocomplete="off"
                wire:model.defer="date_of_birth"
                class="{{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" 
                placeholder="MM/DD/YYYY" 
            />
            <x-admin.input-error for="date_of_birth" />
        </x-admin.form-group>
       
        
        <x-admin.form-group>
            <x-admin.lable value="Status" required />
            <x-admin.dropdown wire:model.defer="active" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('active') ? 'is-invalid' : '' }}">
                @foreach ($statusList as $status)
                <x-admin.dropdown-item :value="$status['value']" :text="$status['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="active" />
        </x-admin.form-group>
        <x-admin.form-group>
            @if ($isEdit)
            <x-admin.lable value="Profile Image" />
            @else
            <x-admin.lable value="Profile Image" required />
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
        
        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('consumers.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
    </x-form-section>
    @push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<!-- Include jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- Include jQuery UI CSS -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script>
    function isNumber(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }


//     document.addEventListener("DOMContentLoaded", function() {
//     window.updateDateValue = function(value) {
//         const date = new Date(value);
//         if (!isNaN(date.getTime())) {
//             const month = String(date.getMonth() + 1).padStart(2, '0');
//             const day = String(date.getDate()).padStart(2, '0');
//             const year = date.getFullYear();
//             console.log(month);
//             console.log(day);
//             console.log(year);

//             const formattedValue = `${month}/${day}/${year}`;
//             console.log(formattedValue);
//             document.getElementById('date_of_birth').value = formattedValue;
//         }
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
        $('#date_of_birth').datepicker({
            dateFormat: 'mm/dd/yy', 
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:+0",
            maxDate: 0 
        }).on('change', function() {
            @this.set('date_of_birth', $(this).val());
        });
    });
    
    </script>
    @endpush