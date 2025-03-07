<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $business_location ? 'Edit' : 'Add' }} Business Location">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('business-location.index') }}" value="Business Location List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $business_location ? 'Edit' : 'Add' }} Business Location" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.business-location.business-location-create-edit', ['business_location' => $business_location])
</x-admin-layout>
