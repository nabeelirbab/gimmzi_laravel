<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Consumer List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('consumers.index') }}" value="Consumer List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('consumers.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Consumer
					</a>
					<a href="{{route('building-consumers.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Consumer For Building Unit
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.consumer.consumer-list')
</x-admin-layout>