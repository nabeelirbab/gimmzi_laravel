<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $suggested_description ? 'Edit' : 'Add' }} Suggested Description List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('suggested-description.index') }}" value="Suggested Description List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $suggested_description ? 'Edit' : 'Add' }} Suggested Description List" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.suggested-description.suggested-description-create-edit', ['suggested_description' => $suggested_description])
</x-admin-layout>
