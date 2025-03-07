<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $consumer_unit ? 'Edit' : 'Add' }} Consumer Provider">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('admin.consumer.providers',$user_id) }}" value="Consumer Provider List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $consumer_unit ? 'Edit' : 'Add' }} Consumer" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.consumer.provider.provider-create-edit', ['consumer_unit' => $consumer_unit,'user_id'=>$user_id])
</x-admin-layout>