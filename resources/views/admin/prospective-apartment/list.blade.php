<x-admin-layout title="Support Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Prospective Provider List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{route('prospective-apartment.index')}}" value="Prospective Provider List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					{{-- <a href="{{route('prospective.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Provider
					</a> --}}
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.prospective-apartment.prospective-apartment-list')
</x-admin-layout>