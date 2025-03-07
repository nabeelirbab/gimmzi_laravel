<x-admin-layout title="Merchant Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $merchant ? 'Edit' : 'Add' }} Merchant User">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('merchants.index') }}" value="Merchant User List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $merchant ? 'Edit' : 'Add' }} Merchant User" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.merchant.merchant-create-edit', ['merchant' => $merchant])
</x-admin-layout>