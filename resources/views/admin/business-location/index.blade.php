<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Business Location List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('business-location.index') }}" value="Business Location List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
				    <a href="{{route('business-locations.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Business Location By CSV
					</a>
                    <a href="{{route('business-location.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Business Location By Form
					</a>
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
    @livewire('admin.business-location.business-location-list',['business' => $business])
    
</x-admin-layout>