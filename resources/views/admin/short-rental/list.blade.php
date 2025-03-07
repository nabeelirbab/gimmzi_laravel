<x-admin-layout title="Travel And Tourism Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Short Term Rental List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('short-rentals.index')}}" value="Short Term Rental List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{ route('short-rentals.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Short Term Rental
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.short-rental.short-rental-list')
</x-admin-layout>