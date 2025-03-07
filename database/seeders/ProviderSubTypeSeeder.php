<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProviderType;
use App\Models\ProviderSubType;

class ProviderSubTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeId1 = ProviderType::where('name', 'Residential')->first();
        $typeId2 = ProviderType::where('name', 'Employer')->first();
        $typeId3 = ProviderType::where('name', 'Merchant+')->first();
        $type = [
            [
                'provider_type_id'  =>  $typeId1->id,
                'name'  =>  'Apartment Community'
            ],
            [
                'provider_type_id'  =>  $typeId1->id,
                'name'  =>  'Travel and Tourism'
            ],
            [
                'provider_type_id'  =>  $typeId1->id,
                'name'  =>  'COA/HOA'
            ],
            [
                'provider_type_id'  =>  $typeId1->id,
                'name'  =>  'Others'
            ],
            [
                'provider_type_id'  =>  $typeId1->id,
                'name'  =>  'Membership Providers'
            ],
            [
                'provider_type_id'  =>  $typeId2->id,
                'name'  =>  'Student Housing'
            ],
            [
                'provider_type_id'  =>  $typeId2->id,
                'name'  =>  'Enterprise(corporate)'
            ],
            [
                'provider_type_id'  =>  $typeId3->id,
                'name'  =>  'Restuarent'
            ],

            [
                'provider_type_id'  =>  $typeId3->id,
                'name'  =>  'Gyms/spas'
            ],
            [
                'provider_type_id'  =>  $typeId3->id,
                'name'  =>  'Theme Parks'
            ],
            [
                'provider_type_id'  =>  $typeId3->id,
                'name'  =>  'Auto Shops'
            ],
            [
                'provider_type_id'  =>  $typeId3->id,
                'name'  =>  'Mattresses & Furniture'
            ],


        ];

        foreach ($type as $value) {
            ProviderSubType::create([
                'provider_type_id' => $value['provider_type_id'],
                'name' => $value['name'],
            ]);
        }
    }
}
