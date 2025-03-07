<x-admin-layout title="Loyalty Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Deal List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('loyaltys.index') }}" value="Loyalty Reward Program List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $loyalty ? 'Edit' : 'Add' }} Loyalty"  />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
                 {{--<a href="{{ route('deals.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i>
                    Add New Deal
                </a> --}}
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.loyalty.loyalty-create-edit', ['loyalty' => $loyalty])

</x-admin-layout>
