<x-admin-layout title="Provider Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Provider User List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('provider-user.index') }}" value="Provider User List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('provider-user.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Provider User
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.provider-user.provider-user-list')
</x-admin-layout>