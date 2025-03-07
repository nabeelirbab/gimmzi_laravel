<x-admin-layout title="Master Management">
  <x-slot name="subHeader">
          <x-admin.sub-header headerTitle="Tenant Recognition List">
      <x-admin.breadcrumbs>
          <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
          <x-admin.breadcrumbs-separator />
          <x-admin.breadcrumbs-item href="{{ route('admin.default.message') }}" value="Tenant Recognition List" />
      </x-admin.breadcrumbs>

        <x-slot name="toolbar" >
        {{--<a href="{{route('titles.create')}}" class="btn btn-brand btn-elevate btn-icon-sm">
          <i class="la la-plus"></i>
          Add New Title
        </a>--}}
      </x-slot>
    </x-admin.sub-header>
  </x-slot>
  <livewire:admin.default-message.message-list/>

</x-admin-layout>