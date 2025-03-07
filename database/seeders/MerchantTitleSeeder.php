<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MerchantTitle;

class MerchantTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merchantTitles=['Owner','Part Owner','Manager','Regional Manager'];
        foreach ($merchantTitles as $key => $merchantTitle) {
            MerchantTitle::create(['business_title' => $merchantTitle,'status' => true]);
        }
    }
}
