<x-admin-layout title="Master Management">
  <x-slot name="subHeader">
    <x-admin.sub-header headerTitle="Business Category List">
      <x-admin.breadcrumbs>
        <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
        <x-admin.breadcrumbs-separator />
        <x-admin.breadcrumbs-item href="{{ route('business-category.index') }}" value="Business Category List" />
      </x-admin.breadcrumbs>

      <x-slot name="toolbar">

      </x-slot>
    </x-admin.sub-header>
  </x-slot>
  <livewire:admin.business.business-list>

</x-admin-layout>