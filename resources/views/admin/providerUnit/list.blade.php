<x-admin-layout title="Property Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Building Unit List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('provider-unit.index')}}" value="Building Unit List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
				    <a href="{{route('unit.file.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building Unit By CSV
					</a>
					<a href="{{route('provider-unit.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Building Unit By Form
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>

	@livewire('admin.provider-unit.unit-list')
</x-admin-layout>