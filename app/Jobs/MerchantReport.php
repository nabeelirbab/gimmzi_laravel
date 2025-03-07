<?php

namespace App\Jobs;

use App\Models\BusinessProfile;
use App\Models\GeneratedReport;
use App\Models\GimmziSendReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Helpers\ReportSendHelper;


class MerchantReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function getSundays($year, $month) {
        $sundays = [];
        
        // Get the first day of the month
        $firstDayOfMonth = strtotime("$year-$month-01");
    
        // Get the first Sunday of the month
        $firstSunday = strtotime('Sunday', $firstDayOfMonth);
    
        // Iterate through the month to find all Sundays
        for ($i = $firstSunday; date('m', $i) == $month; $i = strtotime('+1 week', $i)) {
            $sundays[] = date('Y-m-d', $i);
        }
    
        return $sundays;
    }

    private function getFirstDayOfBiMonthly($date) {
        // Extract the month and year from the provided date
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
    
        // Determine if it's the first half or the second half of the month
        $day = date('d', strtotime($date));
        if ($day <= 15) {
            // If the day is between 1 and 15, return the 1st day of the current month
            return date('Y-m-01', strtotime($date));
        } else {
            // If the day is after the 15th, return the 16th day of the current month
            return date('Y-m-16', strtotime($date));
        }
    }

    private function getFirstDayOfQuarter($date = null) {
        // If no date is provided, use the current date
        $date = $date ?: date('Y-m-d');
        
        // Extract the year and month from the given date
        $year = date('Y', strtotime($date));
        $month = date('n', strtotime($date));
        
        // Determine the quarter based on the month
        if ($month >= 1 && $month <= 3) {
            $startMonth = 1;  // Q1: January - March
        } elseif ($month >= 4 && $month <= 6) {
            $startMonth = 4;  // Q2: April - June
        } elseif ($month >= 7 && $month <= 9) {
            $startMonth = 7;  // Q3: July - September
        } else {
            $startMonth = 10; // Q4: October - December
        }
        
        // Return the first day of the quarter
        return date('Y-m-d', strtotime("$year-$startMonth-01"));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
       $today = date('Y-m-d');
        $this_month = date('m');
        $this_year = date('Y');
        $bimonthlyfirstDay = $this->getFirstDayOfBiMonthly($today);
        $sundays = $this->getSundays($this_year, $this_month);
        $firstSunday = strtotime("first sunday of $this_year-$this_month");
        $secondSunday = strtotime("+1 week", $firstSunday);
        $fourthSunday = strtotime("+3 weeks", $firstSunday);

        $profiles = BusinessProfile::whereHas('reportRequest',function($q){
            $q->where('is_request_end','=', 0);
        })->where('status',1)->get();
        if($profiles){
            foreach($profiles as $bProfile){
                Log::debug("bprofile :: ".print_r($bProfile, true));
                if(count($bProfile->reportRequest) > 0){
                    foreach($bProfile->reportRequest as $request_data){
                        
                        if(($request_data->request_as == 'single_request') && (($request_data->from_date <= date('Y-m-d')) && ($request_data->to_date >= date('Y-m-d')))){
                            if($request_data->type_id == 1){
                                $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                ->where('report_send_date',$today)
                                                ->where('send_to_user',$request_data->generated_by)
                                                ->first();
                                if(!$gimmzi_report){
                                    ReportSendHelper::merchantLoyaltyMember($request_data);
                                }
                            }
                            elseif($request_data->type_id == 2){
                                $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                ->where('report_send_date',$today)
                                                ->where('send_to_user',$request_data->generated_by)
                                                ->first();
                                if(!$gimmzi_report){
                                    Log::debug("request data :: ".print_r($request_data, true));
                                    ReportSendHelper::merchantRegisteredUser($request_data);
                                }
                            }
                            elseif($request_data->type_id == 3){
                                $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                ->where('report_send_date',$today)
                                                ->where('send_to_user',$request_data->generated_by)
                                                ->first();
                                if(!$gimmzi_report){
                                    Log::debug("request data :: ".print_r($request_data, true));
                                    ReportSendHelper::merchantWalletDeal($request_data);
                                }
                            }
                            elseif($request_data->type_id == 11){
                                $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                ->where('report_send_date',$today)
                                                ->where('send_to_user',$request_data->generated_by)
                                                ->first();
                                if(!$gimmzi_report){
                                    Log::debug("request data :: ".print_r($request_data, true));
                                    ReportSendHelper::merchantItemService($request_data);
                                }
                            }
                        }
                        else{
                            if($request_data->send_on == 'monthly'){
                                $monthfirstDay=date('Y-m-d',strtotime("first day of this month"));
                                if($monthfirstDay == $today){
                                    if($request_data->type_id == 1){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->whereMonth('report_send_date',$this_month)
                                                        ->whereYear('report_send_date',$this_year)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 2){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->whereMonth('report_send_date',$this_month)
                                                        ->whereYear('report_send_date',$this_year)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 3){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->whereMonth('report_send_date',$this_month)
                                                        ->whereYear('report_send_date',$this_year)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 11){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->whereMonth('report_send_date',$this_month)
                                                        ->whereYear('report_send_date',$this_year)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            }
                            elseif($request_data->send_on == 'bi_weekly'){
                                if(($today == date('Y-m-d', $secondSunday)) || ($today == date('Y-m-d', $fourthSunday))){
                                    if($request_data->type_id == 1){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 2){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 3){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 11){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            }

                            elseif($request_data->send_on == 'weekly'){
                                if(in_array($today,$sundays)){
                                    if($request_data->type_id == 1){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 2){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 3){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 11){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            }

                            elseif($request_data->send_on == 'bi_monthly'){
                                if($today == $bimonthlyfirstDay){
                                    if($request_data->type_id == 1){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 2){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 3){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 11){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            }

                            elseif($request_data->send_on == 'quarterly'){
                                $firstday = $this->getFirstDayOfQuarter();
                                if($firstday == $today){
                                    if($request_data->type_id == 1){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 2){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 3){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    }
                                    elseif($request_data->type_id == 11){
                                        $gimmzi_report = GimmziSendReport::where('report_id',$request_data->id)
                                                        ->where('report_send_date',$today)
                                                        ->where('send_to_user',$request_data->generated_by)
                                                        ->first();
                                        if(!$gimmzi_report){
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            }
                        }
                        
                    }
                }
            }
        }
    }
}
