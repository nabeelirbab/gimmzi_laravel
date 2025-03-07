<x-admin-layout title="Travel And Tourism Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Building List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('hotel-buildings.index') }}" value="Building List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('hotel-building.file.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building By CSV
					</a>
                    <a href="{{route('hotel-buildings.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building By Form
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
    @livewire('admin.hotelbuilding.hotelbuilding-list')
    
</x-admin-layout>
