<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Merchant Business List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('business-profile.index') }}" value="Merchant Business List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
                    <a href="{{route('business-profile.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Merchant Business
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
    @livewire('admin.business-profile.business-profile-list')
    
</x-admin-layout>