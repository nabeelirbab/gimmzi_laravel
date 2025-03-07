<x-admin.table>
    {{-- <x-slot name="search">
        <x-admin.input type="search" class="form-control form-control-sm" wire:model.debounce.500ms="search"
            aria-controls="kt_table_1" id="generalSearch" />
    </x-slot> --}}
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

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 14%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Status</th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">
                <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('consumer_count')"></i>Consumer Count
                
            </th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-label="Company Agent: activate to sort column ascending" class="align-center"> Apartment name </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 16%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Contact Made By</th>  

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Last Action</th>  
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 18%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Action Taken</th>  

            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="1">Listed</option>
                    <option value="0">Unlisted</option>
                </select>
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchUserCount" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
           
            <th>
                <x-admin.input type="search" wire:model.defer="searchApartment" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchContact" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="date" wire:model.defer="searchDate" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchAction"
                    title="Select" data-col-index="2">
                    <option value="">Select One</option>
                    <option value="Phone Call">Phone Call</option>
                    <option value="Email Sent">Email Sent</option>
                    <option value="Site Visited">Site Visited</option>
                    <option value="Planned Site Visit">Planned Site Visit</option>
                    <option value="Added to Network">Added to Network</option>
                    <option value="Unlist Provider">Unlist Provider</option>
                    <option value="Relist">Relist</option>
                </select>
            </th>
            <th>
                <div class="row align-center">
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
        
        @forelse($prospectives as $prospective)
        
            <tr role="row" class="odd">
                @if($prospective->status == 0)
                  <td class="align-center">Unlisted</td>
                @else
                  <td class="align-center">Listed</td>
                @endif
                <td class="sorting_1 align-center" tabindex="0">{{ count($prospective->prospectiveApartmentUser) }}</td>               
                <td class="align-center">{{ $prospective->apartment_name }}</td>
                @if($prospective->propertyNote->last() != '')
                  <td class="align-center">{{ $prospective->propertyNote->last()->user->full_name }}</td>
                @else
                  <td class="align-center"> - </td>
                @endif
                @if($prospective->propertyNote->last() != '')
                    <?php $actiondate = date_format(date_create($prospective->propertyNote->last()->created_at),'m/d/Y');?>
                    <td class="align-center">{{ $actiondate }}</td>
                @else
                  <td class="align-center"> - </td>
                @endif
                @if($prospective->propertyNote->last() != '')
                  <td class="align-center">{{ $prospective->propertyNote->last()->action_taken }}</td>
                @else
                  <td class="align-center"> - </td>
                @endif
                <x-admin.td-action>
                    
                    <a class="dropdown-item" href="{{route('prospective-apartment.show', ['prospective_apartment' => $prospective->id])}}"><i
                        class="la la-eye"></i> View</a>
                        
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse

        
    </x-slot>
    <x-slot name="pagination">
        {{ $prospectives->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $prospectives->firstitem() ?? 0 }} to {{ $prospectives->lastitem() ?? 0 }} of {{ $prospectives->total() }}
        entries
    </x-slot>
</x-admin.table>
