<x-admin-layout title="Travel And Tourism Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $hotel_resort ? 'Edit' : 'Add' }} Hotel/Resort">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('hotel-resorts.index') }}" value="Hotel/Resort List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $hotel_resort ? 'Edit' : 'Add' }} Hotel/Resort" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	

				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    
	@livewire('admin.hotel-resort.hotel-resort-create-edit', ['hotel_resort' => $hotel_resort])
</x-admin-layout>