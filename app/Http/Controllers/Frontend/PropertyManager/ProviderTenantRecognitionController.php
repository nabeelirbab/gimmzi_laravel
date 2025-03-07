<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Provider;
use App\Models\ProviderTenantRecognition;
use App\Models\RecognitionMessage;
use App\Models\RecognitionType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ConsumerUnit;
use App\Models\PropertyUnderProviderUser;

class ProviderTenantRecognitionController extends Controller
{
    public function tenantRecognation()
    {
        $monthArray = array();
        $types = RecognitionType::where('status', 1)->get();
        $properties = PropertyUnderProviderUser::where('provider_user_id',Auth::user()->id)->pluck('provider_id');
        $consumers = ConsumerUnit::with('consumers','providerBuilding','buildingunit')->whereIn('provider_type_id',$properties)->get();
        return view('frontend.property-manager.tenant_recognation', compact('types','consumers'));
    }

    public function storeTenantRecognation(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tenant_option != '') {
                if ($request->select_type != '') {
                    if ($request->system_message != '') {
                        if ($request->default != '') {
                            if ($request->custom_message != '') {
                                $validator  =   Validator::make($request->all(), [
                                    "custom_message"  =>  "required"
                                ]);
                                if ($validator->fails()) {
                                    return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                                } else {
                                    $existTenant = ProviderTenantRecognition::where('type_id', $request->select_type)->where('provider_id', Auth::user()->id)->first();
                                    if ($existTenant) {
                                        $existTenant->type_id = $request->select_type;
                                        $existTenant->provider_id = Auth::user()->id;
                                        $existTenant->system_message = $request->system_message;
                                        $existTenant->custom_message = $request->custom_message;
                                        $existTenant->status = 1;
                                        $existTenant->save();
                                        if ($request->tenant_option == "on") {
                                            $existTenant->recognition_option = 1;
                                            $existTenant->save();
                                        } else {
                                            $existTenant->recognition_option = 0;
                                            $existTenant->save();
                                        }
                                        if ($request->default == "tenant_only") {
                                            $existTenant->tenant_only = 1;
                                            $existTenant->make_public = 0;
                                            $existTenant->save();
                                        } else if ($request->default == "make_public") {
                                            $existTenant->make_public = 1;
                                            $existTenant->tenant_only = 0;
                                            $existTenant->save();
                                        }
                                        if ($existTenant) {
                                            return response()->json(["success" => 1, "message" => 'Tenant Recognition published successfully.', 'data' => $existTenant]);
                                        }
                                    } else {
                                        $tenant = new ProviderTenantRecognition();
                                        $tenant->type_id = $request->select_type;
                                        $tenant->provider_id = Auth::user()->id;
                                        $tenant->system_message = $request->system_message;
                                        $tenant->custom_message = $request->custom_message;
                                        $tenant->status = 1;
                                        $tenant->save();
                                        if ($request->tenant_option == "on") {
                                            $tenant->recognition_option = 1;
                                            $tenant->save();
                                        } else {
                                            $tenant->recognition_option = 0;
                                            $tenant->save();
                                        }
                                        if ($request->default == "tenant_only") {
                                            $tenant->tenant_only = 1;
                                            $tenant->make_public = 0;
                                            $tenant->save();
                                        } else if ($request->default == "make_public") {
                                            $tenant->make_public = 1;
                                            $tenant->tenant_only = 0;
                                            $tenant->save();
                                        }
                                        if ($tenant) {
                                            return response()->json(["success" => 2, "message" => 'Tenant Recognition published successfully.', 'data' => $tenant]);
                                        }
                                    }
                                }
                            } else {
                                return response()->json(["success" => 7, "message" => 'Custom message reqiured']);
                            }
                        } else {
                            return response()->json(["success" => 6, "message" => 'Select an default']);
                        }
                    } else {
                        return response()->json(["success" => 5, "message" => 'System msg field required']);
                    }
                } else {
                    return response()->json(["success" => 4, "message" => 'please select one type']);
                }
            } else {
                return response()->json(["success" => 3, "message" => 'please select one option']);
            }
        }
    }
    public function getRecognationMessage(Request $request)
    {
        if ($request->ajax()) {
            $tenantUser = User::with('providers')->where('id', Auth::user()->id)->first();
            $points = Point::where('user_id', Auth::user()->id)->first();

            $getMessage = RecognitionMessage::where('type_id', $request->type_id)->first();
            $getProviderTenant = ProviderTenantRecognition::where('type_id', $request->type_id)->where('provider_id', Auth::user()->id)->first();
            if ($getMessage) {

                return response()->json(['success' => 1, 'data' => $getMessage, 'user' => $tenantUser, 'point' => $points, 'tenant' => $getProviderTenant]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function showRecognition(Request $request)
    {
        if($request->ajax()) {
            
            $getrecognition = RecognitionType::find($request->recognition);

            //$getTitle = MessageBoard::select('title')->where('id',  $getTitle)->first();
            return response()->json(["success" => 1 , "getRecognition" => $getrecognition, "message" => "No Record Found"]);
        }else{
            return response()->json(['success' => 0, "message" => "No Record Found"]);
        }
    }

    public function getConsumerForTenant(Request $request){
        $query = $request->term;
        
        $properties = PropertyUnderProviderUser::where('provider_user_id',Auth::user()->id)->pluck('provider_id');
       
        $filterResult = ConsumerUnit::with('consumers')->whereIn('provider_type_id',$properties)
                        ->whereHas("consumers", function($q) use ($query) {
                        $q->whereRaw("concat(first_name,' ', last_name) like '%" . $query . "%' ");})->get();
       
        //$filterResult = User::where('name', 'LIKE', '%'. $query. '%')->get();
        //if($filterResult)
        return response()->json($filterResult);
    }
}
