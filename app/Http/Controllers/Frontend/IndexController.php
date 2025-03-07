<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProviderSubType;
use App\Models\BusinessProfile;
use App\Models\Page;
use Spatie\MediaLibrary\Models\Media;
use App\Models\State;
use App\Models\Provider;
use App\Models\SendRegistrationLink;
use Illuminate\Support\Facades\Session;
use App\Models\GimmziSendReport;
use Illuminate\Support\Facades\Log;
use App\Helpers\ReportSendHelper;
use App\Models\MyFamilyFriend;
use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $register_data = [];
        if (Session::has('register_data')) {
            $register_data = Session::get('register_data');
        }


        $providerType = ProviderSubType::get();
        $businesses = BusinessProfile::withCount('deals')->with('states')->whereHas('deals')->where('status', 1)->get();
        $i = 1;
        $day = array();
        if ($i >= 1 && $i <= 31) {
            for ($i = 1; $i <= 31; $i++) {
                array_push($day, ['value' => $i, 'number' => $i]);
            }
        }
        $year = array();
        $i = 1970;
        if ($i >= 1970 && $i <= date('Y')) {
            for ($i = 1970; $i <= date('Y'); $i++) {
                array_push($year, ['value' => $i, 'number' => $i]);
            }
        }
        $states = State::get();
        $provider = Provider::with('states')->where('status', 1)->get();

        return view('frontend.index', compact('providerType', 'businesses', 'day', 'year', 'states', 'provider', 'register_data'));
    }

    public function explore()
    {
        $register_data = [];
        if (Session::has('register_data')) {
            $register_data = Session::get('register_data');
        }


        $providerType = ProviderSubType::get();
        $i = 1;
        $day = array();
        if ($i >= 1 && $i <= 31) {
            for ($i = 1; $i <= 31; $i++) {
                array_push($day, ['value' => $i, 'number' => $i]);
            }
        }
        $year = array();
        $i = 1970;
        if ($i >= 1970 && $i <= date('Y')) {
            for ($i = 1970; $i <= date('Y'); $i++) {
                array_push($year, ['value' => $i, 'number' => $i]);
            }
        }
        $states = State::get();
        $provider = Provider::with('states')->where('status', 1)->get();
        $page = Page::first();

        return view('frontend.explore', compact('providerType', 'day', 'year', 'states', 'provider', 'register_data', 'page'));
    }

    public function marketUniverse()
    {
        return view('frontend.market-universe');
    }


    function getSundays($year, $month)
    {
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

    function getFirstDayOfBiMonthly($date)
    {
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

    function getFirstDayOfQuarter($date = null)
    {
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

    public function getmerchantreport()
    {
        $today = date('Y-m-d');
        $this_month = date('m');
        $this_year = date('Y');
        $bimonthlyfirstDay = $this->getFirstDayOfBiMonthly($today);
        $sundays = $this->getSundays($this_year, $this_month);
        $firstSunday = strtotime("first sunday of $this_year-$this_month");
        $secondSunday = strtotime("+1 week", $firstSunday);
        $fourthSunday = strtotime("+3 weeks", $firstSunday);

        $profiles = BusinessProfile::whereHas('reportRequest', function ($q) {
            $q->where('is_request_end', '=', 0);
        })->where('status', 1)->get();
        if ($profiles) {
            foreach ($profiles as $bProfile) {
                Log::debug("bprofile :: " . print_r($bProfile, true));
                if (count($bProfile->reportRequest) > 0) {
                    foreach ($bProfile->reportRequest as $request_data) {

                        if (($request_data->request_as == 'single_request') && (($request_data->from_date <= date('Y-m-d')) && ($request_data->to_date >= date('Y-m-d')))) {
                            if ($request_data->type_id == 1) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    ReportSendHelper::merchantLoyaltyMember($request_data);
                                }
                            } elseif ($request_data->type_id == 2) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    Log::debug("request data :: " . print_r($request_data, true));
                                    ReportSendHelper::merchantRegisteredUser($request_data);
                                }
                            } elseif ($request_data->type_id == 3) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    Log::debug("request data :: " . print_r($request_data, true));
                                    ReportSendHelper::merchantWalletDeal($request_data);
                                }
                            } elseif ($request_data->type_id == 11) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    Log::debug("request data :: " . print_r($request_data, true));
                                    ReportSendHelper::merchantItemService($request_data);
                                }
                            }
                        } else {
                            if ($request_data->send_on == 'monthly') {
                                $monthfirstDay = date('Y-m-d', strtotime("first day of this month"));
                                if ($monthfirstDay == $today) {
                                    if ($request_data->type_id == 1) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 2) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    } elseif ($request_data->type_id == 3) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    } elseif ($request_data->type_id == 11) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'bi_weekly') {
                                if (($today == date('Y-m-d', $secondSunday)) || ($today == date('Y-m-d', $fourthSunday))) {
                                    if ($request_data->type_id == 1) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 2) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    } elseif ($request_data->type_id == 3) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    } elseif ($request_data->type_id == 11) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'weekly') {
                                if (in_array($today, $sundays)) {
                                    if ($request_data->type_id == 1) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 2) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    } elseif ($request_data->type_id == 3) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    } elseif ($request_data->type_id == 11) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'bi_monthly') {
                                if ($today == $bimonthlyfirstDay) {
                                    if ($request_data->type_id == 1) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 2) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    } elseif ($request_data->type_id == 3) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    } elseif ($request_data->type_id == 11) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantItemService($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'quarterly') {
                                $firstday = $this->getFirstDayOfQuarter();
                                if ($firstday == $today) {
                                    if ($request_data->type_id == 1) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantLoyaltyMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 2) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantRegisteredUser($request_data);
                                        }
                                    } elseif ($request_data->type_id == 3) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::merchantWalletDeal($request_data);
                                        }
                                    } elseif ($request_data->type_id == 11) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
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


    public function getapartmentreport()
    {
        // $today = date_create('2024-08-25');
        // $today = date_format($today,'Y-m-d');
        $today = date('Y-m-d');
        $this_month = date('m');
        $this_year = date('Y');
        $bimonthlyfirstDay = $this->getFirstDayOfBiMonthly($today);
        $sundays = $this->getSundays($this_year, $this_month);
        $firstSunday = strtotime("first sunday of $this_year-$this_month");
        $secondSunday = strtotime("+1 week", $firstSunday);
        $fourthSunday = strtotime("+3 weeks", $firstSunday);

        $providers = Provider::whereHas('reportRequest', function ($q) {
            $q->where('is_request_end', '=', 0);
        })->where('status', 1)->get();
        if ($providers) {
            foreach ($providers as $property) {
                // Log::debug("property :: ".print_r($property, true));
                if (count($property->reportRequest) > 0) {
                    foreach ($property->reportRequest as $request_data) {

                        if (($request_data->request_as == 'single_request') && (($request_data->from_date <= date('Y-m-d')) && ($request_data->to_date >= date('Y-m-d')))) {
                            if ($request_data->type_id == 20) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                }
                            } elseif ($request_data->type_id == 21) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    // Log::debug("request data :: ".print_r($request_data, true));
                                    ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                }
                            } elseif ($request_data->type_id == 22) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    // Log::debug("request data :: ".print_r($request_data, true));
                                    ReportSendHelper::propertyPointDistribution($request_data);
                                }
                            } elseif ($request_data->type_id == 24) {
                                $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                    ->where('report_send_date', $today)
                                    ->where('send_to_user', $request_data->generated_by)
                                    ->first();
                                if (!$gimmzi_report) {
                                    Log::debug("request data :: " . print_r($request_data, true));
                                    ReportSendHelper::propertyRegisteredUser($request_data);
                                }
                            }
                        } else {
                            if ($request_data->send_on == 'monthly') {
                                $monthfirstDay = date('Y-m-d', strtotime("first day of this month"));
                                if ($monthfirstDay == $today) {
                                    if ($request_data->type_id == 20) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 21) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                        }
                                    } elseif ($request_data->type_id == 22) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyPointDistribution($request_data);
                                        }
                                    } elseif ($request_data->type_id == 24) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->whereMonth('report_send_date', $this_month)
                                            ->whereYear('report_send_date', $this_year)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyRegisteredUser($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'bi_weekly') {
                                if (($today == date('Y-m-d', $secondSunday)) || ($today == date('Y-m-d', $fourthSunday))) {
                                    if ($request_data->type_id == 20) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 21) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                        }
                                    } elseif ($request_data->type_id == 22) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyPointDistribution($request_data);
                                        }
                                    } elseif ($request_data->type_id == 24) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyRegisteredUser($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'weekly') {
                                if (in_array($today, $sundays)) {
                                    if ($request_data->type_id == 20) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 21) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                        }
                                    } elseif ($request_data->type_id == 22) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyPointDistribution($request_data);
                                        }
                                    } elseif ($request_data->type_id == 24) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyRegisteredUser($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'bi_monthly') {
                                if ($today == $bimonthlyfirstDay) {
                                    if ($request_data->type_id == 20) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 21) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                        }
                                    } elseif ($request_data->type_id == 22) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyPointDistribution($request_data);
                                        }
                                    } elseif ($request_data->type_id == 24) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyRegisteredUser($request_data);
                                        }
                                    }
                                }
                            } elseif ($request_data->send_on == 'quarterly') {
                                $firstday = $this->getFirstDayOfQuarter();
                                if ($firstday == $today) {
                                    if ($request_data->type_id == 20) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyAcceptedBadgeMember($request_data);
                                        }
                                    } elseif ($request_data->type_id == 21) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyDeactivateBadge90Days($request_data);
                                        }
                                    } elseif ($request_data->type_id == 22) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyPointDistribution($request_data);
                                        }
                                    } elseif ($request_data->type_id == 24) {
                                        $gimmzi_report = GimmziSendReport::where('report_id', $request_data->id)
                                            ->where('report_send_date', $today)
                                            ->where('send_to_user', $request_data->generated_by)
                                            ->first();
                                        if (!$gimmzi_report) {
                                            ReportSendHelper::propertyRegisteredUser($request_data);
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


    public function getshorttermreport()
    {
        $today = date('Y-m-d');
        $this_month = date('m');
        $this_year = date('Y');
        $bimonthlyfirstDay = $this->getFirstDayOfBiMonthly($today);
        $sundays = $this->getSundays($this_year, $this_month);
        $firstSunday = strtotime("first sunday of $this_year-$this_month");
        $secondSunday = strtotime("+1 week", $firstSunday);
        $fourthSunday = strtotime("+3 weeks", $firstSunday);
    }

    public function consumerInvitation($id)
    {
        if (session()->has('consumerId')) {
            session()->forget('consumerId');
        }
        if (session()->has('type')) {
            session()->forget('type');
        }

        $user_id = base64_decode($id);
        $consumer = User::find($user_id);

        if (Auth::user() && Auth::user()->role_name = 'CONSUMER') {
            $alreadyinvite = MyFamilyFriend::where('invited_by', $consumer->id)->get();
            return redirect()->route('frontend.index');
        } else {
            Session::put('type', 'consumer_invitation');
            Session::put('consumerId', $user_id);
            Session::put('invitation_redirect_url', route('frontend.consumer.invitation-checking', $id));
            Session::put('register_data', 1);

            return redirect()->route('frontend.index')->withError('Please fill up the page.');
        }
    }



    public function consumerEmailCheck(Request $request)
    {
        if ($request->ajax()) {
            if ($request->email != null) {
                $user = User::where('email', $request->email)->role('CONSUMER')->first();
                if ($user) {
                    $sessionConId = Session::get('consumerId');
                    $alreadyAdded = MyFamilyFriend::where('invited_by', $sessionConId)->where('getting_point', 0)->get();
                    $alreadyAddedEmail = MyFamilyFriend::where('invited_by', $sessionConId)->where('consumer_id', $user->id)->first();
                    if (!$alreadyAddedEmail) {
                        if ($alreadyAdded) {
                            if ($alreadyAdded && $alreadyAdded->count() == 10) {
                                foreach ($alreadyAdded as $adduser) {
                                    $adduser->getting_point = 1;
                                    $adduser->save();
                                }
                                $invitedUser = User::find($sessionConId);
                                Point::create([
                                    'user_id' => $invitedUser->id,
                                    'point' => 25,
                                    'sign' => '+'
                                ]);
                            }
                        }
                        $newMyFriendFamily = new MyFamilyFriend();
                        $newMyFriendFamily->consumer_id = $user->id;
                        $newMyFriendFamily->invited_by = $sessionConId;
                        $newMyFriendFamily->type = 'existing';
                        $newMyFriendFamily->getting_point = 0;
                        $newMyFriendFamily->save();
                    }

                    return response()->json(['status' => 1, 'message' => 'You are already registered as a Consumer. Please login to continue']);
                } else {
                    return response()->json(['status' => 0, 'message' => 'Please fill up the form']);
                }
            } else {
                return response()->json(['status' => 2, 'message' => 'Email required']);
            }
        }
    }
}
