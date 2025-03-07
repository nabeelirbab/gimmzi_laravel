<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Add Building Unit">
            <x-admin.breadcrumbs>
            <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('provider-unit.index') }}" value="Building Unit List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="Add Building Unit" />
            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
                 
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <div class="kt-portlet kt-portlet--mobile">
        {{ Form::open(['route' => ['provider-unit.store'], 'class' => 'kt-form parsley-validate', 'method' => 'POST','files'=>true]) }}
        <div class="kt-portlet__body">
        <div class="row" style="align-self: flex-end;margin-bottom: 11px;">
            <a href="{{asset('uploads/unit_data.csv')}}" target="_blank" class="btn btn-success">Sample csv</a>
        </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Upload File(.csv)<span style="color: red;">*</span></label>
                    <input type="file" name="unitfile" >
                    @if ($errors->has('unitfile'))
                        <div class="error" style="color:red;">{{ $errors->first('unitfile') }}</div>
                    @endif
                    
                </div>
            </div>
            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    <button type="submit" class="btn btn-success">Import</button>
                    <a href="{{ route('buildings.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
            <!--end::Form-->
        </div>

</x-admin-layout>
