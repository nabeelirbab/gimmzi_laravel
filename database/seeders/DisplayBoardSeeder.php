<?php

namespace Database\Seeders;

use App\Models\DisplayBoard;
use Illuminate\Database\Seeder;

class DisplayBoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $display = [
            ['title'  =>  'Weekly Specials' ],
            ['title'  =>  'New Location Added'],
            ['title'  =>  'Upcoming Events'],
            ['title'  =>  'Announcements'],
        ];

        foreach ($display as $value) {
            DisplayBoard::create([
                'title' => $value['title']
            ]);
        }
    }
}
