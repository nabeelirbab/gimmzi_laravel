<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProviderType;

class ProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['name'  =>  'Residential' ],
            ['name'  =>  'Employer'],
            ['name'  =>  'Merchant+'],
        ];

        foreach ($type as $value) {
            ProviderType::create([
                'name' => $value['name']
            ]);
        }
    }
}
