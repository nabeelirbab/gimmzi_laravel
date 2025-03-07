<x-admin-layout title="User Management">
  <x-slot name="subHeader">
      <x-admin.sub-header headerTitle="Consumer Badge">
          <x-admin.breadcrumbs>
              <x-admin.breadcrumbs-item value="Dashboard" href="{{ route('admin.dashboard') }}" />
              <x-admin.breadcrumbs-separator />
              <x-admin.breadcrumbs-item href="{{ route('consumers.badge',$id) }}" value="Consumer Badge" />

          </x-admin.breadcrumbs>
          <x-slot name="toolbar">
                    <a href="{{route('consumer.badge.create',$id)}}" class="btn btn-brand btn-elevate btn-icon-sm">
						<i class="la la-plus"></i>
						Add Badge
					</a>
          </x-slot>
      </x-admin.sub-header>
  </x-slot>
  <livewire:admin.user-badge :badge="$badge" />
</x-admin-layout>