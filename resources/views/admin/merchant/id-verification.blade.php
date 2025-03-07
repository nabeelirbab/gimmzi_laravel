<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $user ? 'Edit' : 'Add' }} Merchant User">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('merchants.index') }}" value="Merchant User List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $user ? 'Edit' : 'Add' }} Merchant User" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
        <!--begin::Form-->
        {!! Form::model($user,['route' => ['admin.merchant.id-verification-submit'],'method' => 'post','class'=>"kt-form kt-form--label-right",'files' => true]) !!}
            {{Form::hidden('user_id', $user->id)}}
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-lg-6 form-group">
                    <label>Doc Verification Status</label>
                    {{Form::select('doc_verify_status', ['0'=>'Pending','1'=>'Process','2'=>'Verified'], null, $attributes = ['class' => $errors->has('doc_verify_status') ? 'form-control is-invalid' : 'form-control'])}}
                    @error('doc_verify_status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-6 form-group">
                    <label>Doc Type</label>
                    {{Form::select('doc_type', ['needs_review'=>'Needs Review','employee_id'=>'Employee ID','tin_letter'=>'TIN Letter','business_license'=>'Business License','other'=>'Other'], null, $attributes = ['class' => $errors->has('doc_type') ? 'form-control is-invalid' : 'form-control'])}}
                    @error('doc_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if($user->upload_doc == '')
                <div class="col-lg-6 form-group">
                    <label>Upload Doc</label>
                    {{Form::file('upload_doc' , $attributes = ['class' => $errors->has('upload_doc') ? 'form-control is-invalid' : 'form-control','id'=>'upload_doc'])}}
                    @error('upload_doc')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @endif
                @if($user->upload_doc != '')
                    <div class="col-lg-6 form-group">
                        <a style="color: blue;" href="{{asset('uploads/business_verification/'.$user->upload_doc)}}" target="_blank">Download & Save ocumentation</a>
                        <a style="color: red;" href="{{route('admin.merchant.id-verification-remove',$user->id)}}" >Remove</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('merchants.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
    <!--end::Form-->
    </div>
</x-admin-layout>