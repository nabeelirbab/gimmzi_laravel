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
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 20%;" aria-label="Status: activate to sort column ascending" class="align-center">Business Name<i
                    class="fa fa-fw fa-sort pull-right" style="cursor: pointer;" wire:click="sortBy('business_name')"></i>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 15%;"  aria-sort="ascending" class="align-center">Category</th>
            <th tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1" style="width: 12%;"class="align-center">Service Type</th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"style="width: 15%;" >Merchant Type</th>
            <th class="align-center" tabindex="0" aria-controls="kt_table_1" rowspan="1" colspan="1"
                style="width: 15%;" aria-label="Status: activate to sort column ascending">Status</th>
            <th class="align-center" rowspan="1" colspan="1" style="width: 20%;" aria-label="Actions">Actions</th>
        </tr>

        <tr class="filter">

            <th>
                <x-admin.input type="search" wire:model.defer="searchBusinessName" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <x-admin.input type="search" wire:model.defer="searchCategory" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
           
            <th>
                <x-admin.input type="search" wire:model.defer="searchServiceType" placeholder="" autocomplete="off"
                    class="form-control-sm form-filter" />
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchMerchantType"
                    title="Select" data-col-index="2">
                    <option value=" ">Select One</option>
                    <option value="Plus">Plus</option>
                    <option value="Basic">Basic</option>
                    <option value="Intro">Intro</option>
                    <option value="G1 Bundle">G1 Bundle</option>
                    <option value="G2 Bundle">G2 Bundle</option>
                </select>
            </th>
            <th>
                <select class="form-control form-control-sm form-filter kt-input" wire:model.defer="searchStatus"
                    title="Select" data-col-index="2">
                    <option value="-1">Select One</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                    <option value="2">Pending Approval</option>
                    <option value="3">Does not meet Merchant Guidelines</option>
                    <option value="4">Saved</option>
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
        @forelse($businesses as $data)
            <tr role="row" class="odd">
                <td class="align-center" >{{ $data->business_name }}({{$data->businessId}})</td> 
                @if($data->business_category_id != '')       
                  <td class="align-center">{{ $data->category->category_name }}</td>   
                @else
                  <td class="align-center">-</td>
                @endif
                @if($data->service_type_id != '')            
                  <td class="align-center">{{ $data->service->service_name }}</td>
                @else
                  <td class="align-center">-</td>
                @endif
                <td class="align-center">
                    @if($data->merchant_type == 'Plus')
                       <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeTypeConfirm({{ $data->id }})" >Plus</span>
                    @elseif($data->merchant_type == 'Basic')    
                        <span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeTypeConfirm({{ $data->id }})" >Basic</span>
                    @elseif($data->merchant_type == 'Intro')    
                        <span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeTypeConfirm({{ $data->id }})" >Intro</span>
                    @elseif($data->merchant_type == 'G1 Bundle')   
                        <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeTypeConfirm({{ $data->id }})" >G1 Bundle</span> 
                    @elseif($data->merchant_type == 'G2 Bundle')  
                        <span class="kt-badge  kt-badge--primary kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeTypeConfirm({{ $data->id }})" style="background: #b50000;">G2 Bundle</span> 
                        
                    @endif
                </td>
                <td class="align-center">
                    @if($data->status == 1)
                    <span class="kt-badge  kt-badge--success kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeStatusConfirm({{ $data->id }})">Active</span>
                    @elseif($data->status == 2)
                    <span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill cursor-pointer">Pending Approval</span>
                    @elseif($data->status == 3)
                    <span class="kt-badge  kt-badge--info kt-badge--inline kt-badge--pill cursor-pointer"  style="display: inherit">Does not meet Merchant Guidelines</span>
                    @elseif($data->status == 4)
                    <span class="kt-badge  kt-badge--warning kt-badge--inline kt-badge--pill cursor-pointer" style="background: #b80abb; color: #fff;">Saved</span>
                    @else
                    <span class="kt-badge  kt-badge--danger kt-badge--inline kt-badge--pill cursor-pointer"
                        wire:click="changeStatusConfirm({{ $data->id }})">Inactive</span>
                    @endif
                </td>
                <x-admin.td-action>
                    <a class="dropdown-item" href="{{ route('business-profile.edit', ['business_profile' => $data->id]) }}"><i
                            class="la la-edit"></i> Edit</a>
                    <button href="#" class="dropdown-item" wire:click="deleteAttempt({{ $data->id }})"><i class="fa fa-trash"></i> Delete</button>

                </x-admin.td-action>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="align-center">No records available</td>
            </tr>
        @endforelse

        
    </x-slot>
    <x-slot name="pagination">
        {{ $businesses->links() }}
    </x-slot>
    <x-slot name="showingEntries">
        Showing {{ $businesses->firstitem() ?? 0 }} to {{ $businesses->lastitem() ?? 0 }} of {{ $businesses->total() }}
        entries
    </x-slot>
</x-admin.table>
