<x-admin-layout title="User Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Travel & Tourism User List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('admin.travel_tourism.userlist') }}" value="Travel & Tourism User List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('admin.travel_tourism.usercreate')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Travel & Tourism User
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.travel-tourism-user.user-list')
</x-admin-layout>