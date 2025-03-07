<?php

namespace Database\Seeders;

use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserRoleTableSeeder::class);
        // $this->call(UserTableSeeder::class);
        // $this->call(CmsSeeder::class);
        // $this->call(PrivacyPolicySeeder::class);
        // $this->call(TermsAndConditionSeeder::class);
        // $this->call(CouponCategorySeeder::class);
        // $this->call(ProviderTypeSeeder::class);
        // $this->call(ProviderSubTypeSeeder::class);
        // $this->call(BusinessCategorySeeder::class);
        // $this->call(SuggestedDescriptionSeeder::class);
        // $this->call(ServiceTypeSeeder::class);
        // $this->call(RecognitionTypeSeeder::class);
        // $this->call(RecognitionMessageSeeder::class);
       // $this->call(DisplayBoardSeeder::class);
    //    $this->call(MerchantTitleSeeder::class);
       //$this->call(MessageBoardSeeder::class);
      //$this->call(ListingTypeSeeder::class);
    //   $this->call(HotelBuildingsSeeder::class);
    //   $this->call(HotelUnitesSeeder::class);
      // $this->call(HotelBadgesSeeder::class);
      // $this->call(HotelGuestBadgesSeeder::class);
      
      $this->call(ReportTypeSeeder::class);


    }
}
