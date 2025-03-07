<?php

namespace Database\Seeders;

use App\Models\ListingType;
use Illuminate\Database\Seeder;

class ListingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $listingType=['Condo','House','Multiplex','Other'];
        foreach ($listingType as $key => $listingType) {
            ListingType::create(['name' => $listingType,'status' => true]);
        }
    }
}
