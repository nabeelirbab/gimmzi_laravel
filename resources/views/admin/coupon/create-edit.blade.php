<x-admin-layout title="Coupon Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="{{ $coupon ? 'Edit' : 'Add' }} Coupon">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('coupons.index') }}" value="Coupon List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="{{ $coupon ? 'Edit' : 'Add' }} Coupon" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <livewire:admin.coupon.create-edit :coupon="$coupon" />
</x-admin-layout>
