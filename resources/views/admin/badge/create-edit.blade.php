<x-admin-layout title="Badge Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $badge ? 'Edit' : 'Add' }} Badge">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('badges.index') }}" value="Badge List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $badge ? 'Edit' : 'Add' }} Badge" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.badge.badge-create-edit', ['badge' => $badge])
</x-admin-layout>
