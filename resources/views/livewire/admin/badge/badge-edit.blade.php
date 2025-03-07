<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Title" required />
            <x-admin.input type="text" wire:model.defer="title" placeholder="Title"
                class="{{ $errors->has('title') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="title" />
        </x-admin.form-group>
         <x-admin.form-group>
            <x-admin.lable value="Badge Point"  />
            <x-admin.input type="text" wire:model.defer="badge_point" placeholder="Point" onkeypress="return isNumber(event);"
                class="{{ $errors->has('badge_point') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="badge_point" />
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
            <x-admin.lable value="Badge Type" required />
            <x-admin.dropdown wire:model.defer="badge_type" placeHolderText="Please select one" autocomplete="off"
                class="{{ $errors->has('badge_type') ? 'is-invalid' : '' }}">
                @foreach ($typeList as $type)
                <x-admin.dropdown-item :value="$type['value']" :text="$type['text']" />
                @endforeach
            </x-admin.dropdown>
            <x-admin.input-error for="badge_type" />
        </x-admin.form-group>
        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Description" required />
            <textarea wire:model.defer="description"
                class="form-control {{ $errors->has('description') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description" />
        </x-admin.form-group>

        <x-admin.form-group >
            {{-- @if($isEdit != null ) --}}
            <x-admin.lable value="Badge Image" />
            @if($model_image)
                <img src="{{ $model_image->getUrl() }}" style="width: 100px; height:100px;" /><br/>
            @endif
            <x-admin.filepond wire:model="badge_image" class="{{ $errors->has('badge_image') ? 'is-invalid' :'' }}"
                allowImagePreview
                imagePreviewMaxHeight="50"
                allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']"
                allowFileSizeValidation
                maxFileSize="4mb"/>
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="badge_image" />
            </div>
            {{-- @endif --}}
        </x-admin.form-group>

        @if($this->isEdit)
        @foreach($this->badge_boosts as $key=>$value)
        <?php $i = $key+1;?>
            <div class="form-group col-lg-12">
                <h3>#Boost{{$i}} Detail</h3>
                <hr>
            </div>
            <x-admin.form-group>
            <x-admin.lable value="Level Name" required />
            <x-admin.input type="text" wire:model.defer="boost_name.{{$key}}"   placeholder="Level Name"
                class="{{ $errors->has('boost_name.'.$key) ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="boost_name.{{$key}}" />
            </x-admin.form-group>

           <x-admin.form-group>
                <x-admin.lable value="Level Point" required />
                <x-admin.input type="text" wire:model.defer="point.{{$key}}" onkeypress="return isNumber(event);" placeholder="Level Point"
                    class="{{ $errors->has('point.'.$key) ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="point.{{$key}}" />
            </x-admin.form-group>

             <x-admin.form-group class="col-lg-12">
                <x-admin.lable value="Level Description" required />
                <textarea wire:model.defer="boost_description.{{$key}}"
                    class="form-control {{ $errors->has('boost_description.'.$key) ? 'is-invalid' :'' }}"></textarea>
                <x-admin.input-error for="boost_description.{{$key}}" />
            </x-admin.form-group>

            @if($i == 1)
                <x-admin.form-group >
                    {{-- @if($isEdit != null ) --}}
                    <x-admin.lable value="Image" />
                    @if($model_boostImage1)
                        <img src="{{ $model_boostImage1->getUrl() }}" style="width: 100px; height:100px;" /><br/>
                    @endif
                    <x-admin.filepond wire:model="boost_image.{{$key}}" class="{{ $errors->has('boost_image.'.$key) ? 'is-invalid' :'' }}"
                        allowImagePreview
                        imagePreviewMaxHeight="50"
                        allowFileTypeValidation
                        acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']"
                        allowFileSizeValidation
                        maxFileSize="4mb"/>
                    <div class="col-lg-6 er-msg">
                        <x-admin.input-error for="boost_image.{{$key}}" />
                    </div>
                    {{-- @endif --}}
                </x-admin.form-group>
            @elseif($i == 2)
                <x-admin.form-group >
                    {{-- @if($isEdit != null ) --}}
                    <x-admin.lable value="Image" />
                    @if($model_boostImage2)
                        <img src="{{ $model_boostImage2->getUrl() }}" style="width: 100px; height:100px;" /><br/>
                    @endif
                    <x-admin.filepond wire:model="boost_image.{{$key}}" class="{{ $errors->has('boost_image.'.$key) ? 'is-invalid' :'' }}"
                        allowImagePreview
                        imagePreviewMaxHeight="50"
                        allowFileTypeValidation
                        acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']"
                        allowFileSizeValidation
                        maxFileSize="4mb"/>
                    <div class="col-lg-6 er-msg">
                        <x-admin.input-error for="boost_image.{{$key}}" />
                    </div>
                    {{-- @endif --}}
                </x-admin.form-group>
            @elseif($i == 3)
                <x-admin.form-group >
                    {{-- @if($isEdit != null ) --}}
                    <x-admin.lable value="Image" />
                    @if($model_boostImage3)
                        <img src="{{ $model_boostImage3->getUrl() }}" style="width: 100px; height:100px;" /><br/>
                    @endif
                    <x-admin.filepond wire:model="boost_image.{{$key}}" class="{{ $errors->has('boost_image.'.$key) ? 'is-invalid' :'' }}"
                        allowImagePreview
                        imagePreviewMaxHeight="50"
                        allowFileTypeValidation
                        acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']"
                        allowFileSizeValidation
                        maxFileSize="4mb"/>
                    <div class="col-lg-6 er-msg">
                        <x-admin.input-error for="boost_image.{{$key}}" />
                    </div>
                    {{-- @endif --}}
                </x-admin.form-group>
            @endif

            <br />

        @endforeach

        @endif


        </div>
        <br />
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('badges.index')" color="secondary">Cancel</x-admin.link>
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
    </script>
    @endpush