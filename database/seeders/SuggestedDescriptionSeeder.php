<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SuggestedDescription;

class SuggestedDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $descriptions = [
            [
                'description'  =>  '$2 OFF SELECT MENU ITEM',
                'status'  =>  true
            ],

            [
                'description'  =>  'FREE MEDIUM FRY',
                'status'  =>  true
            ],
            [
                'description'  =>  '10% OFF ENTREE',
                'status'  =>  true
            ],
            [
                'description'  =>  'BOGO GET ONE 50% OFF',
                'status'  =>  true
            ],
            [
                'description'  =>  '$3 OFF ANY ORDER OFF $15 OR MORE',
                'status'  =>  true
            ],
            [
                'description'  =>  'BUY ONE ENTREE AND GET $5 OFF SECOND ENTREE',
                'status'  =>  true
            ],
            [
                'description'  =>  'DINNER SPECIAL: $10 OFF ANY ORDER $75 OR MORE',
                'status'  =>  true
            ]
        ];

        foreach ($descriptions as $value) {
            SuggestedDescription::create([
                'description' => $value['description'],
                'status' => $value['status'],
            ]);
           
        }
        
    }
}
