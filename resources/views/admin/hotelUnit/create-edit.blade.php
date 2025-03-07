<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $hotel_unit ? 'Edit' : 'Add' }} Building Unit">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('hotel-unit.index') }}" value="Building Unit List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $hotel_unit ? 'Edit' : 'Add' }} Building Unit" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.hotel-unit.hotelunit-create-edit', ['hotel_unit' => $hotel_unit])
</x-admin-layout>