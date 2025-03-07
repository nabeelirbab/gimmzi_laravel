<x-admin-layout title="User Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Consumer Badge">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('consumers.badge',$id) }}" value="Consumer Badge" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Add Consumer Badge" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    <div class="kt-portlet kt-portlet--mobile">
        <form method="post" action="{{route('consumer.badge.store')}}">
        @csrf
        <div class="kt-portlet__body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Select Badge<span style="color: red;">*</span></label>
                    <select class="form-control border-gray-200" name="badge_id" id="badgeid">
                        <option value="" selected disabled>--Select one--</option>
                        @if($badge)
                            @foreach($badge as $data)
                            <option value="{{$data->id}}">{{$data->title}}</option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('badge_id'))
                        <div class="error" style="color:red;">{{ $errors->first('badge_id') }}</div>
                    @endif
                    <input type="hidden" value="{{$id}}" name="consumer_id">
                </div>
                <div class="form-group col-lg-6">
                    <label>Select Boost<span style="color: red;">*</span></label>
                    <select class="form-control border-gray-200" name="boost_id" id="boostid">
                      
                    </select>
                    @if ($errors->has('boost_id'))
                        <div class="error" style="color:red;">{{ $errors->first('boost_id') }}</div>
                    @endif
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a href="{{ route('consumers.badge',$id) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
        </form>
    </div>
    @push('scripts')
    <script>
    $(document).ready(function() {
        $("#badgeid").on('change',function() {
            var badge_id = $(this).val();
            $.ajax({
                url: '{{ route('get.boost') }}',
                type: 'get',
                data: {
                    'badge_id' : badge_id
                },
                success: function(result) {
                    if (result.success == 1)
                        $('#boostid').html('<option>--Select one--</option>');
                        $.each(result.data, function(id, value) {
                        $("#boostid").append('<option value="' + value.id +'">' + value.boost_name +'</option>');
                    });
                }
            });
        });
    });
    </script>
    @endpush
</x-admin-layout>