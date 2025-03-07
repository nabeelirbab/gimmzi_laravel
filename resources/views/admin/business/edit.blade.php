<x-admin-layout title="Master Management">
  <x-slot name="subHeader">
      <x-admin.sub-header headerTitle="{{ $business ? 'Edit' : 'Add' }} Business Category">
          <x-admin.breadcrumbs>
              <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
              <x-admin.breadcrumbs-separator />
              <x-admin.breadcrumbs-item href="{{ route('business-category.index') }}" value="Business Category List" />
              <x-admin.breadcrumbs-separator />
              <x-admin.breadcrumbs-item value="{{ $business ? 'Edit' : 'Add' }} Business Category" />

          </x-admin.breadcrumbs>
          <x-slot name="toolbar">
          </x-slot>
      </x-admin.sub-header>
  </x-slot>
  <livewire:admin.business.business-edit :business="$business">
</x-admin-layout>
