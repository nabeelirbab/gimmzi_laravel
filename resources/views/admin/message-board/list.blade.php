<x-admin-layout title="Master Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="Message Board List">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('message-board.index') }}" value="Message Board List" />
				</x-admin.breadcrumbs>

			    <x-slot name="toolbar" >
					
                    {{-- <a href="" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Description 
					</a> --}}
				</x-slot>
			</x-admin.sub-header>
    </x-slot>
    @livewire('admin.message-board.message-board-list')
    
</x-admin-layout>