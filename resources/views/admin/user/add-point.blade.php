<x-admin-layout title="User Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Consumer Points">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('consumers.point',$id) }}" value="Consumer Point" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Add Point" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    <div class="kt-portlet kt-portlet--mobile">
        <form method="post" action="{{route('consumer.point.store')}}">
        @csrf
        <div class="kt-portlet__body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Point<span style="color: red;">*</span></label>
                    <input type="text" name="point" value="{{old('point')}}" class="form-control border-gray-200" placeholder="Point">
                    @if ($errors->has('point'))
                        <div class="error" style="color:red;">{{ $errors->first('point') }}</div>
                    @endif
                    <input type="hidden" value="{{$id}}" name="consumer_id">
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('consumers.point',$id) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>
</x-admin-layout>