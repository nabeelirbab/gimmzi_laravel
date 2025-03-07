<x-admin-layout title="Provider Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $user ? 'Edit' : 'Add' }} Provider">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('providers.index') }}" value="Provider List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $user ? 'Edit' : 'Add' }} Provider" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
        <!--begin::Form-->
        {!! Form::model($user,['route' => ['admin.provider.id-verification-submit'],'method' => 'post','class'=>"kt-form kt-form--label-right",'files' => true]) !!}
            {{Form::hidden('user_id', $user->id)}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label>Doc Verification Status</label>
                    {{Form::select('doc_verify_status', ['0'=>'Non Verify','1'=>'Process','2'=>'Verified'], null, $attributes = ['class' => $errors->has('doc_verify_status') ? 'form-control is-invalid' : 'form-control'])}}
                    @error('doc_verify_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label>Doc Type</label>
                    {{Form::select('doc_type', ['driving_license'=>'Driving License','passport'=>'Passport'], null, $attributes = ['class' => $errors->has('doc_type') ? 'form-control is-invalid' : 'form-control'])}}
                    @error('doc_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label>Upload Doc</label>
                    {{Form::file('upload_doc' , $attributes = ['class' => $errors->has('upload_doc') ? 'form-control is-invalid' : 'form-control','id'=>'upload_doc'])}}
                    @error('upload_doc')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if(isset($user->upload_doc))
                    <div class="col-lg-6 form-group">
                        <img src="{{url('upload/doc/'.$user->upload_doc)}}" height="80">
                    </div>
                @endif
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('providers.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
    <!--end::Form-->
    </div>
</x-admin-layout>