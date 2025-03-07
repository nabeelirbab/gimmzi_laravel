<x-layouts.consumer-layout title="Consumer Dashboard">

    <livewire:frontend.consumer.dashboard/>

    
 

        @push('scripts')
            <script>
                $(document).ready(function() {
                   
                    if(sessionStorage.getItem("get_page") == 'travel_website_page'){
                        sessionStorage.removeItem("get_page");
                        location.href = "<?php echo url('/travel-and-tourism');?>";
                    }
                    if(sessionStorage.getItem("get_page") == 'short_term_website_page'){
                        sessionStorage.removeItem("get_page");
                        var pageid = sessionStorage.getItem("get_page_id");
                        location.href = "<?php echo url('/short-term-rental-website/"+pageid+"');?>";
                    }
                    
                    $(".show_map").on('click', function() {
                        // console.log('hi');
                        $('.smart_reward_deal').hide();
                        $('.smart_reward_map').show();
                    });

                    $(".show_reward").on('click', function() {
                        // console.log('hi');
                        $('.smart_reward_deal').show();
                        $('.smart_reward_map').hide();
                    });

                });
            </script>
        @endpush
</x-layouts.consumer-layout>
