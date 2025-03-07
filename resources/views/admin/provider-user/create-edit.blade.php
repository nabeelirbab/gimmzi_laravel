<x-admin-layout title="Provider Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $provider_user ? 'Edit' : 'Add' }} Provider">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('provider-user.index') }}" value="Provider User List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $provider_user ? 'Edit' : 'Add' }} Provider" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.provider-user.provider-user-create-edit', ['provider_user' => $provider_user])
</x-admin-layout>