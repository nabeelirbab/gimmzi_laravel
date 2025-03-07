<x-admin-layout title="CMS Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Edit Page">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="Edit Page" href="javascript:void(0)" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <livewire:admin.page.create-edit>
</x-admin-layout>
