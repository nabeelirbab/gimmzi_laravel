<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelUnites;
use App\Models\HotelBuildings;
use Illuminate\Http\Request;
use App\Models\TravelTourism;
use App\Models\User;
use Illuminate\Support\Str;

class HotelUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hotelUnit.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hotelUnit.create-edit',['hotel_unit' => null]);
    }


    public function createUnitByFile(){
        return view('admin.hotelUnit.create');
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
            'unitfile' => 'required|mimes:csv,txt'
        ];
    
        $customMessages = [
            'required' => 'The Upload File field is required.',
            'mimes' => 'The Upload File must be a file type of:csv',
        ];
        $this->validate($request, $rules, $customMessages);
       
        $file = $request->file('unitfile');
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
                 if($importData[0] != ''){
                    $building = HotelBuildings::where('buildingId',$importData[0])->first();
                    if(!$building){
                        unlink($filepath);
                        return redirect()->route('hotel-unit.file.create')->with('error','Please add proper buildinId. ');
                    }else{
                        $building_id = $building->id;                        
                    }
                    if($importData[1] != ''){
                        if($importData[2] != ''){
                            $get_hotel_name = TravelTourism::where('id',$importData[2])->first();
                            if(!$get_hotel_name){
                                unlink($filepath);
                                return redirect()->route('hotel-unit.file.create')->with('error','Please add proper hotel id. ');
                            }else{
                                $hotel_id = $importData[2];
                                if($building->hotel_id != $importData[2]){
                                    unlink($filepath);
                                    return redirect()->route('hotel-unit.file.create')->with('error',$importData[0].' is not under this hotel. Please do correct buildingId.');
                                }
                            }
                            $unit_id = strtoupper(substr($importData[1],0,3)).'/NEW/'.Str::random(2).'/0'.$importData[2];
                            $insertData = array(
                                "building_id"=>$building_id,
                                "unit_name"=>$importData[1],
                                "hotel_id" => $hotel_id,
                                "unitId" =>$unit_id );

                            $unit = HotelUnites::create($insertData);

                        }else{
                            unlink($filepath);
                            return redirect()->route('hotel-unit.file.create')->with('error','Please add hotel id. '); 
                        }
                    }else{
                        unlink($filepath);
                        return redirect()->route('hotel-unit.file.create')->with('error','Please add unit name. '); 
                    }
                 }else{
                    unlink($filepath);
                    return redirect()->route('hotel-unit.file.create')->with('error','Please add buildinId. '); 
                }

            }
            unlink($filepath);
            return redirect()->route('hotel-unit.index')->with('success','Unit data is uploaded successfully... ');
         }else{
            unlink($filepath);
            return redirect()->route('hotel-unit.file.create')->with('error','Please fillup the csv file... '); 
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
    public function edit(HotelUnites $hotel_unit)
    {
        // dd($hotel_unit);
        return view('admin.hotelUnit.create-edit',compact('hotel_unit'));
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

    public function getHotelbuilding(Request $request){
        // dd($request);
        if ($request->ajax()) {
            $building = HotelBuildings::select('building_name', 'id','buildingId')->where('hotel_id',  $request->hotel_id)->where('status', 1)->get();
            return response()->json(['success' => 1, 'data' => $building]);
        } else {
            return response()->json(['success' => 0]);
        }
    }
}
