<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BusinessProfile;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Models\State;

class BusinessProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.business-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.business-profile.create-edit', ['business_profile' => null]);
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
    public function edit(BusinessProfile $business_profile)
    {
        return view('admin.business-profile.create-edit',compact('business_profile'));
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

    public function getServiceType(Request $request){
        if($request->ajax()){
            $service = ServiceType::where('category_id', $request->category_Id)->where('status',1)->orderBy('service_name')->get();
            
            if($service){
                return response()->json(['success' => 1, 'data' => $service]);
            }
            else{
                return response()->json(['success' => 0, 'data' => []]);
            }
        }
    }

    public function getCity(Request $request){
        if($request->ajax()){
            $request_doc_template = <<<EOT
            <?xml version="1.0"?>
            <CityStateLookupRequest USERID="513GIMMZ4201">
            <ZipCode ID= "0">
            <Zip5>$request->zipcode</Zip5>
            </ZipCode>
            </CityStateLookupRequest>
            EOT;
            $doc_string = preg_replace('/[\t\n]/', '', $request_doc_template);
            $doc_string = urlencode($doc_string);

            $url = "http://production.shippingapis.com/ShippingAPI.dll?API=CityStateLookup&XML=" . $doc_string;
           // echo $url . "\n\n";

            // perform the get
            $response = file_get_contents($url);
            $xml=simplexml_load_string($response) or die("Error: Cannot create object");
           // return response()->json(['success' => 1, 'data' => $xml]); 
            if($xml->ZipCode->City){
                $state = State::where('code',$xml->ZipCode->State)->first();
                $id = $state->id;
                return response()->json(['success' => 1, 'data' => $xml->ZipCode, 'state_name' => $id]);
            }
            else{
                $error = $xml->ZipCode->Error->Description; 
                return response()->json(['success' => 0, 'data' => $error]);
            }
         }
    }
}
