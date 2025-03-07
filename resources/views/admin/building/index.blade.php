<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Building List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('buildings.index') }}" value="Building List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('building.file.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building By CSV
					</a>
                    <a href="{{route('buildings.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building By Form
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
    @livewire('admin.building.building-list')
    
</x-admin-layout>
