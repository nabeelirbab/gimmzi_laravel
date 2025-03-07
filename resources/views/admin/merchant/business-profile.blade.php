<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Merchant Business">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('merchants.index') }}" value="Merchant User List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('merchants.business',$business->merchant_id) }}" value="Merchant Business Detail" />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
                 
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    
    <div class="kt-portlet kt-portlet--mobile">
        <form>
        <div class="kt-portlet__body">
            <div class="row">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Business Profile</h3>
                    </div>
                </div>
            </div>
            <hr>
            </br>
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Name</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->business_name}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Category</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->category->category_name}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Type of Service</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->type_of_service}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Page</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->business_page_link}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Street Address</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->street_address}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>City</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->city}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>State</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->state}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Zip Code</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->zip_code}}">
                </div>
                <div class="form-group col-lg-6">
                    <label>Number of Location</label>
                    <input type="text" class="form-control border-gray-200" readonly value="{{$business->number_of_location}}">
                </div>

            </div>
            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>
