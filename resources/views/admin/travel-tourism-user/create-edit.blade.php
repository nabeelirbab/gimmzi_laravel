<x-admin-layout title="User Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $user ? 'Edit' : 'Add' }} Travel & Tourism User">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('admin.travel_tourism.userlist') }}" value="Travel & Tourism User List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $user ? 'Edit' : 'Add' }} Travel & Tourism User" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.travel-tourism-user.create-edit', ['user' => $user])
</x-admin-layout>