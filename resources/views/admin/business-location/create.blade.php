<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Add Business Location">
            <x-admin.breadcrumbs>
            <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('business-location.index') }}" value="Business Location List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="Add Business Location" />
            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
                 
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <div class="kt-portlet kt-portlet--mobile">
        {{ Form::open(['route' => ['business-location.store'], 'class' => 'kt-form parsley-validate', 'method' => 'POST','files'=>true]) }}
        <div class="kt-portlet__body">
        <div class="row" style="align-self: flex-end;margin-bottom: 11px;">
            <a href="{{asset('uploads/locationdata.csv')}}" style="margin-right: 22px;"target="_blank" class="btn btn-success">Sample csv</a>
            <a href="{{asset('uploads/state_list.xls')}}" target="_blank" class="btn btn-success">State List</a>
        </div>
            <div class="row">
            <div class="form-group col-lg-12">
                <p style="color: red;"><i>Note:- All fields are required</i></p>
                <p style="color: green;"><span style="color:red;">merchant_id :- </span> <span>Id of business profile ( Like:- PHO/05 is the Business profile id)</span></p>
                <p style="color: green;"><span style="color:red;">location_name :- </span> location name ( Like:- location one)</p>
                <p style="color: green;"><span style="color:red;">address :- </span>Address of location ( Like:- 829 Emeral Dreams Drive)</p>
                <p style="color: green;"><span style="color:red;">city :- </span>City name ( Like:- Washington)</p>
                <p style="color: green;"><span style="color:red;">state :- </span>Please copy the State name from above 'State List' excel file ( Like:- Illinois)</p>
                <p style="color: green;"><span style="color:red;">zip_code :- </span>Zip Code ( Like:- 60504)</p>
                <p style="color: green;"><span style="color:red;">location_type :- </span>Headquarters or Non Headquarters ( Like:- Headquarters)</p>
                <p style="color: green;"><span style="color:red;">business_phone_number :- </span>Business phone number( Like:- 9878675645)</p>
                <p style="color: green;"><span style="color:red;">business_fax_number :- </span>Business Fax number( Like:- +44 161 999 8888)</p>
                <p style="color: green;"><span style="color:red;">business_email :- </span>Business Email( Like:- first@example.com)</p>

            </div>
                <div class="form-group col-lg-12">
                    <label>Upload File(.csv)<span style="color: red;">*</span></label>
                    <input type="file" name="locationfile" >
                    @if ($errors->has('locationfile'))
                        <div class="error" style="color:red;">{{ $errors->first('locationfile') }}</div>
                    @endif
                    
                </div>
            </div>
            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    <button type="submit" class="btn btn-success">Import</button>
                    <a href="{{ route('business-location.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
            <!--end::Form-->
        </div>

</x-admin-layout>
