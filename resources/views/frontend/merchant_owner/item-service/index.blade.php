<x-layouts.frontend-layout title="Item & Service Page">
    @push('style')
    <style>
        .smart-rental-button ul li:hover {
            color: #fff;
        }

        .errorMsq {
            color: red !important;
            display: block;
        }
        .select2-container {
            z-index: 100000;
        }
        div.pac-container {
            z-index: 1000000 !important;
        }
        </style>
        
    @endpush

    <livewire:frontend.merchant.item-service/>
                
</x-layouts.frontend-layout>