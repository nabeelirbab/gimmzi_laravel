<x-admin-layout title="Cms Management">
    <x-slot name="subHeader">
            <x-admin.sub-header headerTitle="{{ $faq ? 'Edit' : 'Add' }} FAQ">
				<x-admin.breadcrumbs>
						<x-admin.breadcrumbs-item  value="Dashboard" href="{{ route('admin.dashboard') }}" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item href="{{ route('cms.faq.list') }}" value="FAQ List" />
						<x-admin.breadcrumbs-separator />
						<x-admin.breadcrumbs-item  value="{{ $faq ? 'Edit' : 'Add' }} FAQ" />

				</x-admin.breadcrumbs>
				<x-slot name="toolbar">	
				</x-slot>
			</x-admin.sub-header>
	</x-slot>
	@livewire('admin.cms.faq-create-edit', ['faq' => $faq])
</x-admin-layout>