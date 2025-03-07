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

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 22%;"
                aria-sort="ascending" aria-label="Agent: activate to sort column descending" class="align-center">Name
                <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('first_name')"></i>
            </th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 16%;"
                aria-label="Company Email: activate to sort column ascending" class="align-center">UserId <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('userId')"></i></th>

            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"
                aria-label="Company Agent: activate to sort column ascending" class="align-center">Phone <i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('phone')"></i></th>

            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 15%;" aria-label="Status: activate to sort column ascending" class="align-center">Status
            </th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">

            <th>
                <x-admin.input type="search" wire:model.defer="searchName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
           
            <th>
                <x-admin.input type="search" wire:model.defer="searchId" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchPhone" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
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
        @forelse($users as $user)
            <tr role="row" class="odd">

                <td class="sorting_1 align-center" tabindex="0">
                    <div class="kt-user-card-v2">
                        <div class="kt-user-card-v2__pic">
                            <div class="kt-badge kt-badge--xl kt-badge--{{ $this->getRandomColor() }}">
                                <span>{{ substr($user->first_name, 0, 1) }}</span>
                            </div>
                        </div>
                        <div class="kt-user-card-v2__details">
                            <span class="kt-user-card-v2__name">{{ $user->full_name }}</span>
                            <a href="#" class="kt-user-card-v2__email kt-link">Member since
                                {{ $user->created_at->diffForHumans(null, true) . ' ' }}</a>
                        </div>
                    </div>
                </td>               
                <td class="align-center">{{ $user->userId }}</td>
                <td class="align-center">{{ $user->phone }}</td>
                <td class="align-center"><span
                        class="kt-badge  kt-badge--{{ $user->active == 1 ? 'success' : 'warning' }} kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeStatusConfirm({{ $user->id }})">{{ $user->active == 1 ? 'Active' : 'Inactive' }}</span>
                </td>
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('consumers.edit', ['consumer' => $user->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $user->id }})"><i
                            class="fa fa-trash"></i> Delete</button>
                    <a class="dropdown-item" href="{{ route('consumers.point', ['point_id' => $user->id]) }}"><i
                            class="la la-file"></i> Point</a>
                    <a class="dropdown-item" href="{{ route('consumers.badge', ['id' => $user->id]) }}"><i
                    class="fa fa-id-badge"></i> Badges</a>
                    <a class="dropdown-item" href="{{ route('admin.consumer.providers', ['user_id' => $user->id]) }}"><i
                    class="fa fa-map-marker"></i> Providers</a>
                </x-admin.td-action>
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
                        <a class="dropdown-item" href="{{route('consumers.edit', ['consumers' => $user->id])}}" ><i class="la la-edit"></i> Edit</a>
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
        {{ $users->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $users->firstitem() ?? 0 }} to {{ $users->lastitem() ?? 0 }} of {{ $users->total() }}
        entries
    </x-slot>
</x-admin.table>
