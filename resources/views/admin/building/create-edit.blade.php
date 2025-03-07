<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $building ? 'Edit' : 'Add' }} Building">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('buildings.index') }}" value="Building List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $building ? 'Edit' : 'Add' }} Building" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>

    <div class="kt-portlet kt-portlet--mobile">
    </div>
    @livewire('admin.building.building-create-edit', ['building' => $building])
</x-admin-layout>