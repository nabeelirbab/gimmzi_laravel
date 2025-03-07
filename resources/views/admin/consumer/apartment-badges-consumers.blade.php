<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Apartment Badges Consumer List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('apartment-badge-consumers') }}" value="Apartment Badges Consumer List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
					<a href="{{route('building-consumers.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Consumer For Unit Badges
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.consumer.apartment-badge-consumer')
</x-admin-layout>