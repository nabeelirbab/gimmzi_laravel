<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MessageBoard;

class MessageBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $msg_boards = [
            // [
            //     'title'  =>  'Inspection Due Date',
            //     'make_public' => false,
            //     'tenant_only' =>true,
            //     'status'  =>  true,
            // ],
            // [
            //     'title'  =>  'Need To Know',
            //     'make_public' => false,
            //     'tenant_only' =>true,
            //     'status'  =>  true
            // ],
            // [
            //     'title'  =>  'Upcoming Community Events',
            //     'make_public' => false,
            //     'tenant_only' =>true,
            //     'status'  =>  true
            // ],
            // [
            //     'title'  =>  'Rent Specials for New Tenants',
            //     'make_public' => true,
            //     'tenant_only' =>false,
            //     'status'  =>  true
            // ],
            // [
            //     'title'  =>  'Announcements',
            //     'make_public' => true,
            //     'tenant_only' =>false,
            //     'status'  =>  true
            // ],
            // [
            //     'title'  =>  'Upcoming Events',
            //     'make_public' => true,
            //     'tenant_only' =>false,
            //     'status'  =>  true
            // ],
            [
                'title'  =>  'Featured Listing',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_short_term_rental',
            ],
            [
                'title'  =>  'Announcements',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_short_term_rental',
            ],
            [
                'title'  =>  'Need To Know',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_short_term_rental',
            ],
            [
                'title'  =>  'Upcoming Events',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_short_term_rental',
            ],
            [
                'title'  =>  'Local Specials',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_hotel',
            ],
            [
                'title'  =>  'Announcements',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_hotel',
            ],
            [
                'title'  =>  'Need To Know',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_hotel',
            ],
            [
                'title'  =>  'Upcoming Events',
                'make_public' => false,
                'tenant_only' =>false,
                'status'  =>  true,
                'travel_tourism_type' => 'for_hotel',
            ],

        ];

        foreach ($msg_boards as $value) {
            MessageBoard::create([
                'title' => $value['title'],
                'make_public' => $value['make_public'],
                'tenant_only' => $value['tenant_only'],
                'status' => $value['status'],
                'travel_tourism_type' => $value['travel_tourism_type'],
            ]);
           
        }
        
    }
}
