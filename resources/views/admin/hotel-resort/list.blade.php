<x-admin-layout title="Travel And Tourism Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Hotel/Resort List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('hotel-resorts.index')}}" value="Hotel/Resort List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{ route('hotel-resorts.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Hotel/Resort
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.hotel-resort.hotel-resort-list')
</x-admin-layout>