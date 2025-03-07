<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CouponCategory
;

class CouponCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'category_name'  =>  'Restaurants',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Barbershop',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Ice Cream',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Gym/Fitness',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Furniture',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'car/Audio',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Amusement Park',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Salons',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Most Popular',
                'status'  =>  true,
            ],
            [
                'category_name'  =>  'Top Rated',
                'status'  =>  true,
            ]
           
        ];

        foreach ($category as $value) {
            CouponCategory::create([
                'category_name' => $value['category_name'],
                'status' => $value['status'],
            ]);
        }
    }
}
