<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HotelGuestBadges;


class HotelGuestBadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'user_id' => null,
                'badges_id' => '1',  
                'is_resend' =>null,
                'status' =>'1',         
                'point' =>null,         
                'reward_type' =>null,         
                'reward_active_on' =>null,         
                'guest_email' =>'member_one@yopmail.com',         
                'guest_first_name' =>null,         
                'guest_last_name' =>null,
                'zip_code' =>null,         
                'date_of_birth' =>null          
            ],[
                'user_id' => null,
                'badges_id' => '2',  
                'is_resend' =>null,
                'status' =>'1',         
                'point' =>null,         
                'reward_type' =>null,         
                'reward_active_on' =>null,         
                'guest_email' =>'ss@yopmail.com',         
                'guest_first_name' =>null,         
                'guest_last_name' =>null,
                'zip_code' =>null,         
                'date_of_birth' =>null           
            ]
            
        ];
        foreach ($datas as $data) {
            HotelGuestBadges::create($data);
        }
    }
}
