<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Category Name" required />
            <x-admin.input type="text" wire:model.defer="category_name" placeholder="Category Name"
                class="{{ $errors->has('category_name') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="category_name" />
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

        <x-admin.form-group class="col-lg-12" wire:ignore>
            <x-admin.lable value="Terms And Conditions" required />
            <textarea x-data x-init="editor = CKEDITOR.replace('terms_conditions');
            editor.on('change', function(event) {
                @this.set('terms_conditions', event.editor.getData());
            })" wire:model.defer="terms_conditions" id="terms_conditions"
                class="form-control {{ $errors->has('terms_conditions') ? 'is-invalid' : '' }}"></textarea>
        </x-admin.form-group>
        <div class="col-lg-12">
            <x-admin.input-error for="terms_conditions" />
        </div>

        <x-admin.form-group>
            @if ($isEdit)
                <x-admin.lable value="Category Icon" />
            @else
                <x-admin.lable value="Category Icon" />
            @endif
            @if ($model_image1)
                <img src="{{ $model_image1->getUrl() }}" style="width: 100px; height:100px;" /><br />
            @endif
            <x-admin.filepond wire:model="icon" class="{{ $errors->has('icon') ? 'is-invalid' : '' }}"
                allowImagePreview imagePreviewMaxHeight="50" allowFileTypeValidation
                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/*']" allowFileSizeValidation
                maxFileSize="4mb" />
            <div class="col-lg-6 er-msg">
                <x-admin.input-error for="icon" />
            </div>
        </x-admin.form-group>

        {{-- <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Terms And Conditions" required />
            <textarea wire:model.defer="terms_conditions"
                class="form-control {{ $errors->has('terms_conditions') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="terms_conditions" />
        </x-admin.form-group> --}}
        </div>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('business-category.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-admin.form-section>
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
