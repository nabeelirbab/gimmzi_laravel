<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelBadges;


class HotelBadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'building_id' => '1',
                'unit_id' => '1',  
                'start_date' =>'2024-07-23',
                'end_date' =>'2024-07-23',         
                'expected_end_date' =>null,
                'status' =>'1'        

            ],[
                'building_id' => '2',
                'unit_id' => '3',  
                'start_date' =>'2024-07-24',
                'end_date' =>'2024-07-25',         
                'expected_end_date' =>null,
                'status' =>'1'        
            ]
            
        ];
        foreach ($datas as $data) {
            HotelBadges::create($data);
        }
    }
}
