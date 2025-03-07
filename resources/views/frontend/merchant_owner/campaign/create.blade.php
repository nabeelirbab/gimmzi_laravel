<x-layouts.frontend-layout title="Campaign Management Page">
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
        thead tr th {
            position: sticky;
            top: 0;
        }
        th{
            border-left: 1px dotted rgba(200, 209, 224, 0.6);
            border-bottom: 1px solid #e8e8e8;
            background: #c5c7c3;
        }
        </style>
        
    @endpush

    <livewire:frontend.merchant.create-campaign/>
                
</x-layouts.frontend-layout>