<x-admin-layout title="Title Management">
  <x-slot name="subHeader">
      <x-admin.sub-header headerTitle="{{ $title ? 'Edit' : 'Add' }} Title">
          <x-admin.breadcrumbs>
              <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
              <x-admin.breadcrumbs-separator />
              <x-admin.breadcrumbs-item href="{{ route('titles.index') }}" value="Title List" />
              <x-admin.breadcrumbs-separator />
              <x-admin.breadcrumbs-item value="{{ $title ? 'Edit' : 'Add' }} Title" />

          </x-admin.breadcrumbs>
          <x-slot name="toolbar">
          </x-slot>
      </x-admin.sub-header>
  </x-slot>
  <livewire:admin.title.title-create-edit :title="$title"/>
  
</x-admin-layout>
