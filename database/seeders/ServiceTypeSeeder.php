<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categoryId1 = BusinessCategory::where('category_name', 'Restaurant')->first();
        $categoryId2 = BusinessCategory::where('category_name', 'Gyms/Spas/Wellness')->first();
        $categoryId3 = BusinessCategory::where('category_name', 'Beauty/Care/Salon')->first();
        $categoryId4 = BusinessCategory::where('category_name', 'Theme Parks/Fun')->first();
        $categoryId5 = BusinessCategory::where('category_name', 'Home & Auto Services')->first();
        $categoryId6 = BusinessCategory::where('category_name', 'Goods & Retail')->first();
        $category = [
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'African Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Amercian Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'American Deli Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Bakery'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Bar/Tavern'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Burgers and Fries'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Chinese Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Fast Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Greek Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Hotdog Stand'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Ice Cream Shop'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Indian Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Italian Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Italian Ice'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Jamaican Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Japenese Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Korean Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Mexican Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Peruvian Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Pizza & Subs'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Seafood'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Slushies'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Soul Food'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Southern Cuisine'
            ],
            [
                'category_id' => $categoryId1->id,
                'service_name' => 'Thai Food'
            ],

            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Acupuncture Service'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Chiropractor Service'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Cryotherapy'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Dancing Classes'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Float Tank'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Gym'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Massage Parlor'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Spa'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Spin Class'
            ],
            [
                'category_id' => $categoryId2->id,
                'service_name' => 'Yoga'
            ],

            [
                'category_id' => $categoryId3->id,
                'service_name' => 'Barbershop'
            ],
            [
                'category_id' => $categoryId3->id,
                'service_name' => 'Facial Treatment'
            ],
            [
                'category_id' => $categoryId3->id,
                'service_name' => 'Full Service Beauty Salon'
            ],
            [
                'category_id' => $categoryId3->id,
                'service_name' => 'Hair Salon'
            ],
            [
                'category_id' => $categoryId3->id,
                'service_name' => 'Nail Salon'
            ],

            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Amusement Park'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Arcade'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'ATV Park'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Birthday Parties'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Bouncy House'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Go-Carts'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Haunted House'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Horseback Riding'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Jet Ski Rental'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Laser Tag'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Skiing'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Trampoline Park'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Water Park'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Wax Museum'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Wine and Paint'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Yacht Rental'
            ],
            [
                'category_id' => $categoryId4->id,
                'service_name' => 'Zip Line'
            ],
            
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Auto Parts'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Car Audio'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Car Wash'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Fencing'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Full Auto Shop'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Inspections'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Lawn Service'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Oil Change'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Plumbing Service'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Roofing Service'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Tire Shop'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Window Tinting'
            ],
            [
                'category_id' => $categoryId5->id,
                'service_name' => 'Car Detailing'
            ],
            
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Convenience Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Bicycle Shop'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Furniture Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Gaming'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Grocery Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Kid Clothing Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Mattress Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Outdoors/Hiking'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Shoe Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Sports & Fitness'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Toy Store'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Urban Clothing'
            ],
            [
                'category_id' => $categoryId6->id,
                'service_name' => 'Womens Clothing'
            ],
        ];

        foreach ($category as $value) {
            ServiceType::create([
                'category_id' => $value['category_id'],
                'service_name' => $value['service_name'],
            ]);
           
        }
    }
}
