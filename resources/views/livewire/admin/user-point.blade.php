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
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Point
            </th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Came From
            </th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending">Badge
            </th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 23%;"
                aria-label="Company Email: activate to sort column ascending">Added on
            </th>
            </th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 23%;"
                aria-label="Company Email: activate to sort column ascending">Action
            </th>

        </tr>

        <tr class="filter">

            <th>
                <x-admin.input type="search" wire:model.defer="searchPoint" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>

            <th>
                <x-admin.input type="search" wire:model.defer="searchCameFrom" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchbadge" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchAdded" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
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
        @forelse($points as $data)
        <tr role="row" class="odd">
            <td class="sorting_1 align-center" tabindex="0">
                {{ $data->point }}
            </td>
            @if($data->userCameFrom != '')
            <td class="sorting_1 align-center" tabindex="0">
                {{ $data->userCameFrom->full_name }}
            </td>
            @else
            <td class="sorting_1 align-center" tabindex="0">-</td>
            @endif
            @if($data->badge != '')
            <td class="sorting_1 align-center" tabindex="0">
                {{ $data->badge->title }}
            </td>
            @elseif($data->boost != '')
            <td class="sorting_1 align-center" tabindex="0">
            {{ $data->boost->badges->title }}({{ $data->boost->boost_name }})
            </td>
            @else
            <td class="sorting_1 align-center" tabindex="0">-</td>
            @endif
            @php
            $date=date_create($data->created_at);
            $date_create=date_format($date,'d-m-Y');
            @endphp
            <td class="align-center">{{ $date_create }}</td>
            @if($data->badge != '')
                <td></td>
            @elseif($data->boost != '')
                <td></td>
            @else
                <x-admin.td-action>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $data->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                </x-admin.td-action>
            @endif

        </tr>
        @empty
        <tr>
            <td colspan="5" class="align-center">No records available</td>
        </tr>
        @endforelse

        {{-- <tr>
                    <td>{{$user->full_name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->phone}}</td>
        <td class="align-center"><span
                class="kt-badge kt-badge--{{$user->active==1 ? 'success' : 'warning'}} kt-badge--inline cursor-pointer"
                wire:click="changeStatusConfirm({{$user->id}})">{{$user->active==1 ? 'Active' : 'Inactive'}}</span></td>
        <x-admin.td-action>
            <a class="dropdown-item" href="{{route('users.edit', ['user' => $user->id])}}"><i class="la la-edit"></i>
                Edit</a>
            <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $user->id }})"><i
                    class="fa fa-trash"></i> Delete</button>
        </x-admin.td-action>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="align-center">No records available</td>
        </tr>
        @endforelse --}}
    </x-slot>
    <x-slot name="pagination">

    </x-slot>
    <x-slot name="showingEntries">

    </x-slot>
</x-admin.table>