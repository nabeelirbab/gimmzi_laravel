<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provider;
use App\Models\PropertyUnderProviderUser;
use App\Models\ProviderBuilding;
use App\Models\BuildingUnit;
use App\Models\Point;
use Auth,Hash;
use App\Models\ConsumerUnit;
use App\Models\ProviderLimitSetting;

class SmartRentalController extends Controller
{
    public function smartRentalDB(){
        // $user = auth()->user();
        // $message = null;
        // $propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$user->id)->get();
        // $prop = $propertyDetails->first();
        // $allbuildings = PropertyUnderProviderUser::where('provider_user_id',$user->id)->where('provider_id',$prop->provider_id)->with('provider','providerbuilding.units','providerbuilding.units.consumerunits')->first();
        // if($allbuildings){
        //     foreach($allbuildings->providerbuilding as $property){
        //         if(count(@$property->units) > 0){
        //             foreach(@$property->units  as $bUnit){
        //                 if(count($bUnit->consumerunits) > 0){
        //                     foreach($bUnit->consumerunits as $key=>$conUnit){
        //                         if($key == 0){
        //                             $alldatas[] = [
        //                                 'consumer_unitid'=>$conUnit->id,
        //                                 'unitid'=>$bUnit->id,
        //                                 'building_name'=>@$property->building_name,
        //                                 'unit'=>@$bUnit->unit,
        //                                 'primary_member'=>@$conUnit->consumers->full_name,
        //                                 'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                 'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                 'point'=>@$conUnit->consumers->point
            
        //                             ];
        //                         }
        //                         else{
        //                             $alldatas[] = [
        //                                 'consumer_unitid'=>'',
        //                                 'unitid'=>'',
        //                                 'building_name'=>'',
        //                                 'unit'=>'',
        //                                 'primary_member'=>@$conUnit->consumers->full_name,
        //                                 'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                 'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                 'point'=>@$conUnit->consumers->point
            
        //                             ];
        //                         }
                            
        //                     }
        //                 }
        //                 else{
        //                     $alldatas[] = [
        //                         'unitid'=>@$bUnit->id,
        //                         'building_name'=>@$property->building_name,
        //                         'unit'=>@$bUnit->unit,
        //                         'primary_member'=>'Open',
        //                         'signed_up'=>'--------------',
        //                         'account_term_date'=>'--------------',
        //                         'point'=>'--------------',

        //                     ];
        //                 }

        //             }
        //         }
                
        //     }
        // }
        // else{
        //     $alldatas = array();
        // }
       
        // $ajaxPath = route('frontend.smart-rental-db');
        // if($request->ajax()){
        //     $alldatas = [];
        //     $message = null;
        //     $arrayData = array();
        //     $consumers = array();
        //     $propertyDetails = Provider::find($request->id);
        //     $allbuildings = PropertyUnderProviderUser::where('provider_user_id',$user->id)->where('provider_id',$request->id);
            
        //     if($request->has('unit') && $request->unit != ''){
        //         if ($request->has('text')) {
        //             if ($request->text == 'point') {
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     $consumerUnit = ConsumerUnit::find($request->unit);
        //                     if($consumerUnit){
        //                         $building_id = $consumerUnit->provider_building_id;
        //                         $settings = ProviderLimitSetting::where('property_id',$propertyDetails->id)->first();
        //                         if($settings){
        //                             if($settings->add_point != null){
        //                                 $point = new Point;
        //                                 $point->user_id = $consumerUnit->consumer_id;
        //                                 $point->point = $settings->add_point;
        //                                 $point->came_from = auth()->user()->id;
        //                                 $point->save();
        //                                 $consumer = User::find($consumerUnit->consumer_id);
        //                                 $userpoint = $consumer->point;
        //                                 $totalPoint = $userpoint + $settings->add_point;
        //                                 $consumer->point =  $totalPoint;
        //                                 $consumer->save();
        //                                 $distribute_point = $propertyDetails->points_to_distribute;
        //                                 $propertyDetails->points_to_distribute = ($distribute_point-$settings->add_point);
        //                                 $propertyDetails->save();
        //                                 $message = 'success';
        //                             }
        //                             else{
        //                                 $message = 'no_point';
        //                             }
        //                         }
        //                         else{
        //                             $message = 'no_point';
        //                         } 
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     }
        //                 }
                        
