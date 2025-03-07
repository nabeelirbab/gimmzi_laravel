<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Log;
use App\Models\MerchantLoyaltyProgram;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoyaltyMemberExport;
use Illuminate\Support\Facades\Storage;
use App\Models\GimmziSendReport;
use Illuminate\Support\Facades\Mail;
use App\Mail\MerchantReportMail;
use App\Models\GeneratedReport;
use App\Models\User;
use App\Exports\RegisteredUserExport;
use App\Models\ItemOrService;
use App\Exports\ItemServiceExport;
use App\Models\ConsumerWallet;
use App\Exports\DealWallerExport;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderBuilding;
use App\Exports\AcceptedBadgeMemberExport;
use App\Mail\PropertyReportMail;
use App\Exports\DeactivateBadgeMemberExport;
use App\Models\Point;
use App\Exports\PointDistributedMemberExport;
use App\Models\PropertyUnderProviderUser;
use App\Exports\CommunityRegisteredUserExport;

class ReportSendHelper
{

    public static function merchantLoyaltyMember($data){
        try {
            $today = date('Y-m-d');
            $loyalty_programs = MerchantLoyaltyProgram::whereHas('consumerLoyalty',function($q){
                                    $q->where('status',1);
                                })
                                ->where('business_profile_id',$data->business_id)
                                ->where('status',1)
                                ->where('end_on','>=',$today)
                                ->orWhere('end_on','=',null)
                                ->get();
            if(count($loyalty_programs) > 0){
                foreach($loyalty_programs as $program){
                    if(count($program->consumerLoyalty) > 0){
                        foreach($program->consumerLoyalty as $consumerdata){
                            $datas[] = array('Member Name' => $consumerdata->consumers->full_name,
                                            'BirthDate' => $consumerdata->consumers->date_of_birth,
                                            'Name Of program' => $program->program_name ,
                                            'Enrollment Date' => date('Y-m-d', strtotime( $consumerdata->join_date )),
                                            'Location Enrolled' => $consumerdata->location->location_name);
                        }
                    }
                }
                 Excel::store(new LoyaltyMemberExport($datas), 'public/export_report/'.$data->consumer->first_name.'_loyalty_members.xlsx','local');
                 $url = Storage::url('export_report/'.$data->consumer->first_name.'_loyalty_members.xlsx');
                //  Log::debug("file :: ".print_r($url, true));
                 $details = array(
                    'name' => $data->consumer->full_name,
                    'report_name' => $data->reporttype->type_name,
                    'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_loyalty_members.xlsx')
                );
                 Mail::to($data->consumer->email)->queue(new MerchantReportMail($details));
                 $report_send = new GimmziSendReport;
                 $report_send->report_id = $data->id;
                 $report_send->send_to_user = $data->generated_by;
                 $report_send->report_doc = $url;
                 $report_send->user_email = $data->consumer->email;
                 $report_send->report_send_date = date('Y-m-d');
                 $report_send->is_send = 1;
                 $report_send->save();
                 if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                    $generated_report = GeneratedReport::find($data->id);
                    $generated_report->is_request_end = 1;
                    $generated_report->save();
                 }

            }
            


        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function merchantRegisteredUser($data){
        try {
            $today = date('Y-m-d');
            $users = User::where('business_id', $data->business_id)
                ->whereNotIn('id', [$data->generated_by])
                ->where('active', 1)
                ->where('created_password', '')
                ->get();
            if(count($users) > 0){
                foreach($users as $userdata){
                    $main_location = $userdata->location->where('is_main',1)->first();
                    if($main_location){
                        $location = $main_location->businessLocation->location_name;
                    }
                    else{
                        $location = '';
                    }
                    $datas[] = array('User Name' => $userdata->full_name,
                                    'Location' => $location,
                                    'Email' => $userdata->email ,
                                    'Phone' => $userdata->phone ,
                                    'Registered Date' => date('Y-m-d', strtotime( $userdata->created_at )),
                                    'Role' => $userdata->user_title);
                }
                Excel::store(new RegisteredUserExport($datas), 'public/export_report/'.$data->consumer->first_name.'_registered_users.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_registered_users.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_registered_users.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new MerchantReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }

        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function merchantItemService($data){
        try {
            $today = date('Y-m-d');
            $items = ItemOrService::where('merchant_id', $data->business_id)
                      ->get();
            if(count($items) > 0){
                foreach($items as $itemdata){
                    $datas[] = array('Item Name' => $itemdata->item_name,
                                     'Item Price' => '$'.$itemdata->item_price,
                                     'Is a Gift' => $itemdata->is_checked ? 'Yes' : 'No' ,
                                     'Date Added' => date('Y-m-d', strtotime( $itemdata->created_at )),
                                     'User Added' => $itemdata->useradded->full_name);
                }
                Excel::store(new ItemServiceExport($datas), 'public/export_report/'.$data->consumer->first_name.'_item_service.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_item_service.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_item_service.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new MerchantReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }

        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function merchantWalletDeal($data){
        try {
            $today = date('Y-m-d');
            $wallets = ConsumerWallet::with('consumer','deal')->where('business_id', $data->business_id)
                      ->where('deal_id','!=',null)
                      ->get();
            if(count($wallets) > 0){
                foreach($wallets as $walletdata){
                    $datas[] = array('Name Of Member' => $walletdata->consumer->full_name,
                                     'Name Of Deal' => '$'.$walletdata->deal->suggested_description,
                                     'Added Date' => date('Y-m-d', strtotime( $walletdata->created_at ))
                                     );
                }
                Excel::store(new DealWallerExport($datas), 'public/export_report/'.$data->consumer->first_name.'_deal_wallet.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_deal_wallet.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_deal_wallet.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new MerchantReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }

        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }


    public static function propertyAcceptedBadgeMember($data){
        try {
            $today = date('Y-m-d');
            $buildingids = ProviderBuilding::where('provider_type_id',$data->property_id)->pluck('id')->toArray();
            $guests = ApartmentGuestBadge::whereHas('badge',function($q) use ($today, $buildingids){
                $q->where('end_date','>=',$today)->whereIn('building_id',$buildingids);
            })->where('status',1)->get();
            if(count($guests) > 0){
                foreach($guests as $badgeguest){
                    $datas[] = array('Member Name' => $badgeguest->user->full_name,
                                    'Start Date' => $badgeguest->badge->start_date,
                                    'End Date' => $badgeguest->badge->end_date ,
                                    'Unit Number' => $badgeguest->badge->buildingunit->unit);
                }
                // Log::debug("data :: ".print_r($datas, true));
                Excel::store(new AcceptedBadgeMemberExport($datas), 'public/export_report/'.$data->consumer->first_name.'_accepted_badge_member.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_accepted_badge_member.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_accepted_badge_member.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new PropertyReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }

        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function propertyDeactivateBadge90Days($data){
        try {
            $today = date('Y-m-d');
            $date = date_add(date_create($today), date_interval_create_from_date_string("90 days"));
            $date90Days = date_format($date, "Y-m-d");

            $buildingids = ProviderBuilding::where('provider_type_id',$data->property_id)->pluck('id')->toArray();
            $guests = ApartmentGuestBadge::whereHas('badge',function($q) use ($today, $buildingids, $date90Days){
                $q->whereBetween('end_date',[$today,$date90Days])->whereIn('building_id',$buildingids);
            })->where('status',1)->get();
            if(count($guests) > 0){
                foreach($guests as $badgeguest){
                    $datas[] = array('Member Name' => $badgeguest->user->full_name,
                                    'End Date' => $badgeguest->badge->end_date ,
                                    'Unit Number' => $badgeguest->badge->buildingunit->unit);
                }
                // Log::debug("data :: ".print_r($datas, true));
                Excel::store(new DeactivateBadgeMemberExport($datas), 'public/export_report/'.$data->consumer->first_name.'_deactivate_badge_member.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_deactivate_badge_member.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_deactivate_badge_member.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new PropertyReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }
        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function propertyPointDistribution($data){
        try {
            $today = date('Y-m-d');

            $buildingids = ProviderBuilding::where('provider_type_id',$data->property_id)->pluck('id')->toArray();
            $point_members = Point::with('userCameFrom','user')->whereIn('property_id',$buildingids)->whereIn('added_for',['resident_recognition','add_point'])->get();
            if(count($point_members) > 0){
                foreach($point_members as $memberData){
                
                    $datas[] = array('Member Name' => $memberData->user->full_name,
                                    'Date Points Sent' => date('Y-m-d', strtotime( $memberData->created_at )) ,
                                    'Amount of Points' => $memberData->point,
                                    'Point Type' => $memberData->added_for,
                                    'Username' => $memberData->userCameFrom->email,
                                   );
                }
                // Log::debug("data :: ".print_r($datas, true));
                Excel::store(new PointDistributedMemberExport($datas), 'public/export_report/'.$data->consumer->first_name.'_point_distributed_member.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_point_distributed_member.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_point_distributed_member.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new PropertyReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }
        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

    public static function propertyRegisteredUser($data){
        try {
            $today = date('Y-m-d');

            $buildingids = ProviderBuilding::where('provider_type_id',$data->property_id)->pluck('id')->toArray();
            $users = PropertyUnderProviderUser::with('title')
                            ->whereHas('provideruser',function ($q){
                                $q->where('created_password',NULL)->where('active',1);
                            })
                            ->where('provider_id',$data->property_id)
                            ->where('title_id','!=',4)
                            ->where('provider_user_id','!=',$data->generated_by)
                            ->get();
            if(count($users) > 0){
                foreach($users as $userData){
                
                    $datas[] = array('Name of user' => $userData->provideruser->full_name,
                                    'Email' => $userData->provideruser->email  ,
                                    'Phone' => $userData->provideruser->phone,
                                    'Registered Date' => date('Y-m-d', strtotime( $userData->created_at )),
                                    'Role' => $userData->title->title_name,
                                   );
                }
                // Log::debug("data :: ".print_r($users, true));
                Excel::store(new CommunityRegisteredUserExport($datas), 'public/export_report/'.$data->consumer->first_name.'_registered_user.xlsx','local');
                $url = Storage::url('export_report/'.$data->consumer->first_name.'_registered_user.xlsx');
               //  Log::debug("file :: ".print_r($url, true));
                $details = array(
                   'name' => $data->consumer->full_name,
                   'report_name' => $data->reporttype->type_name,
                   'file' => storage_path('app/public/export_report/'.$data->consumer->first_name.'_registered_user.xlsx')
               );
                Mail::to($data->consumer->email)->queue(new PropertyReportMail($details));
                $report_send = new GimmziSendReport;
                $report_send->report_id = $data->id;
                $report_send->send_to_user = $data->generated_by;
                $report_send->report_doc = $url;
                $report_send->user_email = $data->consumer->email;
                $report_send->report_send_date = date('Y-m-d');
                $report_send->is_send = 1;
                $report_send->save();
                if(($data->request_as == 'single_request') && ($data->to_date == date('Y-m-d') )){
                   $generated_report = GeneratedReport::find($data->id);
                   $generated_report->is_request_end = 1;
                   $generated_report->save();
                }
            }
        }
        catch (\Throwable $th) {
            Log::debug("ERROR :: ".print_r($th, true));
        }
    }

}
?>