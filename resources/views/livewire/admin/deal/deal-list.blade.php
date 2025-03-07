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
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Deal<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('suggested_description')"></i>
            </th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Business Name</th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 23%;"
                aria-label="Company Email: activate to sort column ascending">Discount<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('discount_amount')"></i></th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-label="Status: activate to sort column ascending" class="align-center">Status
            </th>

            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="SearchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchCategory" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchDiscount"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="free">Free</option>
                    <option value="discount">Discount</option>
                    <option value="percentage">Percentage</option>

                </select>
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
        @forelse($deals as $data)

        <tr role="row" class="odd">
            @if (!empty($data->suggested_description))
            <td class="sorting_1 align-center" tabindex="0">
                {{ $data->suggested_description }}
            </td>
            @else
            <td class="align-center">-</td>
            @endif


            @if (!empty($data->businessProfile->business_name))
            <td class="align-center">{{ $data->businessProfile->business_name}}</td>
            @else
            <td class="align-center">-</td>
            @endif
            <td class="align-center">
                @if ($data->discount_type=='free')
                Free
                @elseif ($data->discount_type=='discount')
                ${{ $data->discount_amount }}
                @else
                ${{ $data->discount_amount }}
                @endif
            </td>
            <td class="align-center"><span
                    class="kt-badge  kt-badge--{{ $data->status == 1 ? 'success' : 'warning' }} kt-badge--inline kt-badge--pill cursor-pointer"
                    wire:click="changeStatusConfirm({{ $data->id }})">{{ $data->status == 1 ? 'Active' : 'Inactive'
                    }}</span>
            </td>

            <x-admin.td-action>

                <a class="dropdown-item" href="{{ route('deals.show', ['deal' => $data->id]) }}"><i
                        class="fa fa-eye"></i> View</a>
                <a class="dropdown-item" href="{{ route('deals.edit', ['deal' => $data->id]) }}"><i
                    class="fa fa-edit"></i> Edit</a>
            </x-admin.td-action>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="align-center">No records available</td>
        </tr>
        @endforelse


    </x-slot>
    <x-slot name="pagination">
        {{ $deals->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $deals->firstitem() ?? 0 }} to {{ $deals->lastitem() ?? 0 }} of {{ $deals->total() }}
        entries
    </x-slot>
</x-admin.table>