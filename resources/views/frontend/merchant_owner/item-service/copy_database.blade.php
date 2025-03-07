<x-layouts.frontend-layout title="Business Owners Account Page">
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
        div.copyclass{
            padding: 69px;
        }
        h3.user_main_location{
            margin-bottom: 19px;
        }
        div.copy-button-class{
            border-top: 1px solid #0000001a;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-end;
            padding: 0.75rem;
            border-bottom-right-radius: calc(0.3rem - 1px);
            border-bottom-left-radius: calc(0.3rem - 1px);
        }
       
        </style>
        
    @endpush

    <livewire:frontend.merchant.item-service-copy/>
                
</x-layouts.frontend-layout>