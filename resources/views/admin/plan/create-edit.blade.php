<x-admin-layout title="Plan Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $plan ? 'Edit' : 'Add' }} Plan">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('plans.index') }}" value="Plan List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $plan ? 'Edit' : 'Add' }} Plan" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.plan.create-edit', ['merchant_plan' => $plan])
</x-admin-layout>