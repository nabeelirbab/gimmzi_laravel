<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelBuildings;

class HotelBuildingsSeeder extends Seeder
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
                'hotel_id' => '1',
                'building_name' => 'building 1',  
                'buildingId' =>'BUILDING/NEW/01'         
            ],[
                'hotel_id' => '2',
                'building_name' => 'building 2',  
                'buildingId' =>'BUILDING/NEW/02'         
            ]
            
        ];
        foreach ($datas as $data) {
            HotelBuildings::create($data);
        }
    }
}
