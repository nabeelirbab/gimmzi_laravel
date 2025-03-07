<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelUnites;

class HotelUnitesSeeder extends Seeder
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
                'unit_name' => 'unit 1',  
                'unitId' =>'UNIT/NEW/01'         
            ],[
                'building_id' => '1',
                'unit_name' => 'unit 2',  
                'unitId' =>'UNIT/NEW/02'         
            ],[
                'building_id' => '2',
                'unit_name' => 'unit 3',  
                'unitId' =>'UNIT/NEW/03'         
            ]
            
        ];
        foreach ($datas as $data) {
            HotelUnites::create($data);
        }
    }
}
