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


            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"
                aria-sort="ascending">User Name <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('user_name')"></i>
            </th>

            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 18%;">Subject <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer;"
                    wire:click="sortBy('subject')"></i>
            </th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 17%;">Is Closed <i class="fa fa-fw fa-sort pull-right" style="cursor: pointer"
                    wire:click="sortBy('is_closed')"></i>
            </th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Issue Create On</th>

            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">
            <th>
                <x-admin.input type="search" wire:model.defer="searchUserName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>

            <th>
                <x-admin.input type="search" wire:model.defer="searchSubject" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>

            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchIsClosed"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="1">Open</option>
                    <option value="0">Closed</option>
                    <option value="2">Reopen</option>
                </select>
            </th>
            <th>
               
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
        @forelse($troubleTickets as $troubleTicket)
        <tr role="row" class="odd">
            <td class="sorting_1 align-center" tabindex="0">
                <div class="kt-user-card-v2">
                    <div class="kt-user-card-v2__pic">
                        <div class="kt-badge kt-badge--xl kt-badge--{{ $this->getRandomColor() }}">
                            <span>{{ substr($troubleTicket->user->first_name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="kt-user-card-v2__details">
                        <span class="kt-user-card-v2__name">{{ $troubleTicket->user->full_name }}</span>
                    </div>
                </div>
            </td>
            <td class="align-center">{{ $troubleTicket->subject}}</td>
            <td class="align-center">
                @if($troubleTicket->is_closed == 1)
                    <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill cursor-pointer"
                    wire:click="changeStatusConfirm({{ $troubleTicket->id }})">Open</span>
                @elseif($troubleTicket->is_closed == 0)
                    <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill cursor-pointer"
                    wire:click="changeStatusConfirm({{ $troubleTicket->id }})">Closed</span>
                @else
                    <span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill cursor-pointer"
                    wire:click="changeStatusConfirm({{ $troubleTicket->id }})">Reopen</span>
                @endif

            </td>
            <?php 
                $date=date_create($troubleTicket->user->created_at);
                $create_date=date_format($date,'d-m-Y');
            ?>
        <td class="align-center">{{ $create_date }}</td>

            <x-admin.td-action>
                <a class="dropdown-item" href="{{ route('supports.edit', ['support' => $troubleTicket->id]) }}"><i
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
        {{ $troubleTickets->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $troubleTickets->firstitem() ?? 0 }} to {{ $troubleTickets->lastitem() ?? 0 }} of {{
        $troubleTickets->total() }} entries
    </x-slot>
</x-admin.table>