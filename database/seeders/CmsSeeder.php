<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cms = [
            [
                'name'  =>  'Privacy Policy Page',
                'slug'  =>  'privacy_policy_page',
            ],
            [
                'name'  =>  'Terms and Condition Page',
                'slug'  =>  'terms_and_condition_page',
            ]
           
        ];

        foreach ($cms as $value) {
            Cms::create([
                'name' => $value['name'],
                'slug' => $value['slug'],
            ]);
        }
    }
}
