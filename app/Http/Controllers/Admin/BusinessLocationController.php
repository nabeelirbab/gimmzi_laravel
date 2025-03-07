<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\State;

class BusinessLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($business);
        return view('admin.business-location.index',['business' => NULL]);
    }

    public function list($name)
    {
        return view('admin.business-location.index',['business' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.business-location.create-edit', ['business_location' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'locationfile' => 'required|mimes:csv,txt'
        ];
    
        $customMessages = [
            'required' => 'The Upload File field is required.',
            'mimes' => 'The Upload File must be a file type of:csv',
        ];
        $this->validate($request, $rules, $customMessages);

        $file = $request->file('locationfile');
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
         //dd($i);
         fclose($file);
          //dd(count($importData_arr));
        if(count($importData_arr) > 0){
            foreach($importData_arr as $importData){
               
               if($importData[0] != ''){
                    $merchantId = $importData[0];
                    $business = BusinessProfile::where('businessId',$merchantId)->where('status',1)->first();
                    if($business){
                        $business_id = $business->id;
                        $business_name = $business->business_name;
                        $location_number = $business->number_of_location;
                        $locationcount = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->count();
                        if(($locationcount != $location_number) || ($locationcount < $location_number)){
                            
                        
                            if($importData[1] != ''){
                                if($importData[2] != ''){
                        
                                    if($importData[3] != ''){

                                        if($importData[4] != ''){
                                            $state = State::where('name',$importData[4])->first();
                                                if($state){
                                                    $stateid = $state->id;
                                                    if($importData[5] != ''){
                                                        if(is_numeric($importData[5])){
                                                            if(strlen($importData[5]) == 5){
                                                                if($importData[6] != ''){
                                                                    
                                                                    if($importData[6] == 'Non Headquarters'){
                                                                        if($importData[7] != ''){
                                                                            if($importData[8] != ''){
                                                                                if($importData[9] != ''){
                                                                                    $location_name = $importData[1];
                                                                                    $address = $importData[2];
                                                                                    $city = $importData[3];
                                                                                    $state = $importData[4];
                                                                                    $zip_code = $importData[5];
                                                                                    $business_phone = $importData[7];
                                                                                    $business_fax = $importData[8];
                                                                                    $business_email = $importData[9];
                                                                                    $insertData = array(
                                                                                        "business_profile_id"=>$business_id,
                                                                                        "location_name"=>$location_name,
                                                                                        "address"=>$address,
                                                                                        "city" => $city,
                                                                                        "state_id" => $stateid,
                                                                                        "zip_code" => $zip_code,
                                                                                        "status" => true,
                                                                                        "location_type" => 'Not Headquarters',
                                                                                        "business_phone" => $business_phone,
                                                                                        "business_fax_number" => $business_fax,
                                                                                        "business_email" => $business_email);
                                                                                    $businessLocation = BusinessLocation::create($insertData);
                                                                                    $locationId = strtoupper(substr($business_name,0,3)).'/'.strtoupper(substr($location_name,0,3)).'/0'.$businessLocation->id;
                                                                                    $businessLocation->locationId = $locationId;
                                                                                    $businessLocation->save();
                                                                                }
                                                                                else{
                                                                                    unlink($filepath);
                                                                                    return redirect()->route('business-locations.create')->with('error','Please give a correct business email... ');
                                                                                }
                                                                                
                                                                            }
                                                                            else{
                                                                                unlink($filepath);
                                                                                return redirect()->route('business-locations.create')->with('error','Please give a correct business fax number... ');
                                                                            }
                                                                                
                                                                        }
                                                                        else{
                                                                            unlink($filepath);
                                                                            return redirect()->route('business-locations.create')->with('error','Please give a correct business phone number... ');
                                                                        }
                                                                        
                                                                    }
                                                                    elseif($importData[6] == 'Headquarters'){
                                                                        if($importData[7] != ''){

                                                                            if($importData[8] != ''){

                                                                                if($importData[9] != ''){
                                                                                    $location_name = $importData[1];
                                                                                    $address = $importData[2];
                                                                                    $city = $importData[3];
                                                                                    $state = $importData[4];
                                                                                    $zip_code = $importData[5];
                                                                                    $business_phone = $importData[7];
                                                                                    $business_fax = $importData[8];
                                                                                    $business_email = $importData[9];
                                                                                    $hqcount = BusinessLocation::where('business_profile_id',$business_id)->where('status',1)->where('location_type','Headquarters')->count();
                                                                                    if($hqcount > 0){
                                                                                        $insertData = array(
                                                                                            "business_profile_id"=>$business_id,
                                                                                            "location_name"=>$location_name,
                                                                                            "address"=>$address,
                                                                                            "city" => $city,
                                                                                            "state_id" => $stateid,
                                                                                            "zip_code" => $zip_code,
                                                                                            "status" => true,
                                                                                            "location_type" => 'Not Headquarters',
                                                                                            "business_phone" => $business_phone,
                                                                                            "business_fax_number" => $business_fax,
                                                                                            "business_email" => $business_email);
                                                                                        $businessLocation = BusinessLocation::create($insertData);
                                                                                        $locationId = strtoupper(substr($business_name,0,3)).'/'.strtoupper(substr($location_name,0,3)).'/0'.$businessLocation->id;
                                                                                        $businessLocation->locationId = $locationId;
                                                                                        $businessLocation->save();
                                                                                    }
                                                                                    else{
                                                                                        $insertData = array(
                                                                                            "business_profile_id"=>$business_id,
                                                                                            "location_name"=>$location_name,
                                                                                            "address"=>$address,
                                                                                            "city" => $city,
                                                                                            "state_id" => $stateid,
                                                                                            "zip_code" => $zip_code,
                                                                                            "status" => true,
                                                                                            "location_type" => 'Headquarters',
                                                                                            "business_phone" => $business_phone,
                                                                                            "business_fax_number" => $business_fax,
                                                                                            "business_email" => $business_email);
                                                                                        $businessLocation = BusinessLocation::create($insertData);
                                                                                        $locationId = strtoupper(substr($business_name,0,3)).'/'.strtoupper(substr($location_name,0,3)).'/0'.$businessLocation->id;
                                                                                        $businessLocation->locationId = $locationId;
                                                                                        $businessLocation->save();
                                                                                    }
                                                                                }
                                                                                else{
                                                                                    unlink($filepath);
                                                                                    return redirect()->route('business-locations.create')->with('error','Please give a correct business email... ');
                                                                                }
                                                                            }
                                                                            else{
                                                                                unlink($filepath);
                                                                                return redirect()->route('business-locations.create')->with('error','Please give a correct business fax number... ');
                                                                            }
                                                                        }
                                                                        else{
                                                                            unlink($filepath);
                                                                            return redirect()->route('business-locations.create')->with('error','Please give a correct business phone number... ');
                                                                        }
                                                                        
                                                                    }
                                                                    else{
                                                                        unlink($filepath);
                                                                        return redirect()->route('business-locations.create')->with('error','Please give a correct location type... ');
                                                                    }
                                                                    
                                                                }
                                                                else{
                                                                    unlink($filepath);
                                                                    return redirect()->route('business-locations.create')->with('error','Please give a correct location type... ');
                                                                }
                                                                
                                                            }
                                                            else{
                                                                unlink($filepath);
                                                                return redirect()->route('business-locations.create')->with('error','Zip code should be equal to 5... ');
                                                            }
                                                        }
                                                        else{
                                                            unlink($filepath);
                                                            return redirect()->route('business-locations.create')->with('error','Zip code must be a number... ');
                                                        }
                                                        
                                                    }
                                                    else{
                                                        unlink($filepath);
                                                        return redirect()->route('business-locations.create')->with('error','Please fillup the all field of csv file... ');
                                                    }
                                                }
                                                else{
                                                    unlink($filepath);
                                                    return redirect()->route('business-locations.create')->with('error','Please give correct name of state, given state name cannot match with our database. Copy from our state list');
                                                }

                                        }
                                        else{
                                            unlink($filepath);
                                            return redirect()->route('business-locations.create')->with('error','Please fillup the all field of csv file... ');
                                        }

                                    }
                                    else{
                                        unlink($filepath);
                                        return redirect()->route('business-locations.create')->with('error','Please fillup the all field of csv file... ');
                                    }
                                
                                }
                                else{
                                    unlink($filepath);
                                    return redirect()->route('business-locations.create')->with('error','Please fillup the all field of csv file... ');
                                }
                                
                            }
                            else{
                                unlink($filepath);
                                return redirect()->route('business-locations.create')->with('error','Please fillup the csv file... ');
                            }
                        }
                        else{
                            unlink($filepath);
                            return redirect()->route('business-locations.create')->with('error','Please increase the "Number of Location" of this business profile. Otherwise you can not add another location for same Merchant Plus Id..');
                        }
                    }
                    else{
                        unlink($filepath);
                        return redirect()->route('business-locations.create')->with('error','Please give a valid merchant id... ');
                    }
                    
                }
               else{
                unlink($filepath);
                return redirect()->route('business-locations.create')->with('error','Please fillup the csv file... ');
               }
                
            }
            unlink($filepath);
            return redirect()->route('business-location.index')->with('success','Location data is uploaded successfully... ');
        }
        else{
            unlink($filepath);
            return redirect()->route('business-locations.create')->with('error','Please fillup the csv file... ');
        }
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
    public function edit(BusinessLocation $business_location)
    {
        return view('admin.business-location.create-edit', ['business_location' => $business_location]);
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

    public function createLocationByFile(){
        return view('admin.business-location.create');
    }

    public function getLocationType(Request $request){
        if($request->ajax()){
            $locations = BusinessLocation::where('business_profile_id',$request->profile_id)->where('location_type','Headquarters')->count();
            if($locations > 0){
                return response()->json(['success' => 0]);
            }
            else{
                $profile = BusinessProfile::find($request->profile_id);
                
                if($profile->merchant_type == 'Basic'){
                    return response()->json(['success' => 1]);
                }
                else{
                    return response()->json(['success' => 2]);
                }
                
            }
        }
    }

    public function getTypeCount(Request $request){

        if($request->ajax()){
            $locations = BusinessLocation::where('business_profile_id',$request->profile_id)->where('location_type','Headquarters')->count();
            if($locations > 0){
                return response()->json(['success' => 0]);
            }

        }

    }
}
