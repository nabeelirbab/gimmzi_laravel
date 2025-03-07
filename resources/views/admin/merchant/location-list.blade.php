<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Merchant Location List">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('merchants.index') }}" value="Merchant User List" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item href="{{ route('admin.merchant.location',$id) }}" value="Merchant location List" />
            </x-admin.breadcrumbs>

            <x-slot name="toolbar">
                {{--<a href="{{route('merchants.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Merchant User
					</a>--}}
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    @livewire('admin.merchant.location-list', ['id' => $id])
</x-admin-layout>
