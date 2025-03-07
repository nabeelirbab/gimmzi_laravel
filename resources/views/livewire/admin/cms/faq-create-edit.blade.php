<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
                    <x-admin.form-group>
                        <x-admin.lable value="Question" required />
                        <x-admin.input type="text" wire:model.defer="question" placeholder="Enter Question"  class="{{ $errors->has('question') ? 'is-invalid' :'' }}" />
                        <x-admin.input-error for="question" />
                    </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Status" required/>
                        <x-admin.dropdown  wire:model.defer="status" placeHolderText="Please select one" autocomplete="off" class="{{ $errors->has('status') ? 'is-invalid' :'' }}">
                                @foreach ($statusList as $status)
                                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
                                @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="status" />
                    </x-admin.form-group>
                    <x-admin.form-group class="col-lg-12" wire:ignore>
                        <x-admin.lable value="Answer" required/>
                            <textarea x-data x-init="editor = CKEDITOR.replace('answer');
                                editor.on('change', function(event){
                                @this.set('answer', event.editor.getData());
                                })" wire:model.defer="answer" id="answer"
                                class="form-control {{ $errors->has('answer') ? 'is-invalid' :'' }}"></textarea>
                        </x-admin.form-group>
                        <div class="col-lg-12">
                            <x-admin.input-error for="answer" />   
                        </div>
                    
                    </div>
                    <br/>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('cms.faq.list')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>
