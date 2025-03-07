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

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 45%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Title Name
                <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('title_name')"></i>
            </th>

            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 15%;" aria-label="Status: activate to sort column ascending" class="align-center">Status
            </th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">

            <th>
                <x-admin.input type="search" wire:model.defer="searchTitleName" placeholder="" autocomplete="off" class="form-control-sm form-filter" />
            </th>
            
            </th>
            <th>
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
        @forelse($titles as $title)
            <tr role="row" class="odd">

                <td class="sorting_1 align-center" tabindex="0">{{ $title->title_name }}</td>
                
                <td class="align-center"><span
                        class="kt-badge  kt-badge--{{ $title->status == 1 ? 'success' : 'warning' }} kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeStatusConfirm({{ $title->id }})">{{ $title->status == 1 ? 'Active' : 'Inactive' }}</span>
                </td>
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('titles.edit', ['title' => $title->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                    {{--<button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $title->id }})"><i
                            class="fa fa-trash"></i> Delete</button>--}}
                   
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse
    </x-slot>
    <x-slot name="pagination">
        {{ $titles->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $titles->firstitem() ?? 0 }} to {{ $titles->lastitem() ?? 0 }} of {{ $titles->total() }}
        entries
    </x-slot>
</x-admin.table>

