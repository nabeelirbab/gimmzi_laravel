<x-admin.table>
    <x-slot name="perPage">
        <label>Show
            <x-admin.dropdown wire:model="perPage" class="custom-select custom-select-sm form-control form-control-sm">
                @foreach ($perPageList as $page)
                <x-admin.dropdown-item :value="$page['value']" :text="$page['text']" />
                @endforeach
            </x-admin.dropdown> entries
        </label>
    </x-slot>

    <x-slot name="thead">
        <tr role="row">
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Title<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('title')"></i>
            </th>
            {{-- <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending"> Make Public <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('make_public')"></i>
            </th> --}}
     {{-- <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
            aria-sort="ascending" aria-label="Agent: activate to sort column descending"> Tenant Only <i
                class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                wire:click="sortBy('tenant_only')"></i>
        </th> --}}
        
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-label="Status: activate to sort column ascending">Status</th>

            <th class="align-center" rowspan="1" colspan="1" style="width: 10%;" aria-label="Actions">Actions</th>
       
        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchTitle" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
              
           
            {{-- <th><x-admin.input type="search" wire:model.defer="searchMakePublic" placeholder="" autocomplete="off"
                class="form-control-sm form-filter" /></th>
            <th>
                <th><x-admin.input type="search" wire:model.defer="searchTenantOnly" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" /></th>
                <th> --}}
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
               </th>
                <th>
                <div class="row">
                  
                    <div class="col-md-6">
                        <button class="btn btn-brand kt-btn btn-sm kt-btn--icon" wire:click="search">
                            <span>
                                <i class="la la-search"></i>
                                <span>Search</span>
                            </span>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-secondary kt-btn btn-sm kt-btn--icon" wire:click="resetSearch">
                            <span>
                                <i class="la la-close"></i>
                                <span>Reset</span>
                            </span>
                        </button>
                    </div>
                </div>
            </th>
        </tr>
    </x-slot>
 
    <x-slot name="tbody">
        @forelse($messageboard as $message)
        <tr role="row" class="odd">
            <td class="align-center">{{ $message->title}}</td>
            
            {{-- <td class="align-center">{{ $message->make_public }}</td>
             {{-- <td class="align-center">-</td> --}}
           
              {{-- <td class="align-center">{{ $message->tenant_only }}</td> --}}
            
            <td class="align-center"><span
                    class="kt-badge  kt-badge--{{ $message->status == 1 ? 'success' : 'warning' }} kt-badge--inline kt-badge--pill cursor-pointer"
                    wire:click="changeStatusConfirm({{ $message->id }})">{{ $message->status == 1 ? 'Active' :
                    'Inactive'
                    }}</span>
            </td>
            <x-admin.td-action>
                <a class="dropdown-item" href="{{ route('message-board.edit', $message->id) }}">
                    <i class="fa fa-eye"></i> View
                </a>
                {{-- <a class="dropdown-item" href="{{ route('admin.default.message.view', ['id' => $data->id]) }}"><i
                    class="fa fa-eye"></i> View</a> --}}
              
                {{-- <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $des->id }})"><i class="fa fa-trash"></i> Delete</button> --}}
            </x-admin.td-action>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="align-center">No records available</td>
        </tr>
        @endforelse
    </x-slot>
    <x-slot name="pagination">
        {{ $messageboard->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $messageboard->firstitem() ?? 0 }} to {{ $messageboard->lastitem() ?? 0 }} of {{ $messageboard->total() }}
        entries
    </x-slot>
</x-admin.table>
