<x-admin-layout title="Coupon Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Coupon List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('coupons.index') }}" value="Coupon List" />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
                 <a href="{{ route('coupons.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                    <i class="la la-plus"></i>
                    Add New Coupon
                </a> 
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <livewire:admin.coupon.coupon-list />
</x-admin-layout>
