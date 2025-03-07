<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecognitionType;
use App\Models\RecognitionMessage;

class RecognitionMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = RecognitionType::where('type_name','Tenant of the month')->first();
        $type2 = RecognitionType::where('type_name','100% Pass Inspection')->first();
        $type3 = RecognitionType::where('type_name','Because You Are A Great Tenant')->first();
        $type4 = RecognitionType::where('type_name','Community Helper')->first();
        $type5 = RecognitionType::where('type_name','Community Leader')->first();
        $type6 = RecognitionType::where('type_name','Good Samaritan')->first();
     
        $messages = [
            [
                'type_id'  =>  $type1->id,
                'message'  =>  'Congratulations [Tenant First Name], you have earned Tenant of The Month. You have been a great asset to the community and [Apartment Community] would like to recognize you with the highest recognition.'
            ],
            [
                'type_id'  =>  $type2->id,
                'message'  =>  'Congratulations [Tenant First Name], you have earned a 100% Pass Inspection. [Apartment Community Name] have added [number of points] to your Smart Rental account. Enjoy!'
            ],

            [
                'type_id'  =>  $type3->id,
                'message'  =>  'Congratulations [Tenant First Name], [Apartment Community Name] would like to send you [number of points] simply because you are a great tenant. Enjoy!'
            ],
            [
                'type_id'  =>  $type4->id,
                'message'  =>  'Congratulations [Tenant First Name], [Apartment Community Name] would like to thank you for your help. It is greatly appreciated and here is [number of points] for your contribution. Enjoy!'
            ],
            [
                'type_id'  =>  $type5->id,
                'message'  =>  'Congratulations [Tenant First Name], [Apartment Community Name] would like to thank you for showing your leadership within the community. It is greatly appreciated and here is [number of points] to show our appreciation. Enjoy!'
            ],
            [
                'type_id'  =>  $type6->id,
                'message'  =>  'Congratulations [Tenant First Name], [Apartment Community Name] would like to thank you for showing exemplary character and being the example of a model citizen within the community. It is greatly appreciated and here is [number of points] to show our appreciation. Enjoy!'
            ]
        ];

        foreach ($messages as $value) {
            RecognitionMessage::create([
                'type_id' => $value['type_id'],
                'message' => $value['message'],
                'status'  => true
            ]);
        }


    }
}
