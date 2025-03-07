<x-admin-layout title="Badge Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Badge List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('badges.index') }}" value="Badge List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					{{-- <a href="{{route('badges.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Badge
					</a> --}}
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.badge.badge-list')
</x-admin-layout>