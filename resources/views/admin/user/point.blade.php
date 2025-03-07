<x-admin-layout title="User Management">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Consumer Points">
            <x-admin.breadcrumbs>
                <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
                <x-admin.breadcrumbs-separator />
                <x-admin.breadcrumbs-item value="Consumer Points" />

            </x-admin.breadcrumbs>
            <x-slot name="toolbar">
                    <a href="{{route('consumer.point.create',$point_id)}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add point
					</a>
            </x-slot>
        </x-admin.sub-header>
    </x-slot>
    <livewire:admin.user-point :point_id="$point_id" />
</x-admin-layout>
