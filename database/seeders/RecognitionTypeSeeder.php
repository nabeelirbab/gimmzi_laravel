<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecognitionType;

class RecognitionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['type_name'  =>  'Tenant of the month' , 'status' => true],
            ['type_name'  =>  '100% Pass Inspection', 'status' => true],
            ['type_name'  =>  'Because You Are A Great Tenant', 'status' => true],
            ['type_name'  =>  'Community Helper', 'status' => true],
            ['type_name'  =>  'Community Leader', 'status' => true],
            ['type_name'  =>  'Good Samaritan', 'status' => true],
        ];

        foreach ($type as $value) {
            RecognitionType::create([
                'type_name' => $value['type_name'],
                'status' => $value['status']
            ]);
        }
    }
}
