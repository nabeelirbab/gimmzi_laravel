<x-admin-layout title="Loyalty Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Loyalty Reward Program List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('loyaltys.index') }}" value="Loyalty Reward Program List" />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <livewire:admin.loyalty.loyalty-list />
</x-admin-layout>
