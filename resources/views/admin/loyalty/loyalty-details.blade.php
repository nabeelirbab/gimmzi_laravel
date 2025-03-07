<x-admin-layout title="Loyalty Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Loyalty Reward Program Deetails">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('loyaltys.index') }}" value="Loyalty Reward Program List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('loyaltys.show',$loyalty->id) }}" value="Loyalty Reward Program Detail" />
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
                            value="{{$loyalty->businessProfile->business_name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Category</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->category->category_name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Type of Service</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->service->service_name}}" readonly>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>Page</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->business_page_link}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Address</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->street_address}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>City</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->businessProfile->city}}"
                            readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>State</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->states->name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Zip Code</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$loyalty->businessProfile->zip_code}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title" style="font-size:21px;"><strong>Program Detail</strong></h3>
                        </div>
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Merchant Name</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->merchant->full_name}}" readonly>
                    </div>
                    
                    
                    <div class="form-group col-lg-6">
                        <label>Program Name</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->program_name}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Program Type</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->purchase_goal}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Start Date</label>
                        @php
                            $date=date_create($loyalty->start_on);
                            $date_start=date_format($date,'d-m-Y');
                        @endphp

                        <input type="text" class="form-control border-gray-200 start_datepicker" value= "{{$date_start}}"  readonly>
                    </div>

                    <div class="form-group col-lg-6">
                        <label>End Date</label>
                        @php
                        if($loyalty->end_on){
                            $e_date=date_create($loyalty->end_on);
                            $date_end=date_format($e_date,'d-m-Y');
                        }else{
                            $date_end = 'No End Date';
                        }
                            
                        @endphp
                        <input type="text" class="form-control border-gray-200 end_datepicker" value = "{{$date_end}}" readonly>
                    </div>
                    @if($loyalty->program_type == 'free')
                    <div class="form-group col-lg-6">
                        <label>Have To Buy</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->have_to_buy}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Free Item Number</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->free_item_no}}" readonly>
                    </div>
                    @else
                    <div class="form-group col-lg-6">
                        <label>Spend Amount</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->spend_amount}}" readonly>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Discount Amount</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->discount_amount}}" readonly>
                    </div>
                    @endif
                    <div class="form-group col-lg-6">
                        <label>Point</label>
                        <input type="text" class="form-control border-gray-200" value="{{$loyalty->program_points}}" readonly>
                    </div>

                    {{-- <div class="form-group col-lg-6">
                        <label>Image</label>
                        <input type="file" class="form-control border-gray-200" wire:model="loyalty_image" id="file-up" >
                        <div>
                            @if($loyalty_image != "")
                                <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{ asset('storage/tmp/'.$loyalty_image->getFilename()) }}" alt="">
                            @else
                                @if($loyalty_main_image)
                                    <img class='thumbnail'  style="height: 140px; padding: 10px;" src="{{asset($loyalty_main_image)}}">
                                @endif
                            @endif
                        </div>
                    </div> --}}
                    {{-- <div class="form-group col-lg-6"></div> --}}
                    <div class="form-group col-lg-6">
                        
                        <x-admin.link style="color:red" :href="route('loyaltys.index')" color="secondary">Back</x-admin.link>
                    </div>
                </div>
        </form>
    </div>
</x-admin-layout>