<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Message Board List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="" value=" Message Board List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('message-board.edit',$id) }}" value=" Message Board Detail" />
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
                            <h3 class="kt-portlet__head-title">Message Board Detail</h3>
                        </div>
                    </div>
                </div>
                <hr>
                </br>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label> Title</label>
                        <input type="text" value="{{$messageboard->title}}" class="form-control border-gray-200" name="event_to_time" placeholder="Enter  End Timing Here" value="{{ old('event_to_time') }}">
                    </div>
                    <div class="form-group col-lg-6">
                        <label> Default </label>
                        <select  class="form-control border-gray-200"  >
                           <option value="Tenant Only" <?php if($messageboard->tenant_only == 1 ) { echo "selected='selected'"; }?>>Tenant Only</option>
                           <option value="Make Public" <?php if($messageboard->make_public == 1 ) { echo "selected='selected'"; }?>>Make Public</option>
                        </select>
                    </div>    
        </form>
    </div>
</x-admin-layout>