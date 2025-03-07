<x-admin-layout title="Consumer Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Consumer Provider List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('admin.consumer.providers',$user_id) }}" value="Consumer Provider List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					<a href="{{route('consumer.providers.create', $user_id)}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add New Consumer Provider
					</a>
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
	@livewire('admin.consumer.provider.provider-list',['user_id' => $user_id])
</x-admin-layout>
