<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cms;
use App\Models\PrivacyPolicy;

class PrivacyPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmspage = Cms::where('slug', 'privacy_policy_page')->first();
        $cms = [
            
            'cms_id'  =>  $cmspage->id,
            'description'=>  "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."
        ];

      
        PrivacyPolicy::create($cms);
    }
}
