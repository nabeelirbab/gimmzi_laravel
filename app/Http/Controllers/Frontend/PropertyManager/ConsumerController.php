<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Hash;
use App\Models\ConsumerUnit;
use App\Models\BuildingUnit;
use App\Models\ApartmentGuestBadge;
use App\Models\SendRegistrationLink;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegistrationLinkMail;
use App\Models\ProviderBuilding;
use Twilio\Rest\Client;
use App\Service\Twilio\PhoneNumberLookupService;
use Illuminate\Support\Facades\Validator;
use App\Rules\PhoneNumber;
use App\Models\ProviderLimitSetting;
use App\Models\Point;
use App\Models\User;
use App\Models\Provider;
use App\Models\RecognitionType;
use App\Models\PropertyUnderProviderUser;
use App\Models\ProviderTenantRecognition;
use App\Models\ProviderRecognitionUser;



class ConsumerController extends Controller
{
    
    public function viewProfile($id){
        // $conUnit = ConsumerUnit::with('consumers','providerBuilding','buildingunit')->find($id);
        // $conUnit = ApartmentGuestBadge::with('user','badge.building','badge.buildingunit')->where('user_id',$id)->orderBy('id','DESC')->first();
        // $unitid = $conUnit->badge->unit_id;
        // $consumer_unit = ApartmentGuestBadge::with('user')->where('badges_id',$conUnit->badges_id)->whereNotIn('user_id',[$id])->get();
        // //$buildingUnit = BuildingUnit::with('buildings','consumerunits')->find($unitid);
        // $recognitions = RecognitionType::where('status',1)->get();
        return view('frontend.property-manager.consumer_account_view', compact('id') );
    }

    public function deactiveconsumerProfile(Request $request){
        if($request->ajax()){
            $consumer_unit = ConsumerUnit::find($request->conunit_id);
            if($consumer_unit){
               $uinitid = $consumer_unit->unit_id;
               $consumer_unit->delete();
               $unit = ConsumerUnit::where('unit_id',$uinitid)->first();
               if($unit){
                return response()->json(['status'=>1,'data' => $unit->id,'message'=>'Consumer deactivate',"redirect_url"=>url('view-consumer-profile')]);
               }
               else{
                return response()->json(['status'=>2,'data' => '','message'=>'Consumer deactivate but no consumer are there',"redirect_url"=>url('smart-rental-db')]);
               }
               
            }
            else{
                return response()->json(['status'=>0,'message'=>'Consumer not found']);
            }

        }
    }

