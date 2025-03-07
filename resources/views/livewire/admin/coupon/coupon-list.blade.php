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
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Coupon Code <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('coupon_code')"></i>
            </th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Category<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('coupon_code')"></i>
            </th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 23%;"
                aria-label="Company Email: activate to sort column ascending">Point<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('point')"></i></th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 20%;"
                aria-label="Company Agent: activate to sort column ascending">IsUsed<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('is_used')"></i></th>
           
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchCode" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchCategory" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchPoint" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchIsused"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="0">Not Used</option>
                    <option value="1">Used</option>
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
        @forelse($coupons as $data)
            <tr role="row" class="odd">
                <td class="sorting_1 align-center" tabindex="0">
                {{ $data->coupon_code }}
                </td>
                <td class="align-center">{{ $data->category->category_name}}</td>
                <td class="align-center">{{ $data->point}}</td>
                @if($data->is_used == 0)
                   <td class="align-center"><span style="color: red;">Not Used</span></td>
                @else
                   <td class="align-center"><span style="color: green;">Used</span></td>
                @endif
               
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('coupons.edit', ['coupon' => $data->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $data->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse

        
    </x-slot>
    <x-slot name="pagination">
        {{ $coupons->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $coupons->firstitem() ?? 0 }} to {{ $coupons->lastitem() ?? 0 }} of {{ $coupons->total() }}
        entries
    </x-slot>
</x-admin.table>
