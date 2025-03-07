<x-admin-layout title="Provider Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{$name}}'s Property List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('provider-user.index') }}" value="Provider User List" />
                        <x-admin.breadcrumbs-separator />
                        <x-admin.breadcrumbs-item href="{{ route('admin.provider-user.property',$id) }}" value="{{$name}}'s Property List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.provider-user.property.property-list',['id' => $id])
</x-admin-layout>