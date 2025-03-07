<x-admin-layout title="CMS Management">
	<x-slot name="subHeader">
            <x-admin.sub-header headerTitle="CMS Management">
				<x-admin.breadcrumbs>
                        <x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('cms.terms_condition.edit') }}" value="Terms and Condition Page" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="Update Terms and Condition" />
				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	<div class="kt-portlet kt-portlet--mobile">
    {{Form::model($terms_condition,['route'=>['cms.terms_condition.update',$terms_condition->id],'class'=>'kt-form parsley-validate','method'=>'PATCH','files'=>true])}}
				<div class="kt-portlet__body">
					<div class="row">
						<div class="form-group col-lg-12">
                            <label>Terms & Condition Description<span style="color: red;">*</span></label>
                            {{ Form::textarea('description',null,['class' => 'form-control border-gray-200 ckeditor','placeholder'=>'Enter Description here']) }}
                            @if($errors->has('description'))
                            <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
					</div>
					<div class="kt-portlet__foot">
						<div class="kt-form__actions" id="submitbutton">
							<button type="submit" class="btn btn-success">Submit</button>
							<a href="{{route('admin.dashboard')}}" class="btn btn-secondary">Cancel</a>
						</div>
					</div>
		{{Form::close()}}
		<!--end::Form-->
	</div>
	
</x-admin-layout>