    public function sendRegistrationLink(Request $request){
        if($request->ajax()){
           // $code = rand('1000','9999');
            if($request->flag == 'consumer_unit'){
                $consumer_unit = ConsumerUnit::find($request->conunit_id);
                $bunit = BuildingUnit::find($consumer_unit->unit_id);
                $building = ProviderBuilding::find($bunit->building_id);
                $full_name = $request->first_name.' '.$request->last_name;
                if($request->sent_by == 'email'){
                    $sendlink = new SendRegistrationLink;
                    $sendlink->first_name = $request->first_name;
                    $sendlink->last_name = $request->last_name;
                    $sendlink->is_email = 1;
                    $sendlink->is_phone = 0;
                    $sendlink->link_send_on = $request->link_Sent_on;
                    $sendlink->provider_user_id = Auth::user()->id;
                    $sendlink->provider_id = $consumer_unit->provider_type_id;
                    $sendlink->access_code = $bunit->access_code;
                    $sendlink->unit_id = $consumer_unit->unit_id;
                    $sendlink->save();
                    if($sendlink){
                        $url = url('consumer-registration');
                        $details = [
                            'name' => $full_name,
                            'url' => $url,
                            'code' => $bunit->access_code,
                            'unit' => $bunit->unit,
                            'building' => $building->building_name
                        ];
                        Mail::to($request->link_Sent_on)->queue(new SendRegistrationLinkMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['status'=>2,'message'=>'link sent by email']);
                        }
                        else{
                            return response()->json(['status'=>1,'message'=>'link saved but not sent by email']);
                        }
                    }
                    else{
                        return response()->json(['status'=>0,'message'=>'link not saved']);

                    }
                }
                elseif($request->sent_by == 'phone'){
                    $request['link_Sent_on'] = str_replace('-', '', $request->link_Sent_on); 
                    $validator  =   Validator::make($request->all(), [
                        "link_Sent_on"  =>  "unique:users,phone|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/"]);

                    if($validator->fails()) {
                        return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                    }
                    $url = url('consumer-registration');
                    $body = 'Hello, '.$full_name.", We are gladly invited to Gimmzi Smart Reward Apartment Community. One of our property manager is sent you registration link. Your building detail is :-  "."\n".
                                " Building:- ".$building->building_name."\n".
                                " Unit :- ".$bunit->unit."\n".
                                " Access-code:- ".$bunit->access_code."\n".
                                " To register in our site , please click on this link :- \n".$url;
                    $sms = $this->sendMessage($body, $request->link_Sent_on);
                    
                    //return response()->json(['status'=>$sms]);
                        if($sms == true){
                            $sendlink = new SendRegistrationLink;
                            $sendlink->first_name = $request->first_name;
                            $sendlink->last_name = $request->last_name;
                            $sendlink->is_email = 0;
                            $sendlink->is_phone = 1;
                            $sendlink->link_send_on = $request->link_Sent_on;
                            $sendlink->provider_user_id = Auth::user()->id;
                            $sendlink->provider_id = $consumer_unit->provider_type_id;
                            $sendlink->access_code = $bunit->access_code;
                            $sendlink->unit_id = $consumer_unit->unit_id;
                            $sendlink->save();
                            if($sendlink){
                                return response()->json(['status'=>3,'message'=>'link saved']);
                            }
                            else{
                                return response()->json(['status'=>0,'message'=>'link not saved']);
                            }
                        }
                        else{
                            return response()->json(['status'=>4,'message'=>'please give correct phone no']);
                        }
                    
                }
            }
            elseif($request->flag == 'unit'){
                $bunit = BuildingUnit::find($request->unit_id);
                // return response()->json(['status' => $bunit ]);
                $building = ProviderBuilding::find($bunit->building_id);
                $full_name = $request->first_name.' '.$request->last_name;
                if($request->sent_by == 'email'){
                    $sendlink = new SendRegistrationLink;
                    $sendlink->first_name = $request->first_name;
                    $sendlink->last_name = $request->last_name;
                    $sendlink->is_email = 1;
                    $sendlink->is_phone = 0;
                    $sendlink->link_send_on = $request->link_Sent_on;
                    $sendlink->provider_user_id = Auth::user()->id;
                    $sendlink->provider_id = $bunit->provider_id;
                    $sendlink->access_code = $bunit->access_code;
                    $sendlink->unit_id = $bunit->id;
                    $sendlink->save();
                    if($sendlink){
                        $url = url('consumer-registration');
                        $details = [
                            'name' => $full_name,
                            'url' => $url,
                            'code' => $bunit->access_code,
                            'unit' => $bunit->unit,
                            'building' => $building->building_name
                        ];
                        Mail::to($request->link_Sent_on)->queue(new SendRegistrationLinkMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['status'=>2,'message'=>'link sent by email']);
                        }
                        else{
                            return response()->json(['status'=>1,'message'=>'link saved but not sent by email']);
                        }
                    }
                    else{
                        return response()->json(['status'=>0,'message'=>'link not saved']);

                    }
                }
                elseif($request->sent_by == 'phone'){
                    $request['link_Sent_on'] = str_replace('-', '', $request->link_Sent_on); 
                    $validator  =   Validator::make($request->all(), [
                        "link_Sent_on"  =>  "unique:users,phone|regex:/^\+(?:[0-9] ?){6,14}[0-9]$/"]);

                    if($validator->fails()) {
                        return response()->json(["status" => 9, "validation_errors" => $validator->errors()->first()]);
                    }
                    $url = url('consumer-registration');
                    $body = 'Hello, '.$full_name.", We are gladly invited to Gimmzi Smart Reward Apartment Community. One of our property manager is sent you registration link. Your building detail is :-  "."\n".
                                " Building:- ".$building->building_name."\n".
                                " Unit :- ".$bunit->unit."\n".
                                " Access-code:- ".$bunit->access_code."\n".
                                " To register in our site , please click on this link :- \n".$url;
                    $sms = $this->sendMessage($body, $request->link_Sent_on);
                    
                    //return response()->json(['status'=>$sms]);
                        if($sms == true){
                            $sendlink = new SendRegistrationLink;
                            $sendlink->first_name = $request->first_name;
                            $sendlink->last_name = $request->last_name;
                            $sendlink->is_email = 0;
                            $sendlink->is_phone = 1;
                            $sendlink->link_send_on = $request->link_Sent_on;
                            $sendlink->provider_user_id = Auth::user()->id;
                            $sendlink->provider_id = $bunit->provider_id;
                            $sendlink->access_code = $bunit->access_code;
                            $sendlink->unit_id = $bunit->id;
                            $sendlink->save();
                            if($sendlink){
                                return response()->json(['status'=>3,'message'=>'link saved']);
                            }
                            else{
                                return response()->json(['status'=>0,'message'=>'link not saved']);
                            }
                        }
                        else{
                            return response()->json(['status'=>4,'message'=>'please give correct phone no']);
                        }
                    
                }
            }
            
        }
    }

    private function sendMessage($message, $recipient)
    {
        
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_AUTH_TOKEN");
            $twilio_number = getenv("TWILIO_NUMBER");
            $client = new Client($account_sid, $auth_token);
            try {
                $messagecreate = $client->messages->create($recipient, ['from' => $twilio_number, 'body' => $message]);
            
            return redirect()->back()->with(200); 
            }catch (\Twilio\Exceptions\RestException $e) {
                redirect()->back()->with($e->getCode() . ' : ' . $e->getMessage()."\n");
            }
    }


  

    public function searchConsumer(Request $request){
        if($request->ajax()){
            $query = $request->search;
            $response = array();
            $property = PropertyUnderProviderUser::where('provider_user_id',auth()->user()->id)->first();
            $property_id = $property->provider_id;
            $users = ConsumerUnit::whereHas('consumers',function ($q) use ($query) {
                $q->WhereRaw("concat(first_name,' ', last_name) like '%" . trim($query) . "%' ")->role('CONSUMER');
            })->where('provider_type_id',$property_id)->get();
            if(count($users) > 0){
                foreach($users as $userdata){
                    $response[] = array("value"=>$userdata->id,"label"=>$userdata->consumers->full_name);
                }
                
            }
            $units = ConsumerUnit::whereHas('buildingunit',function ($q) use ($query) {
                $q->Where('unit', 'like', '%' . $query . '%');
            })->where('provider_type_id',$property_id)->get();
            if(count($units) > 0){
                foreach($units as $unitdata){
                    $response[] = array("value"=>$unitdata->id,"label"=>$unitdata->buildingunit->unit);
                }
                
            }
            
            return response()->json($response);
            
        }
    }

    public function checkReward(Request $request){

        if($request->ajax()){
            $current_year = date('Y');
            $next_month =  date('F',strtotime('first day of +1 month'));

            $tenant = ProviderRecognitionUser::with('provider_recognition.type')->where('tenant_id',$request->consumer_id)
            ->with('provider_recognition',function($q) use ($request,$next_month,$current_year){
                $q->where('provider_id',$request->property_id)->where('month',$next_month)->where('is_published',0)->whereYear('created_at',$current_year);
            })->first();
            if($tenant){
                $type= $tenant->provider_recognition->type;
                return response()->json(['status'=>1,'data' => $type]);
            }
            else{
                return response()->json(['status'=>0]);
            }
            
        }
    }
}
