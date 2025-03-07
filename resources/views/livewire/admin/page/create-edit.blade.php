<div>
    <x-admin.form-section submit="saveOrUpdate">
        <x-slot name="form">
            <x-admin.form-group class='col-lg-12'>
                <x-admin.lable value="Title" required />
                <x-admin.input type="text" wire:model.defer="title" placeholder="Title"
                    class="{{ $errors->has('title') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="title" />
            </x-admin.form-group>
            <x-admin.form-group>
                <x-admin.lable value="Sub Title" required />
                <x-admin.input type="text" wire:model.defer="subtitle" placeholder="Sub Title"
                    class="{{ $errors->has('subtitle') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="subtitle" />
            </x-admin.form-group>
            <x-admin.form-group class="col-lg-6">
                <label class="label-required">First Banner Video Link</label>
                <x-admin.input type="text" wire:model.defer="photo_one" placeholder="First Banner Video Link"
                class="{{ $errors->has('photo_one') ? 'is-invalid' : '' }}" />
                
                <x-admin.input-error for="photo_one" />
            </x-admin.form-group>

            <x-admin.form-group class="col-lg-6"><label class="label-required">Second Banner Video Link</label>
                
                <x-admin.input type="text" wire:model.defer="photo_two" placeholder="Second Banner Video Link"
                class="{{ $errors->has('photo_two') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="photo_two" />
            </x-admin.form-group>

            <x-admin.form-group class="col-lg-6">
                <label class="label-required">Third Banner Video Link</label>
                
                <x-admin.input type="text" wire:model.defer="photo_three" placeholder="Third Banner Video Link"
                class="{{ $errors->has('photo_three') ? 'is-invalid' : '' }}" />
                <x-admin.input-error for="photo_three" />
            </x-admin.form-group>

            <x-admin.form-group class="col-lg-12">
                <x-admin.lable value="Content" required />
                <div wire:ignore>
                    <textarea x-data x-init="editor = CKEDITOR.replace('content');
                    editor.on('change', function(event) {
                        @this.set('content', event.editor.getData());
                    })" wire:model.defer="content" id="content"
                        class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"></textarea>
                </div>
                <x-admin.input-error for="content" />
            </x-admin.form-group>

</div>
<br />
</x-slot>
<x-slot name="actions">
    <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
    <x-admin.link :href="route('admin.page-edit')" color="secondary">Cancel</x-admin.link>
</x-slot>
</x-form-section>

</div>
