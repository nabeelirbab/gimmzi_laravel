<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuildingUnit;
use App\Models\ProviderBuilding;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\User;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.providerUnit.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.providerUnit.create-edit', ['provider_unit' => null]);
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
        // dd($importData_arr);
        if(count($importData_arr) > 0){
            foreach($importData_arr as $importData){
               
               if($importData[0] != ''){
                    $buildingId = $importData[0];
                    $building = ProviderBuilding::where('buildingId',$buildingId)->first();
                    if($building){
                        $building_id = $building->id;
                        $provider_id = $building->provider_type_id;
                        if($importData[1] != ''){
                            if($importData[2] != ''){
                                $memberId = $importData[2];
                                $consumer = User::where('userId',$memberId)->first();
                                $consumer_id = $consumer->id;
    
                                $insertData = array(
                                    "consumer_id"=>$consumer_id,
                                    "building_id"=>$building_id,
                                    "unit"=>$importData[1],
                                    "provider_id" => $provider_id);
                            }
                            else{
                                $insertData = array(
                                    "building_id"=>$building_id,
                                    "unit"=>$importData[1],
                                    "provider_id" => $provider_id);
                            }
                        
                            $unit = BuildingUnit::create($insertData);
                        }
                        else{
                            unlink($filepath);
                            return redirect()->route('unit.file.create')->with('error','Please fillup the csv file... ');
                        }
                    }
                    else{
                        unlink($filepath);
                        return redirect()->route('unit.file.create')->with('error','Please give a valid building id... ');
                    }
                    
               }
               else{
                unlink($filepath);
                return redirect()->route('unit.file.create')->with('error','Please fillup the csv file... ');
               }
                
            }
            unlink($filepath);
            return redirect()->route('provider-unit.index')->with('success','Building data is uploaded successfully... ');
        }
        else{
            unlink($filepath);
            return redirect()->route('unit.file.create')->with('error','Please fillup the csv file... ');
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
    public function edit(BuildingUnit $provider_unit)
    {
        return view('admin.providerUnit.create-edit',compact('provider_unit'));
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

    public function createUnitByFile(){
        return view('admin.providerUnit.create');
    }
    
    public function getBuilding(Request $request){
        // dd($request);
        if ($request->ajax()) {
            $building = ProviderBuilding::select('building_name', 'id','buildingId')->where('provider_type_id',  $request->provider_Id)->where('status', 1)->get();
            return response()->json(['success' => 1, 'data' => $building]);
        } else {
            return response()->json(['success' => 0]);
        }
    }
}
