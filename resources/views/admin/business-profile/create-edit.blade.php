<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $business_profile ? 'Edit' : 'Add' }} Business Profile">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('business-profile.index') }}" value="Business Profile List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $business_profile ? 'Edit' : 'Add' }} Business Profile" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.business-profile.business-profile-create-edit', ['business_profile' => $business_profile])
</x-admin-layout>
