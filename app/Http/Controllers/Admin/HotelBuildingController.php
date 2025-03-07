<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HotelBuildings;
use App\Models\User;
use App\Models\TravelTourism;

class HotelBuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotel-buildings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotel-buildings.create-edit', ['hotel_building' => null]);
    }

    public function createByFile(){
        // dd('sdfsdfsdf');
        return view('admin.hotel-buildings.create');
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
            'buildingfile' => 'required|mimes:csv,txt'
        ];
    
        $customMessages = [
            'required' => 'The Upload File field is required.',
            'mimes' => 'The Upload File must be a file type of:csv',
        ];
        $this->validate($request, $rules, $customMessages);
        $file = $request->file('buildingfile');
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
        //  dd($importData_arr);
        if(count($importData_arr) > 0){
            foreach($importData_arr as $importData){
            //    dd($importData[0]);
                if(($importData[0] == '') && ($importData[1] == '')){
                    unlink($filepath);
                    return redirect()->route('building.file.create')->with('error','Please fillup the csv file... ');
                }
                else{
                  
                    // if($importData[0] != ''){
                    //    // dd($importData[0]);
                    //    $provider_type_id = $importData[0];
                    //    //dd($provider_type_id);
                    //    $provider = Provider::where('providerId',$provider_type_id)->first();
                    //    //dd($provider);
                    //    if(!is_null($provider)){
                    //     $provider_id = $provider->id;
                    //     $provider_name = $provider->name;
                    //     $user = User::where('provider_id',$provider_id)->first();
                    //     if($user != ''){
                    //      $user_id = $user->id;
                    //     }
                    //     else{
                    //         unlink($filepath);
                    //      return redirect()->route('building.file.create')->with('error','Please select a provider user for '.$provider_name.'.');
                    //     }
                    //    }
                    //    else{
                    //     unlink($filepath);
                    //     return redirect()->route('building.file.create')->with('error','Please give a valid provider id');
                    //    }
                       
       
                    // }
                    // else{
                    //     unlink($filepath);
                    //     return redirect()->route('building.file.create')->with('error','Please give a provider id');
                       
                    // }
                    if(($importData[0] == '')){
                        unlink($filepath);
                        return redirect()->route('building.file.create')->with('error','Please fillup the csv file... ');
                    }
                        if($importData[1] == ''){
                            unlink($filepath);
                            return redirect()->route('hotel-building.file.create')->with('error','Please give a building name');
                        }
                        else{
                            $get_hotel_name = TravelTourism::where('id',$importData[0])->first();
                            if(!$get_hotel_name){
                                unlink($filepath);
                                return redirect()->route('hotel-building.file.create')->with('error','Please give a valid hotel id');
                            }
                            // dd($importData[0], $get_hotel_name);
                            $provider_name = $get_hotel_name->name;
                            // dd($provider_name);
                            $insertData = array(
                                "hotel_id"=>$importData[0],
                                "building_name"=> $importData[1]);
                            $building = HotelBuildings::create($insertData);
                            if(($importData[1] != '') && ($provider_name != '')){
                                $buildingid = strtoupper(substr($importData[1],0,2)).'/'.strtoupper(substr($provider_name,0,3)).'/0'.$building->id;
                                
                            }
                            elseif(($importData[1] != '') && ($provider_name == '')){
                                $buildingid = strtoupper(substr($importData[1],0,2)).'/0'.$building->id;
                            }
                
                            elseif(($importData[1] == '') && ($provider_name != '')){
                                $buildingid = strtoupper(substr($provider_name,0,2)).'/0'.$building->id;
                            }
                            else{
                                $buildingid = '/0'.$building->id;
                            }
                
                            $building->buildingId = $buildingid;
                            $building->save();
                        }
                   
                }
               
             }
             unlink($filepath);
             return redirect()->route('hotel-buildings.index')->with('success','Building data is uploaded successfully... ');
         }
         else{
            unlink($filepath);
            return redirect()->route('building.file.create')->with('error','Please fillup the csv file... ');
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
    public function edit(HotelBuildings $hotel_building)
    {
        // dd($hotel_building);
        return view('admin.hotel-buildings.create-edit',compact('hotel_building'));
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
}
