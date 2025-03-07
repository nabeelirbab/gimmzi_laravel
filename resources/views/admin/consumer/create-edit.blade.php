<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $consumer ? 'Edit' : 'Add' }} Consumer">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('consumers.index') }}" value="Consumer List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $consumer ? 'Edit' : 'Add' }} Consumer" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.consumer.consumer-create-edit', ['consumer' => $consumer])
</x-admin-layout>
