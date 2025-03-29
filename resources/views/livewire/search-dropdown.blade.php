<!-- resources/views/livewire/search-dropdown.blade.php -->

<div class="relative" x-data="{ open: @entangle('showDropdown') }" @click.away="open = false">
    {{-- <input wire:model.debounce.300ms="query" type="text"
        class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500"
        placeholder="Search..." @focus="open = true"> --}}
    <input type="text" wire:model.debounce.300ms="query" placeholder="Search businesses..." />
    <div x-show="open" class="absolute z-50 mt-2 w-full bg-white rounded-md shadow-lg">
        <ul class="py-1">
            {{-- @php
                $results = [
                    [
                        'id' => 1,
                        'business_name' => 'Coffee Corner',
                        'business_image' => 'images/coffee-shop.jpg',
                        'business_overview' => 'A cozy place serving premium coffee and pastries',
                    ],
                    [
                        'id' => 2,
                        'business_name' => 'Tech Store',
                        'business_image' => 'images/tech-store.jpg',
                        'business_overview' => 'Latest gadgets and electronics at great prices',
                    ],
                    [
                        'id' => 3,
                        'business_name' => 'Book Haven',
                        'business_image' => 'images/bookstore.jpg',
                        'business_overview' => 'Wide selection of books for all ages',
                    ],
                ];
                $highlightIndex = 0;
            @endphp --}}
            @forelse($results as $index => $result)
                <li wire:click="selectResult({{ $result['id'] }})"
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center {{ $highlightIndex === $index ? 'bg-gray-100' : '' }}">
                    <img src="{{ asset('storage/' . $result['business_image']) }}" alt="{{ $result['business_name'] }}"
                        class="w-10 h-10 object-cover rounded">
                    <div class="ml-3">
                        <div class="font-medium">{{ $result['business_name'] }}</div>
                        <div class="text-sm text-gray-500 truncate">{{ Str::limit($result['business_overview'], 50) }}
                        </div>
                    </div>
                </li>
            @empty
                @if (strlen($query) > 2)
                    <li class="px-4 py-2 text-gray-500">No results found</li>
                @endif
            @endforelse
        </ul>
    </div>
</div>
