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
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 23%;" aria-label="Company Email: activate to sort column ascending">Badge
            </th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 23%;" aria-label="Company Email: activate to sort column ascending">Boost
            </th>
            <th tabindex="0" class="align-center" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 22%;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">Point
            </th>
        </tr>
    </x-slot>

    <x-slot name="tbody">
        @forelse($badge as $data)
            <tr role="row" class="odd">
                <td class="sorting_1 align-center" tabindex="0">
                    {{ $data->badge->title }}
                </td>
                @if ($data->boost_id != '')
                    <td class="align-center">{{ $data->boost->boost_name }}</td>
                @else
                    <td class="align-center">-</td>
                @endif
                <td class="align-center">{{ $data->point }}</td>

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
                    <td class="align-center"><span class="kt-badge kt-badge--{{$user->active==1 ? 'success' : 'warning'}} kt-badge--inline cursor-pointer" wire:click="changeStatusConfirm({{$user->id}})">{{$user->active==1 ? 'Active' : 'Inactive'}}</span></td>
                    <x-admin.td-action>
                        <a class="dropdown-item" href="{{route('users.edit', ['user' => $user->id])}}" ><i class="la la-edit"></i> Edit</a>
                        <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $user->id }})"><i class="fa fa-trash" ></i> Delete</button>
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
