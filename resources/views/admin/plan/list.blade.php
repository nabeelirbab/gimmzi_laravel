<x-admin-layout title="Plan Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Plan List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('plans.index')}}" value="Plan List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('plans.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Plan
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.plan.plan-list')
</x-admin-layout>