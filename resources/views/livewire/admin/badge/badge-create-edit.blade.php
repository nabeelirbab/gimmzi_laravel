<x-admin.form-section submit="saveOrUpdate">
    <x-slot name="form">
        <x-admin.form-group>
            <x-admin.lable value="Title" required />
            <x-admin.input type="text" wire:model.defer="title" placeholder="Title"
                class="{{ $errors->has('title') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="title" />
        </x-admin.form-group>
        <!-- <x-admin.form-group>
            <x-admin.lable value="Point" required />
            <x-admin.input type="text" wire:model.defer="point" placeholder="Point" onkeypress="return isNumber(event);"
                class="{{ $errors->has('point') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="point" />
        </x-admin.form-group> -->

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
        <x-admin.form-group>
            <x-admin.lable value="Description" required />
            <textarea wire:model.defer="description"
                class="form-control {{ $errors->has('description') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description" />
        </x-admin.form-group>

       
        <div class="form-group col-lg-12">
            <h3>#Boost1 Detail</h3>
            <hr>
        </div>

        <br />
        
        <x-admin.form-group>
            <x-admin.lable value="Level Name" required />
            <x-admin.input type="text" wire:model.defer="name1" placeholder="Name"
                class="{{ $errors->has('name1') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="name1" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Level Point" required />
            <x-admin.input type="text" wire:model.defer="point1" onkeypress="return isNumber(event);" placeholder="Point"
                class="{{ $errors->has('point1') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="point1" />
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Level Description" required />
            <textarea wire:model.defer="description1"
                class="form-control {{ $errors->has('description1') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description1" />
        </x-admin.form-group>

        <div class="form-group col-lg-12">
            <h3>#Boost2 Detail</h3>
            <hr>
        </div>

        <br />
        <x-admin.form-group>
            <x-admin.lable value="Level Name" required />
            <x-admin.input type="text" wire:model.defer="name2" placeholder="Name"
                class="{{ $errors->has('name2') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="name2" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Level Point" required />
            <x-admin.input type="text" wire:model.defer="point2" onkeypress="return isNumber(event);" placeholder="Point"
                class="{{ $errors->has('point2') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="point2" />
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Level Description" required />
            <textarea wire:model.defer="description2"
                class="form-control {{ $errors->has('description2') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description2" />
        </x-admin.form-group>

        <div class="form-group col-lg-12">
            <h3>#Boost3 Detail</h3>
            <hr>
        </div>

        <br />
        <x-admin.form-group>
            <x-admin.lable value="Level Name" required />
            <x-admin.input type="text" wire:model.defer="name3" placeholder="Name"
                class="{{ $errors->has('name3') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="name3" />
        </x-admin.form-group>

        <x-admin.form-group>
            <x-admin.lable value="Level Point" required />
            <x-admin.input type="text" wire:model.defer="point3" onkeypress="return isNumber(event);" placeholder="Point"
                class="{{ $errors->has('point3') ? 'is-invalid' : '' }}" />
            <x-admin.input-error for="point3" />
        </x-admin.form-group>

        <x-admin.form-group class="col-lg-12">
            <x-admin.lable value="Level Description" required />
            <textarea wire:model.defer="description3"
                class="form-control {{ $errors->has('description3') ? 'is-invalid' :'' }}"></textarea>
            <x-admin.input-error for="description3" />
        </x-admin.form-group>
       


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