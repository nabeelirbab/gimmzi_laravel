<x-admin-layout title="Deal Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Deal Detail">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('deals.index') }}" value="Deal List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('deals.show',$deal->id) }}" value="Deal Detail" />
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
                            <h3 class="kt-portlet__head-title" style="font-size:21px;"><strong>Business Detail</strong></h3>
                        </div>
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Name</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->business_name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Category</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->category->category_name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Type of Service</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->service->service_name}}" readonly>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Page</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->business_page_link}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Address</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->street_address}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>City</label>
                        <input type="text" class="form-control border-gray-200" value="{{$deal->businessProfile->city}}"
                            readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>State</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->states->name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Zip Code</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->zip_code}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-size:21px;"><strong>Deal Detail</strong></h3>
                        </div>
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Merchant Name</label>
                        <input type="text" class="form-control border-gray-200" value="{{$deal->merchant->full_name ?? 'N/A'}}" readonly>
                       
                    </div>
                    {{-- <div class="form-group col-lg-6">
                        <label>Deal Category Name</label>
                            <input type="text" class="form-control border-gray-200"
                            value="{{$deal->businessProfile->business_name}}" readonly>
                    </div> --}}
                    <div class="form-group col-lg-6">
                        <label>Suggested Description</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->suggested_description}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        @php
                            $date=date_create($deal->start_Date);
                            $date_start=date_format($date,'d-m-Y');
                        @endphp
                        <label>Start Date</label>
                        <input type="text" class="form-control border-gray-200" value="{{$date_start}}" readonly>
                    </div>

                    <div class="form-group col-lg-6">
                        @php
                        if($deal->end_Date){
                            $e_date=date_create($deal->end_Date);
                            $date_end=date_format($e_date,'d-m-Y');
                        }else{
                            $date_end = 'No End Date';
                        }
                            
                        @endphp
                        <label>End Date</label>
                        <input type="text" class="form-control border-gray-200" value="{{$date_end}}" readonly>
                    </div>
                    
                    {{-- <div class="form-group col-lg-6">
                        <label>Description</label>
                        <input type="text" class="form-control border-gray-200" value="{{$deal->description}}"
                            readonly>
                    </div> --}}
                    <div class="form-group col-lg-6">
                        <label>Sales Amount</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->sales_amount}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Type</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->discount_type}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Amount</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->discount_amount}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Point</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$deal->point}}" readonly>
                    </div>
                </div>
        </form>
    </div>
</x-admin-layout>