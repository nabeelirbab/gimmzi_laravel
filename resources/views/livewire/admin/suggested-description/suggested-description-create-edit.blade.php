<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form"> 
                     
                    <x-admin.form-group class="col-lg-12" >
                        <x-admin.lable value="Description" />
                        <textarea
                       wire:model.defer="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' :'' }}"></textarea>
                       <x-admin.input-error for="description" />
                        </x-admin.form-group>
                      
                        <x-admin.form-group>
                            <x-admin.lable value="Business Category" />
                            <x-admin.dropdown  wire:model.defer="business_id" placeHolderText="Please select one" autocomplete="off" class="{{ $errors->has('business_id') ? 'is-invalid' :'' }}">
                                <x-admin.dropdown-item :value="$blankArr['value']" :text="$blankArr['text']" />
                                    @foreach ($categoryList as $category_name)
            
                                     <x-admin.dropdown-item :value="$category_name->id" :text="$category_name->category_name" />                          
                                    @endforeach
                            </x-admin.dropdown>
                            <x-admin.input-error for="business_id" />
                        </x-admin.form-group>
                    <x-admin.form-group>
                        <x-admin.lable value="Status" />
                        <x-admin.dropdown  wire:model.defer="status" placeHolderText="Please select one" autocomplete="off" class="{{ $errors->has('status') ? 'is-invalid' :'' }}">
                                @foreach ($statusList as $status)
                                    <x-admin.dropdown-item  :value="$status['value']" :text="$status['text']"/>                          
                                @endforeach
                        </x-admin.dropdown>
                        <x-admin.input-error for="status" />
                    </x-admin.form-group>
                    </div>
                    <br/>
    </x-slot>
    <x-slot name="actions">
        <x-admin.button type="submit" color="success" wire:loading.attr="disabled">Save</x-admin.button>
        <x-admin.link :href="route('suggested-description.index')" color="secondary">Cancel</x-admin.link>
    </x-slot>
</x-form-section>