        //             }

        //             elseif($request->text == 'is_deactivate'){
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     $consumerUnit = ConsumerUnit::find($request->unit);
        //                     if($consumerUnit){
        //                         $building = ProviderBuilding::find($consumerUnit->provider_building_id);
        //                         $buildingname = $building->building_name;
        //                         $unitname = $consumerUnit->buildingunit->unit;
        //                         $consumername = $consumerUnit->consumers->full_name;
        //                         $arrayData = array('buildingName' => $buildingname,'unitName' => $unitname,'consumer_name' => $consumername,'property' => $propertyDetails->name);
        //                         $message = 'success';
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     }
                           
        //                 }
        //             }

        //             elseif ($request->text == 'single_deactivate') {
        //                 $userId = Auth::user()->id;
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     $consumerUnit = ConsumerUnit::find($request->unit);
        //                     //return response()->json(['status'=>$request->unit]);
        //                     if($consumerUnit){
        //                         $unit_id = $consumerUnit->unit_id;
        //                         $bUnit = BuildingUnit::find($unit_id);
        //                         if ($bUnit->consumer_id != "") {
        //                             $bUnit->consumer_id = null;
        //                             $bUnit->save();
        //                         }
        //                         $consumerUnit->delete();
        //                         $message = 'success';
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     }
        //                 }
                            
        //             }

        //             elseif ($request->text == 'multiple_deactivate') {
                      
        //                 $userId = Auth::user()->id;
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     $consumer_unit = ConsumerUnit::find($request->unit);
        //                     $unit_id = $consumer_unit->unit_id;
        //                     if ($consumer_unit) {
        //                         $consumerUnit = ConsumerUnit::where('unit_id',$unit_id)->get();
        //                         if($consumerUnit){
        //                             foreach($consumerUnit as $datas){
        //                                 array_push($consumers ,array('name' => $datas->consumers->full_name,'consumer_unit_id' => $datas->id));
        //                             }
        //                             $message = 'success';
        //                         }
        //                         else{
        //                             $message = 'error';
        //                         }
                                
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     } 
        //                 }
                        
        //             } 

        //             elseif ($request->text == 'multiple_user_deactivate') {
                      
        //                 $userId = Auth::user()->id;
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     //return response()->json(['status'=>$request->conarray]);
        //                     if($request->conarray != ''){
        //                         $my_array1 = explode(",",$request->conarray);
        //                         // return response()->json(['status'=>$my_array1]);
        //                         for($i=0;$i<count($my_array1);$i++){
        //                             $consumer_unit = ConsumerUnit::find($my_array1[$i]);
        //                             if ($consumer_unit) {
        //                                 $unitid  = $consumer_unit->unit_id;
        //                                 $bUnit = BuildingUnit::find($unitid);
        //                                 $arrayData = array($bUnit->unit);
        //                                 $consumer_unit->delete();
        //                             }
        //                         }
        //                         $message = 'success';
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     }
                                                         
        //                 }
                        
        //             }           
                    
        //             elseif ($request->text == 'add_term') {
        //                 if($request->checked == 'nonConsumerunit'){
        //                     $message = 'error';
        //                 }
        //                 else{
        //                     $consumerUnit = ConsumerUnit::find($request->unit);
        //                     if($consumerUnit){
        //                         $consumer_id = $consumerUnit->consumer_id;
        //                         $settings = ProviderLimitSetting::where('property_id',$propertyDetails->id)->first();
        //                         if($settings){
        //                             if($settings->term_limit != null){
        //                                 $user = User::find($consumer_id);
        //                                 if($user){
        //                                     if($user->expiry_date != null){
        //                                         $termdate =  date('Y-m-d', strtotime($user->expiry_date . " +".$settings->term_limit));
        //                                         $user->expiry_date = $termdate;
        //                                         $user->save();
        //                                         $message = 'success';
        //                                     }
        //                                     elseif($user->join_date != null){
        //                                         $termdate =  date('Y-m-d', strtotime($user->join_date . " +".$settings->term_limit));
        //                                         $user->expiry_date = $termdate;
        //                                         $user->save();
        //                                         $message = 'success';
        //                                     }
        //                                     else{
        //                                         $termdate =  date('Y-m-d', strtotime($user->created_at . " +1 year") ); 
        //                                         $user->expiry_date = $termdate;
        //                                         $user->save();
        //                                         $message = 'success';
        //                                     }
                                                    
        //                                 }
        //                                 else{
        //                                     $message = 'error';
        //                                 }
        //                             }
        //                             else{
        //                                 $message = 'no_term';
        //                             }
        //                         }
        //                         else{
        //                             $message = 'no_term'; 
        //                         }
        //                     }
        //                     else{
        //                         $message = 'error';
        //                     }
 
        //                 }
        //             }
                        
                    
        //         }
        //     }
        //     if($request->has('radiochangelist') && $request->radiochangelist == "filledunit"){
                
        //         $allbuildings = $allbuildings->with('provider','providerbuilding.units','providerbuilding.units.consumerunits');
               
        //         foreach($allbuildings->first()->providerbuilding as $property){
                   
        //             foreach(@$property->units  as $bUnit){
        //                 if(count($bUnit->consumerunits) > 0){
        //                     foreach($bUnit->consumerunits as $key=>$conUnit){
        //                         if($key == 0){
        //                             $alldatas[] = [
        //                                 'unitid'=>@$bUnit->id,
        //                                 'consumer_unitid'=>$conUnit->id,
        //                                 'building_name'=>@$property->building_name,
        //                                 'unit'=>@$bUnit->unit,
        //                                 'primary_member'=>@$conUnit->consumers->full_name,
        //                                 'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                 'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                 'point'=>@$conUnit->consumers->point
            
        //                             ];
        //                         }
        //                         else{
        //                             $alldatas[] = [
        //                                 'unitid'=>@$bUnit->id,
        //                                 'consumer_unitid' => $conUnit->id,
        //                                 'building_name'=>'',
        //                                 'unit'=>'',
        //                                 'primary_member'=>@$conUnit->consumers->full_name,
        //                                 'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                 'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                 'point'=>@$conUnit->consumers->point
            
        //                             ];
        //                         }
                            
        //                     }
        //                 }   

        //             }
                    
        //         }
                
        //     }
        //     if($request->has('radiochangelist') && $request->radiochangelist == "openunits"){
               
        //         $allbuildings = $allbuildings->with('provider','providerbuilding.units','providerbuilding.units.consumerunits');

        //         foreach($allbuildings->first()->providerbuilding as $property){
        //             if(count(@$property->units) > 0){
        //                 foreach(@$property->units  as $bUnit){
        //                     if(count($bUnit->consumerunits) == 0){
        //                         $alldatas[] = [
        //                             'unitid'=>@$bUnit->id,
        //                             'consumer_unitid' => '',
        //                             'building_name'=>@$property->building_name,
        //                             'unit'=>@$bUnit->unit,
        //                             'primary_member'=>'Open',
        //                             'signed_up'=>'--------------',
        //                             'account_term_date'=>'-----------------',
        //                             'point'=>'-----------------',
        //                             'units' =>@$property->units
        
        //                         ];
        //                     }
                            
        //                 }
        //             }

        //          }
        //     }

        //     if($request->has('radiochangelist') && $request->radiochangelist == "default"){
               
        //         $allbuildings = $allbuildings->with('provider','providerbuilding.units','providerbuilding.units.consumerunits');

        //         foreach($allbuildings->first()->providerbuilding as $property){
        //             if(count(@$property->units) > 0){
        //                 foreach(@$property->units  as $bUnit){
        //                     if(count($bUnit->consumerunits) > 0){
        //                         foreach($bUnit->consumerunits as $key=>$conUnit){
        //                             if($key == 0){
        //                                 $alldatas[] = [
        //                                     'unitid'=>@$bUnit->id,
        //                                     'consumer_unitid'=>$conUnit->id,
        //                                     'building_name'=>@$property->building_name,
        //                                     'unit'=>@$bUnit->unit,
        //                                     'primary_member'=>@$conUnit->consumers->full_name,
        //                                     'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                     'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                     'point'=>@$conUnit->consumers->point
                
        //                                 ];
        //                             }
        //                             else{
        //                                 $alldatas[] = [
        //                                     'unitid'=>@$bUnit->id,
        //                                     'consumer_unitid'=>$conUnit->id,
        //                                     'building_name'=>'',
        //                                     'unit'=>'',
        //                                     'primary_member'=>@$conUnit->consumers->full_name,
        //                                     'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
        //                                     'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
        //                                     'point'=>@$conUnit->consumers->point
                
        //                                 ];
        //                             }
                                
        //                         }
                    
        //                     }
        //                     else{
        //                         $alldatas[] = [
        //                             'unitid'=>@$bUnit->id,
        //                             'consumer_unitid'=>'',
        //                             'building_name'=>@$property->building_name,
        //                             'unit'=>@$bUnit->unit,
        //                             'primary_member'=>'Open',
        //                             'signed_up'=>'--------------',
        //                             'account_term_date'=>'--------------',
        //                             'point'=>'--------------',
        
        //                         ];
        //                     }
    
        //                 }
        //             }
                    
        //         }
        //         // foreach($allbuildings->first()->providerbuilding as $property){
                   
        //         //     $alldatas[] = [
        //         //         'unitid'=>@$property->units->first()->id,
        //         //         'building_name'=>$property->building_name,
        //         //         'unit'=>@$property->units->first() ? $property->units->first()->unit : null,
        //         //         'primary_member'=>@$property->units->first()->user ? $property->units->first()->user->full_name : null,
        //         //         'signed_up'=>@$property->units->first() ? $property->units->first()->updated_at->format('Y/m/d') : '--------------',
        //         //         'account_term_date'=>@$property->units->first()->user ? $property->units->first()->user->created_at->format('Y/m/d') : '--------------',
        //         //         'point'=>@$property->units->first()->user ? $property->units->first()->user->point : '-----------------',
        //         //         'units' =>@$property->units
        //         //     ];
                
        //         // }
                
        //     }
   
           
        //     $radiochangelist = $request->radio_change_list;
           
            
        //     $rendered = view('frontend.property-manager.ajax.smart_rental_table',compact('alldatas','propertyDetails','radiochangelist','arrayData'))->render();
        //     return response()->json(['status'=>'success','html'=>$rendered,'ajaxPath'=>$ajaxPath,'propertyDetails'=>$propertyDetails,'arrayData' => $arrayData, 'radio_change_val'=>$request->radio_change_list,'message' => $message,'consumers' => $consumers]);
        // }else{
        //     return view('frontend.property-manager.smart_rental_db',compact('user','propertyDetails','allbuildings','alldatas'));
        // }
        return view('frontend.property-manager.smart_rental_db');
    }

    public function ajaxPropertyDetails($id){
        return $propertyDetails = Provider::find($id);
     }

    public function ajaxRentalDBTable($id){
        $user = auth()->user();
        $propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$user->id)->first();
        return PropertyUnderProviderUser::where('provider_user_id',$user->id)->where('provider_id',$propertyDetails->provider_id)->with('provider','providerbuilding.units')->first();
    }


    public function checkProfile(Request $request ){
        if($request->ajax()){
            $conUnit = ConsumerUnit::find($request->unitid);
            $bUnit = BuildingUnit::find($conUnit->unit_id);
            if($conUnit){
                return response()->json(['success' => 1, 'data' => $conUnit, "redirect_url"=>url('view-consumer-profile')]);
            } else{
                return response()->json(['success' => 0]);
            }
        }
    }






}

    