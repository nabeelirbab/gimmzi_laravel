<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ConsumerUnit;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use App\Models\ProviderType;
use App\Models\BuildingUnit;
use Illuminate\Support\Facades\Log;
use App\Models\Apartmentbadge;
use App\Models\ApartmentGuestBadge;
use App\Models\ProviderLimitSetting;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProviderBadgeSentEmail;
use DateTime;


class ConsumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.consumer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.consumer.create-edit', ['consumer' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $consumer)
    {
        return view('admin.consumer.create-edit', compact('consumer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function consumerProviders($user_id)
    {
        //$consumer_providers = ConsumerUnit::with('provider','providerUser')->where('consumer_id',$user_id)->get();
        return view('admin.consumer.provider.index', compact('user_id'));
    }

    public function consumerProvidersCreate($user_id)
    {
        return view('admin.consumer.provider.create-edit', ['consumer_unit' => null], compact('user_id'));
    }

    public function getConsumerBuilding(Request $request)
    {
        if ($request->ajax()) {
            $provider = Provider::find($request->provider_Id);

            if ($provider->provider_type_id != '') {
                $type = ProviderType::select('name', 'id')->where('id', $provider->provider_type_id)->first();

                $building = ProviderBuilding::select('building_name', 'id')->where('provider_type_id', $request->provider_Id)->get();

                if ($type->name == 'Residential') {
                    return response()->json(['success' => 1, 'data' => $building]);
                }
            } 
            else{
                return response()->json(['success' => 0 , 'data' => []]);
            }
           
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function getProviderType(Request $request){
        if ($request->ajax()) {
            $type = ProviderType::find($request->type_id);
            if($type){
                if($type->name == 'Residential'){
                    $provider = Provider::where('provider_type_id',$request->type_id)->get();
                    if($provider){
                        return response()->json(['success' => 1, 'data' => $provider]);
                    }
                    else{
                        return response()->json(['success' => 1, 'data' => []]);
                    }
                }
                elseif($type->name == 'Employer'){
                    $provider = Provider::where('provider_type_id',$request->type_id)->get();
                    if($provider){
                        return response()->json(['success' => 2, 'data' => $provider]);
                    }
                    else{
                        return response()->json(['success' => 2, 'data' => []]);
                    }
                }
                elseif($type->name == 'Merchant+'){
                    $provider = Provider::where('provider_type_id',$request->type_id)->get();
                    if($provider){
                        return response()->json(['success' => 3, 'data' => $provider]);
                    }
                    else{
                        return response()->json(['success' => 3, 'data' => []]);
                    }
                }
                else{
                    return response()->json(['success' => 0, 'data' => []]);
                }
            }
        }
    }

    public function getBuildingUnit(Request $request){
        if ($request->ajax()) {
            $unit = BuildingUnit::where('building_id',$request->building_Id)->where('status',1)->get();
            if($unit){
                return response()->json(['success' => 1, 'data' => $unit]);
            }
            else{
                return response()->json(['success' => 0, 'data' => []]);
            }
        }
    }

    public function consumerProvidersEdit(ConsumerUnit $consumer_unit){
       
        $userid = $consumer_unit->consumer_id;
        return view('admin.consumer.provider.create-edit', ['consumer_unit' => $consumer_unit,'user_id' => $userid]);
    }

    public function apartmentBadgeConsumer(){
        return view('admin.consumer.apartment-badges-consumers');
    }

    public function buildingConsumerCreate(){
            try{
               
                $provider = Provider::where('provider_type_id',1)->where('status',1)->get();
                
                return view('admin.consumer.apartmentbadge', ['consumer' => null], compact('provider'));
            }
            catch(\Throwable $e){
                Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            }
    }

    public function getUnitBadges(Request $request){
        if ($request->ajax()) {
            $today = date('Y-m-d');
            $badge = Apartmentbadge::where('unit_id',$request->unit_id)
                                    ->whereDate('end_date','>',$today)
                                    ->where('status',1)->get();
            if($badge){
                return response()->json(['success' => 1, 'data' => $badge]);
            }
            else{
                return response()->json(['success' => 0, 'data' => []]);
            }
        }
    }

    public function buildingConsumerStore(Request $request){
        $rules = [
            'apartment_id' => 'required',
            'building_id' => 'required',
            'unit_id' => 'required',
            'badge_id' => 'required',
            'badge_guest_file' => 'required|mimes:csv,txt',
        ];
    
        $customMessages = [
            'apartment_id.required' => 'Select Apartment field is required',
            'building_id.required' => 'Select Building field is required',
            'unit_id.required' => 'Select Building Unit field is required',
            'badge_id.required' => 'Select Unit Badge field is required',
            'badge_guest_file.mimes' => 'The Upload File must be a file type of:csv',
            'badge_guest_file.required' => 'The Upload File is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $file = $request->file('badge_guest_file');
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        $location = 'uploads';
         // Upload file
         $file->move($location,$filename);

         // Import CSV to Database
         $filepath = public_path($location."/".$filename);

         // Reading file
         $file = fopen($filepath,"r");

         $importData_arr = array();
         $i = 0;
         while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            $num = count($filedata );
            
            // Skip first row (Remove below comment if you want to skip the first row)
            if($i == 0){
               $i++;
               continue; 
            }
            for ($c=0; $c < $num; $c++) {
               $importData_arr[$i][] = $filedata [$c];
            }
            $i++;
         }
         fclose($file);
         $today = date('Y-m-d');
         if(count($importData_arr) > 0){
            foreach($importData_arr as $importData){
                $badge = Apartmentbadge::find($request->badge_id);
                if($badge->guest_count < 10){
                    if($importData[0] != ''){
                        if($importData[1] != ''){
                            if($importData[2] != ''){
                                if(filter_var($importData[2], FILTER_VALIDATE_EMAIL)){
                                   
                                    if(($importData[3] != '')){
                                        
                                        if(ctype_digit($importData[3]))
                                        {
                                            if(strlen($importData[3]) === 5)
                                            {
                                                if($importData[4] != '')
                                                {
                                                    $format = "Y-m-d";
                                                    $date = DateTime::createFromFormat($format, $importData[4]);
                                                    
                                                        if ($date !== false && $date->format($format) === $importData[4]) 
                                                        {
                                                            $email=ApartmentGuestBadge::where('guest_email',$importData[2])->first();
                                                            if($email){
                                                                $badges=Apartmentbadge::where('id',$email->badges_id)->first();
                                                                if($badges){
                                                                    if($badges->end_date < now()->toDateString())
                                                                    {
                                                                        $date = today()->format('Y-m-d');
                                                                        $user = User::where('email',$importData[2])->first();
                                                                        if($user){

                                                                            $badge_guest = new ApartmentGuestBadge;
                                                                            $badge_guest->guest_first_name = trim($importData[0]);
                                                                            $badge_guest->guest_last_name = trim($importData[1]);
                                                                            $badge_guest->guest_email = trim($importData[2]);
                                                                            $badge_guest->zip_code = trim($importData[3]);
                                                                            $badge_guest->date_of_birth = trim($importData[4]);
                                                                            $badge_guest->user_id = $user->id;
                                                                            $badge_guest->badges_id = $request->badge_id;
                                                                            $badge_guest->status = false;
                                                                            $badge_guest->save();
                                                                
                                                                            $checkindate = $badge->start_date;
                                                                            $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                                            $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                                            if($limit_setting){

                                                                                if($limit_setting->sign_up_bonus_point){
                                                                                    $point = $limit_setting->sign_up_bonus_point;
                                                                                }
                                                                                else{
                                                                                    $point = '';
                                                                                } 
                                                                            }
                                                                            else{
                                                                                    $point = '';
                                                                                }
                                                                            $details = array(
                                                                                'apartment_name' => $badge->buildingunit->unit,
                                                                                'building' => $badge->building->building_name,
                                                                                'point' => $point,
                                                                                'arrival_date' => $arrival_date,
                                                                                'request_id' => $badge_guest->id
                                                                            );
                                                                            //dd($details);
                                                                            Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                                        }
                                                                        else{
                                                                            $badge_guest = new ApartmentGuestBadge;
                                                                            $badge_guest->guest_first_name = trim($importData[0]);
                                                                            $badge_guest->guest_last_name = trim($importData[1]);
                                                                            $badge_guest->guest_email = trim($importData[2]);
                                                                            $badge_guest->zip_code = trim($importData[3]);
                                                                            $badge_guest->date_of_birth = trim($importData[4]);
                                                                            $badge_guest->badges_id = $request->badge_id;
                                                                            $badge_guest->status = false;
                                                                            $badge_guest->save();
                                                                            //Mail 
                                                                            $checkindate = $badge->start_date;
                                                                            $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                                            $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                                            if($limit_setting){
                                                                                if($limit_setting->sign_up_bonus_point){
                                                                                    $point = $limit_setting->sign_up_bonus_point;
                                                                                }
                                                                                else{
                                                                                    $point = '';
                                                                                } 
                                                                            }
                                                                            else{
                                                                                $point = '';
                                                                            }
                                                                            $details = array(
                                                                                'apartment_name' => $badge->buildingunit->unit,
                                                                                'building' => $badge->building->building_name,
                                                                                'point' => $point,
                                                                                'arrival_date' => $arrival_date,
                                                                                'request_id' => $badge_guest->id
                                                                            );
                                                                            //dd($details);
                                                                            Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                                        }
                                                                    }
                                                                    else{
                                                                        unlink($filepath);
                                                                        return redirect()->route('consumers.index')->with('error',$importData[2].' has an active resident badge. Members can only have one active resident badge at a time. This member will need to deactivate their current badge to accept this badge. An email with instructions has been sent to this member. ');  
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                        unlink($filepath);
                                                                        return redirect()->route('consumers.index')->with('error','Birthdate must be correct format');   
                                                                }
                                                            }        
                                                            else{
                                                                $user = User::where('email',$importData[2])->first();
                                                                if($user){
                                                                    $badge_guest = new ApartmentGuestBadge;
                                                                    $badge_guest->guest_first_name = trim($importData[0]);
                                                                    $badge_guest->guest_last_name = trim($importData[1]);
                                                                    $badge_guest->guest_email = trim($importData[2]);
                                                                    $badge_guest->zip_code = trim($importData[3]);
                                                                    $badge_guest->date_of_birth = trim($importData[4]);
                                                                    $badge_guest->user_id = $user->id;
                                                                    $badge_guest->badges_id = $request->badge_id;
                                                                    $badge_guest->status = false;
                                                                    $badge_guest->save();
                                                                    //Mail 
                                                                    $checkindate = $badge->start_date;
                                                                    $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                                    $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                                    if($limit_setting){
                                                                        if($limit_setting->sign_up_bonus_point){
                                                                            $point = $limit_setting->sign_up_bonus_point;
                                                                        }
                                                                        else{
                                                                            $point = '';
                                                                        } 
                                                                    }
                                                                    else{
                                                                            $point = '';
                                                                        }
                                                                        $details = array(
                                                                            'apartment_name' => $badge->buildingunit->unit,
                                                                            'building' => $badge->building->building_name,
                                                                            'point' => $point,
                                                                            'arrival_date' => $arrival_date,
                                                                            'request_id' => $badge_guest->id
                                                                        );
                                                                        //dd($details);
                                                                        Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                                }
                                                                else{
                                                                    $badge_guest = new ApartmentGuestBadge;
                                                                    $badge_guest->guest_first_name = trim($importData[0]);
                                                                    $badge_guest->guest_last_name = trim($importData[1]);
                                                                    $badge_guest->guest_email = trim($importData[2]);
                                                                    $badge_guest->zip_code = trim($importData[3]);
                                                                    $badge_guest->date_of_birth = trim($importData[4]);
                                                                    $badge_guest->badges_id = $request->badge_id;
                                                                    $badge_guest->status = false;
                                                                    $badge_guest->save();
                                                                    //Mail 
                                                                    $checkindate = $badge->start_date;
                                                                    $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                                    $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                                    if($limit_setting){
                                                                        if($limit_setting->sign_up_bonus_point){
                                                                            $point = $limit_setting->sign_up_bonus_point;
                                                                        }
                                                                        else{
                                                                            $point = '';
                                                                        } 
                                                                    }
                                                                    else{
                                                                        $point = '';
                                                                    }
                                                                    $details = array(
                                                                        'apartment_name' => $badge->buildingunit->unit,
                                                                        'building' => $badge->building->building_name,
                                                                        'point' => $point,
                                                                        'arrival_date' => $arrival_date,
                                                                        'request_id' => $badge_guest->id
                                                                    );
                                                                    //dd($details);
                                                                    Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                                } 
                                                            }
                                                        }
                                                        else{
                                                            unlink($filepath);
                                                            return redirect()->route('consumers.index')->with('error','Birthdate must be correct format and the format must be y-m-d');
                                                        }
                                                            
                                                }
                                            }
                                            else{
                                                unlink($filepath);
                                                return redirect()->route('consumers.index')->with('error','Zip code must be 5 digit...');
                                            }
                                        } 
                                        else{
                                            unlink($filepath);
                                            return redirect()->route('consumers.index')->with('error','Please correct the zip code... ');
                                        }
                                    } 
                                    else{
                                        $user = User::where('email',$importData[2])->first();
                                                if($user){
                                                    $badge_guest = new ApartmentGuestBadge;
                                                    $badge_guest->guest_first_name = trim($importData[0]);
                                                    $badge_guest->guest_last_name = trim($importData[1]);
                                                    $badge_guest->guest_email = trim($importData[2]);
                                                    $badge_guest->zip_code = trim($importData[3]);
                                                    $badge_guest->date_of_birth = trim($importData[4]);
                                                    $badge_guest->user_id = $user->id;
                                                    $badge_guest->badges_id = $request->badge_id;
                                                    $badge_guest->status = false;
                                                    $badge_guest->save();
                                                    //Mail 
                                                    $checkindate = $badge->start_date;
                                                    $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                    $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                    if($limit_setting){
                                                        if($limit_setting->sign_up_bonus_point){
                                                            $point = $limit_setting->sign_up_bonus_point;
                                                        }
                                                        else{
                                                            $point = '';
                                                        } 
                                                    }
                                                    else{
                                                            $point = '';
                                                        }
                                                        $details = array(
                                                            'apartment_name' => $badge->buildingunit->unit,
                                                            'building' => $badge->building->building_name,
                                                            'point' => $point,
                                                            'arrival_date' => $arrival_date,
                                                            'request_id' => $badge_guest->id
                                                        );
                                                        //dd($details);
                                                        Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                    }
                                            
                                                else{
                                                    $badge_guest = new ApartmentGuestBadge;
                                                    $badge_guest->guest_first_name = trim($importData[0]);
                                                    $badge_guest->guest_last_name = trim($importData[1]);
                                                    $badge_guest->guest_email = trim($importData[2]);
                                                    $badge_guest->zip_code = trim($importData[3]);
                                                    $badge_guest->date_of_birth = trim($importData[4]);
                                                    $badge_guest->badges_id = $request->badge_id;
                                                    $badge_guest->status = false;
                                                    $badge_guest->save();
                                                    //Mail 
                                                    $checkindate = $badge->start_date;
                                                    $arrival_date = date_format(date_create($checkindate), 'm/d/Y');
                                                    $limit_setting = ProviderLimitSetting::where('property_id',$badge->building->provider_type_id)->first();
                                                    if($limit_setting){
                                                        if($limit_setting->sign_up_bonus_point){
                                                            $point = $limit_setting->sign_up_bonus_point;
                                                        }
                                                        else{
                                                            $point = '';
                                                        } 
                                                    }
                                                    else{
                                                        $point = '';
                                                    }
                                                    $details = array(
                                                        'apartment_name' => $badge->buildingunit->unit,
                                                        'building' => $badge->building->building_name,
                                                        'point' => $point,
                                                        'arrival_date' => $arrival_date,
                                                        'request_id' => $badge_guest->id
                                                    );
                                                    //dd($details);
                                                    Mail::to(trim($importData[2]))->queue(new ProviderBadgeSentEmail($details));
                                                } 
                                    }
                                }
                                else{
                                    unlink($filepath);
                                    return redirect()->route('consumers.index')->with('error','Please fillup the csv file... ');
                                } 
                            }
                            else{
                                unlink($filepath);
                                return redirect()->route('consumers.index')->with('error','Please fillup the csv file... ');
                            }
                        }
                        else{
                            unlink($filepath);
                            return redirect()->route('consumers.index')->with('error','Please fillup the csv file... ');
                        }
                    }
                    else{
                        unlink($filepath);
                        return redirect()->route('consumers.index')->with('error','Please fillup the csv file... ');
                    }
                }
                else{
                    unlink($filepath);
                    return redirect()->route('consumers.index')->with('success','10 badges completed for this unit');
                }
                
            }
            unlink($filepath);
            return redirect()->route('consumers.index')->with('success','Unit Badge data is uploaded successfully... ');
        }
    }
}
