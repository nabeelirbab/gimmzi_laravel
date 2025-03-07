<x-admin-layout title="Support Management">
  <x-slot name="subHeader">
    <x-admin.sub-header headerTitle="Trouble Ticket List">
      <x-admin.breadcrumbs>
        <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
        <x-admin.breadcrumbs-separator />
        <x-admin.breadcrumbs-item href="{{ route('supports.index') }}" value="Trouble Ticket List" />
        <x-admin.breadcrumbs-separator />
        <x-admin.breadcrumbs-item href="" value="View Trouble Ticket" />

      </x-admin.breadcrumbs>

      <x-slot name="toolbar">

      </x-slot>
    </x-admin.sub-header>
  </x-slot>

  <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
      <div class="col-lg-12">
        <div class="kt-portlet">
          <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">Trouble Ticket</h3>
            </div>
          </div>
          <form action="">
            <div class="kt-portlet__body">
              <div class="row">
                <div class="form-group col-lg-6">
                  <label>User Name</label>
                  <input class="form-control border-gray-200" type="text" readonly
                    value="{{ $support->user->full_name }}">
                </div>
                <div class="form-group col-lg-6">
                  <label>Subject</label>
                  <input class="form-control border-gray-200" type="text" readonly value="{{ $support->subject }}">
                </div>
                <div class="form-group col-lg-6">
                  <label>Issue</label>
                  <textarea class="form-control border-gray-200" readonly rows="8" cols="54">{{ $support->issue }}
                  </textarea>
                </div>
                <div class="form-group col-lg-6">
                  <label>Is Closed</label>
                  @if($support->is_closed==1)
                    <input class="form-control border-gray-200" type="text" readonly value="Open">
                  @elseif($support->is_closed==0)
                    <input class="form-control border-gray-200" type="text" readonly value="Closed">
                  @else
                    <input class="form-control border-gray-200" type="text" readonly value="Reopen">
                  @endif
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</x-admin-layout>