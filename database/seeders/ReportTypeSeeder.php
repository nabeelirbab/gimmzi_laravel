<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReportType;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            ['type_name'  =>  'Enrolled Loyalty Members' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Registered Users' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Deals in Wallet' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Transactions (Daily/Weekly/Monthly)' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Loyalty Returns' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Deals and Loyalty Programs' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Most active Gimmzi members' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Most active users' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Punch Card Progress' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Most purchased item' ,'portal' => 'merchant', 'status' => true],
            ['type_name'  =>  'Item and Service Report' ,'portal' => 'merchant', 'status' => true],

            ['type_name'  =>  'Accepted Member Badges' ,'portal' => 'hotel-resort', 'status' => true],
            ['type_name'  =>  'Points Distributed' ,'portal' => 'hotel-resort', 'status' => true],
            ['type_name'  =>  'Top Members' ,'portal' => 'hotel-resort', 'status' => true],
            ['type_name'  =>  'Registered Users' ,'portal' => 'hotel-resort', 'status' => true],

            ['type_name'  =>  'Accepted Member Badges' ,'portal' => 'short-term', 'status' => true],
            ['type_name'  =>  'Points Distributed' ,'portal' => 'short-term', 'status' => true],
            ['type_name'  =>  'Top Members' ,'portal' => 'short-term', 'status' => true],
            ['type_name'  =>  'Registered Users' ,'portal' => 'short-term', 'status' => true],

        ];

        foreach ($type as $value) {
            ReportType::create([
                'type_name' => $value['type_name'],
                'portal' => $value['portal'],
                'status' => $value['status']
            ]);
        }
    }
}
