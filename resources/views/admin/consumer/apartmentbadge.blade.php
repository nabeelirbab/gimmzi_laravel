<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $consumer ? 'Edit' : 'Add' }} Consumer">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('consumers.index') }}" value="Consumer List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $consumer ? 'Edit' : 'Add' }} Consumer" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>

    <div class="kt-portlet kt-portlet--mobile">
        {{ Form::open(['route' => ['building-consumers.store'], 'class' => 'kt-form parsley-validate', 'method' => 'POST','files'=>true]) }}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Select Apartment<span style="color: red;">*</span></label>
                    <select name="apartment_id" id="apartment_id" class = 'form-control border-gray-200'>
                        @if($provider)
                        <option>Choose Apartment</option>
                            @foreach ($provider as $data)
                                <option value="{{$data->id}}">
                                    {{$data->name}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @if ($errors->has('type_id'))
                        <div class="error" style="color:red;">{{ $errors->first('apartment_id') }}</div>
                    @endif
                </div>

                <div class="form-group col-lg-6">
                    <label>Select Building<span style="color: red;">*</span></label>
                    <select name="building_id" id="building_id" class = 'form-control border-gray-200'>
                        
                    </select>
                    @if ($errors->has('building_id'))
                        <div class="error" style="color:red;">{{ $errors->first('building_id') }}</div>
                    @endif
                </div>

                <div class="form-group col-lg-6">
                    <label>Select Building Unit<span style="color: red;">*</span></label>
                    <select name="unit_id" id="unit_id" class = 'form-control border-gray-200'>
                        
                    </select>
                    @if ($errors->has('unit_id'))
                        <div class="error" style="color:red;">{{ $errors->first('unit_id') }}</div>
                    @endif
                </div>

                <div class="form-group col-lg-6">
                    <label>Select Unit Badge<span style="color: red;">*</span></label>
                    <select name="badge_id" id="badge_id" class = 'form-control border-gray-200'>
                        
                    </select>
                    @if ($errors->has('badge_id'))
                        <div class="error" style="color:red;">{{ $errors->first('badge_id') }}</div>
                    @endif
                </div>

            </div>
        <div class="row" style="padding: 16px;margin-bottom: 11px;">
            <a href="{{asset('uploads/unit_member.csv')}}" target="_blank" class="btn btn-success">Sample csv</a>
        </div>
            <div class="row">
                <div class="form-group col-lg-12">
                    <label>Upload File(.csv)<span style="color: red;">*</span></label>
                    <input type="file" name="badge_guest_file" >
                    @if ($errors->has('badge_guest_file'))
                        <div class="error" style="color:red;">{{ $errors->first('badge_guest_file') }}</div>
                    @endif
                    
                </div>
            </div>
            
            <div class="kt-portlet__foot">
                <div class="kt-form__actions" id="submitbutton">
                    <button type="submit" class="btn btn-success">Save & Import</button>
                    <a href="{{ route('apartment-badge-consumers') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
            <!--end::Form-->
        </div>
@push('scripts')
<script>
    $(document).ready(function() {
        $("#apartment_id").on('change',function() {
            var apartment_id = $(this).val();
           // console.log(apartment_id);
            $.ajax({
                url: '{{ route('get.consumer.building') }}',
                type: 'get',
                data: {
                    'provider_Id' : apartment_id
                },
                success: function(result) {
                    if (result.success == 1){
                        $('#building_id').html('<option value="">Select Building</option>');
                            $.each(result.data, function(id, value) {
                            $("#building_id").append('<option value="' + value.id +'">' + value.building_name +'</option>');
                        });
                    } else{
                        $('#building_id').html('<option value="">No Building found</option>');
                    }
                }
            })
        });

        $("#building_id").on('change',function() {
            var building_id = $(this).val();
           // console.log(apartment_id);
            $.ajax({
                url: '{{ route('get.building.unit') }}',
                type: 'get',
                data: {
                    'building_Id' : building_id
                },
                success: function(result) {
                    if (result.success == 1){
                        if(result.data.length > 0){
                            $('#unit_id').html('<option value="">Select Building Unit</option>');
                            $.each(result.data, function(id, value) {
                            $("#unit_id").append('<option value="' + value.id +'">' + value.unit +'</option>');
                            });
                        }
                        else{
                            $('#unit_id').html('<option value="">No Building Unit found</option>');
                        }
                    
                    } else{
                        $('#unit_id').html('<option value="">No Building Unit found</option>');
                    }
                }
            })
        });
        $("#unit_id").on('change',function() {
            var unit_id = $(this).val();
           // console.log(apartment_id);
            $.ajax({
                url: '{{ route('get.unit.badges') }}',
                type: 'get',
                data: {
                    'unit_id' : unit_id
                },
                success: function(result) {
                    console.log(result);
                    if (result.success == 1){
                        if(result.data.length > 0){
                            $('#badge_id').html('<option value="">Select Unit Badge</option>');
                            $.each(result.data, function(id, value) {
                                if(value.guest_count < 10){
                                    $("#badge_id").append('<option value="' + value.id +'"> Start Date -' + value.start_date +' To End Date -'+value.end_date +'</option>');
                                }
                                
                            });
                        }
                        else{
                            $('#badge_id').html('<option value="">No Unit badge found</option>');
                        }
                    
                    } else{
                        $('#badge_id').html('<option value="">No Unit badge found</option>');
                    }
                }
            })
        });
    });
</script>
@endpush
</x-admin-layout>
