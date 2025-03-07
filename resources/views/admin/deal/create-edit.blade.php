<x-admin-layout title="Deal Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Deal List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('deals.index') }}" value="Deal List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $deal ? 'Edit' : 'Add' }} Deal"  />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
                 {{--<a href="{{ route('deals.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i>
                    Add New Deal
                </a> --}}
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.deal.deal-create-edit', ['deal' => $deal])

</x-admin-layout>
