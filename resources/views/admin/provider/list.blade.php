<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Provider List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('providers.index')}}" value="Provider List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('providers.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Provider
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.provider.provider-list')
</x-admin-layout>