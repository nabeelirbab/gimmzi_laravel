<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Tenant Recognition List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('admin.default.message') }}" value="Tenant Recognition List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('admin.default.message.view',$id) }}" value="Tenant Recognition Detail" />
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
                            <h3 class="kt-portlet__head-title">Message Detail</h3>
                        </div>
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Message Type</label>
                        <input type="text" class="form-control border-gray-200"
                            value="{{$detail->type->type_name}}" readonly>
                    </div>
                   
                    <div class="form-group col-lg-6">
                        <label>Message</label>
                        <textarea class="form-control border-gray-200" rows = '5' cols = '10' readonly>{{$detail->message}}</textarea>
                    </div>
                </div>
                
        </form>
    </div>
</x-admin-layout>