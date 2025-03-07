<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $hotel_building ? 'Edit' : 'Add' }} Building">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('hotel-buildings.index') }}" value="Building List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $hotel_building ? 'Edit' : 'Add' }} Building" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>

    <div class="kt-portlet kt-portlet--mobile">
    </div>
    @livewire('admin.hotelbuilding.hotelbuilding-create-edit', ['hotel_building' => $hotel_building])
</x-admin-layout>