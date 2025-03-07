<x-admin-layout title="Travel And Tourism Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $short_rental ? 'Edit' : 'Add' }} Short Term Rental">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('short-rentals.index') }}" value="Short Term Rental List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $short_rental ? 'Edit' : 'Add' }} Short Term Rental" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	

				</x-slot>
			</x-admin.sub-header>
	</x-slot>
    
	@livewire('admin.short-rental.short-rental-create-edit', ['short_rental' => $short_rental])
</x-admin-layout>