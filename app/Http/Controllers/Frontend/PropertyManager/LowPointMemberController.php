<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\Apartmentbadge;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provider;
use App\Models\PropertyUnderProviderUser;
use App\Models\ConsumerUnit;
use App\Models\ProviderLimitSetting;
use App\Models\Point;
use App\Models\BuildingUnit;
use App\Models\ProviderBuilding;


class LowPointMemberController extends Controller
{

    public function lowPointBalanceMember(){
        return view('frontend.property-manager.low_point_balance_member');
    }
    // public function lowPointBalanceMember(Request $request){
    //     $user = auth()->user();
    //     $alldatas = array();
    //     $limitpoint = '';
    //     $propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$user->id)->get();
    //     $prop = $propertyDetails->first();
    //     $provider_settings = ProviderLimitSetting::where('property_id',$prop->provider_id)->first();
    //     if($provider_settings){
    //         if($provider_settings->low_point_balance != null){
    //             $limitpoint = $provider_settings->low_point_balance;
    //             $units = BuildingUnit::where('provider_id',$prop->provider_id)->pluck('unit_id');
    //             $allbadge = Apartmentbadge::with('badge_guest','badge_guest.user')->whereIn('unit_id',$units)->get();
    //             // dd($allbuildings);
    //             if($allbadge){
    //                 foreach($allbadge->badge_guest as $guests){
    //                     if($guests->user){
    //                                     if($guests->user->point <= $provider_settings->low_point_balance){
    //                                         $alldatas[] = [
    //                                             'consumer_unitid'=>$conUnit->id,
    //                                             'unitid'=>$bUnit->id,
    //                                             'building_name'=>@$property->building_name,
    //                                             'unit'=>@$bUnit->unit,
    //                                             'primary_member'=>@$conUnit->consumers->full_name,
    //                                             'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
    //                                             'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
    //                                             'point'=>@$conUnit->consumers->point
                    
    //                                         ];
    //                                     }
                                        
                                    
    //                             }
    //                             else{
    //                                 // $alldatas[] = [
    //                                 //     'unitid'=>@$bUnit->id,
    //                                 //     'building_name'=>@$property->building_name,
    //                                 //     'unit'=>@$bUnit->unit,
    //                                 //     'primary_member'=>'Open',
    //                                 //     'signed_up'=>'--------------',
    //                                 //     'account_term_date'=>'--------------',
    //                                 //     'point'=>'--------------',
        
    //                                 // ];
    //                             }
                            
                        
    //                 }
    //             }
    //             else{
    //                 $alldatas = array();
    //             }
    //         }
    //         else{
    //             // return redirect()->route('frontend.smart-rental-db')->with('error', 'Low point balance is not updated');
    //             return view('frontend.property-manager.low_point_balance_member',compact('propertyDetails','user','prop','alldatas','limitpoint'));
    //         }
    //     }
    //     else{
    //         // return redirect()->route('frontend.smart-rental-db')->with('error', 'Low point balance is not updated');
    //         return view('frontend.property-manager.low_point_balance_member',compact('propertyDetails','user','prop','alldatas','limitpoint'));
    //     }
                
    //     $ajaxPath = route('frontend.low-point-balance-member');
    //     if($request->ajax()){
    //         $alldatas = [];
    //         $message = null;
    //         $arrayData = array();
    //         $consumers = array();
    //         $limitpoint = '';
    //         $propertyDetails = Provider::find($request->id);
    //         $provider_settings = ProviderLimitSetting::where('property_id',$request->id)->first();
    //         if($provider_settings){
    //             if($provider_settings->low_point_balance != null){
    //                 $limitpoint = $provider_settings->low_point_balance;
    //                 if($request->has('unit') && $request->unit != ''){
    //                     if ($request->has('text')) {
    //                         if ($request->text == 'point') {
    //                             if($request->checked == 'nonConsumerunit'){
    //                                 $message = 'error';
    //                             }
    //                             else{
    //                                 $consumerUnit = ConsumerUnit::find($request->unit);
    //                                 if($consumerUnit){
    //                                     $building_id = $consumerUnit->provider_building_id;
    //                                     $settings = ProviderLimitSetting::where('property_id',$propertyDetails->id)->first();
    //                                     if($settings){
    //                                         if($settings->add_point != null){
    //                                             $point = new Point;
    //                                             $point->user_id = $consumerUnit->consumer_id;
    //                                             $point->point = $settings->add_point;
    //                                             $point->came_from = auth()->user()->id;
    //                                             $point->save();
    //                                             $consumer = User::find($consumerUnit->consumer_id);
    //                                             $userpoint = $consumer->point;
    //                                             $totalPoint = $userpoint + $settings->add_point;
    //                                             $consumer->point =  $totalPoint;
    //                                             $consumer->save();
    //                                             $distribute_point = $propertyDetails->points_to_distribute;
    //                                             $propertyDetails->points_to_distribute = ($distribute_point-$settings->add_point);
    //                                             $propertyDetails->save();
    //                                             $message = 'success';
    //                                         }
    //                                         else{
    //                                             $message = 'no_point';
    //                                         }
    //                                     }
    //                                     else{
    //                                         $message = 'no_point';
    //                                     } 
    //                                 }
    //                                 else{
    //                                     $message = 'error';
    //                                 }
    //                             }
                                
    //                         }
    //                         elseif($request->text == 'is_deactivate'){
    //                             if($request->checked == 'nonConsumerunit'){
    //                                 $message = 'error';
    //                             }
    //                             else{
    //                                 $consumerUnit = ConsumerUnit::find($request->unit);
    //                                 if($consumerUnit){
    //                                     $building = ProviderBuilding::find($consumerUnit->provider_building_id);
    //                                     $buildingname = $building->building_name;
    //                                     $unitname = $consumerUnit->buildingunit->unit;
    //                                     $consumername = $consumerUnit->consumers->full_name;
    //                                     $arrayData = array('buildingName' => $buildingname,'unitName' => $unitname,'consumer_name' => $consumername,'property' => $propertyDetails->name);
    //                                     $message = 'success';
    //                                 }
    //                                 else{
    //                                     $message = 'error';
    //                                 }
                                   
    //                             }
    //                         }
        
    //                         elseif ($request->text == 'single_deactivate') {
    //                             $userId = auth()->user()->id;
    //                             if($request->checked == 'nonConsumerunit'){
    //                                 $message = 'error';
    //                             }
    //                             else{
    //                                 $consumerUnit = ConsumerUnit::find($request->unit);
    //                                 //return response()->json(['status'=>$request->unit]);
    //                                 if($consumerUnit){
    //                                     $unit_id = $consumerUnit->unit_id;
    //                                     $bUnit = BuildingUnit::find($unit_id);
    //                                     if ($bUnit->consumer_id != "") {
    //                                         $bUnit->consumer_id = null;
    //                                         $bUnit->save();
    //                                     }
    //                                     $consumerUnit->delete();
    //                                     $message = 'success';
    //                                 }
    //                                 else{
    //                                     $message = 'error';
    //                                 }
    //                             }
                                    
    //                         }

    //                         elseif ($request->text == 'add_term') {
    //                             if($request->checked == 'nonConsumerunit'){
    //                                 $message = 'error';
    //                             }
    //                             else{
    //                                 $consumerUnit = ConsumerUnit::find($request->unit);
    //                                 if($consumerUnit){
    //                                     $consumer_id = $consumerUnit->consumer_id;
    //                                     $settings = ProviderLimitSetting::where('property_id',$propertyDetails->id)->first();
    //                                     if($settings){
    //                                         if($settings->term_limit != null){
    //                                             $user = User::find($consumer_id);
    //                                             if($user){
    //                                                 if($user->expiry_date != null){
    //                                                     $termdate =  date('Y-m-d', strtotime($user->expiry_date . " +".$settings->term_limit));
    //                                                     $user->expiry_date = $termdate;
    //                                                     $user->save();
    //                                                     $message = 'success';
    //                                                 }
    //                                                 elseif($user->join_date != null){
    //                                                     $termdate =  date('Y-m-d', strtotime($user->join_date . " +".$settings->term_limit));
    //                                                     $user->expiry_date = $termdate;
    //                                                     $user->save();
    //                                                     $message = 'success';
    //                                                 }
    //                                                 else{
    //                                                     $termdate =  date('Y-m-d', strtotime($user->created_at . " +1 year") ); 
    //                                                     $user->expiry_date = $termdate;
    //                                                     $user->save();
    //                                                     $message = 'success';
    //                                                 }
                                                            
    //                                             }
    //                                             else{
    //                                                 $message = 'error';
    //                                             }
    //                                         }
    //                                         else{
    //                                             $message = 'no_term';
    //                                         }
    //                                     }
    //                                     else{
    //                                         $message = 'no_term'; 
    //                                     }
    //                                 }
    //                                 else{
    //                                     $message = 'error';
    //                                 }
         
    //                             }
    //                         }

    //                     }
    //                 }

    //                 $allbuildings = PropertyUnderProviderUser::where('provider_user_id',$user->id)->where('provider_id',$request->id);
    //                 $allbuildings = $allbuildings->with('provider','providerbuilding.units.consumerunits')->first();
    //                 if($allbuildings){
    //                     foreach($allbuildings->providerbuilding as $property){
            
    //                         foreach(@$property->units  as $bUnit){
    //                             if(count($bUnit->consumerunits) > 0){
    //                                 foreach($bUnit->consumerunits as $key=>$conUnit){
    //                                     if($conUnit->consumers->point <= $provider_settings->low_point_balance){
    //                                         $alldatas[] = [
    //                                             'unitid'=>@$bUnit->id,
    //                                             'consumer_unitid'=>$conUnit->id,
    //                                             'building_name'=>@$property->building_name,
    //                                             'unit'=>@$bUnit->unit,
    //                                             'primary_member'=>@$conUnit->consumers->full_name,
    //                                             'signed_up'=>@$conUnit->consumers->updated_at->format('m-d-Y'),
    //                                             'account_term_date'=>@$conUnit->consumers->expiry_date ? date('m-d-Y', strtotime(@$conUnit->consumers->expiry_date)) : '',
    //                                             'point'=>@$conUnit->consumers->point
                    
    //                                         ];
                                            
    //                                         if($request->status == 'low_to_high'){
    //                                             usort($alldatas, fn($a, $b) => $a['point'] <=> $b['point']);
    //                                         }
    //                                         elseif($request->status == 'high_to_low'){
    //                                             usort($alldatas, fn($a, $b) => $a['point'] <=> $b['point']);
    //                                         }
    //                                         else{
    //                                             $alldatas = $alldatas;
    //                                         }
    //                                     }
                                    
    //                                 }
    //                             }   
            
    //                         }
                            
    //                     }
    //                 }

    //             }
    //         }
    //         $rendered = view('frontend.property-manager.ajax.low_point_member',compact('alldatas','propertyDetails','arrayData','limitpoint'))->render();
    //         return response()->json(['status'=>'success','html'=>$rendered,'ajaxPath'=>$ajaxPath,'propertyDetails'=>$propertyDetails,'message'=>$message,'arrayData' => $arrayData, 'consumers' => $consumers]);
    //     }
    //     return view('frontend.property-manager.low_point_balance_member',compact('propertyDetails','user','prop','alldatas','limitpoint'));
        
        
    // }

    public function addExtraPointMember(Request $request){
        if($request->ajax()){
            $user = auth()->user();
            $provider_settings = ProviderLimitSetting::where('property_id',$request->property_id)->first();
            if($provider_settings){
                if($provider_settings->low_point_balance != null){
                    $allbuildings = PropertyUnderProviderUser::with('provider','providerbuilding.units.consumerunits')
                    ->where('provider_user_id',$user->id)->where('provider_id',$request->property_id)->first();
                    if($allbuildings){
                        foreach($allbuildings->providerbuilding as $property){
                            foreach(@$property->units  as $bUnit){
                                if(count($bUnit->consumerunits) > 0){
                                    foreach($bUnit->consumerunits as $key=>$conUnit){
                                        if($conUnit->consumers->point <= $provider_settings->low_point_balance){
                                            $consumer = User::find($conUnit->consumer_id);
                                            $totalpoint = $consumer->point+$request->point;
                                            $consumer->point = $totalpoint;
                                            $consumer->save();
                                            $point = new Point;
                                            $point->user_id = $conUnit->consumer_id;
                                            $point->point = $request->point;
                                            $point->came_from = auth()->user()->id;
                                            $point->save();
                                        }
                                        // else{
                                        //     return response()->json(['status'=> 2]);
                                        // }
                                    }
                                }
                                // else{
                                //     return response()->json(['status'=> 1,'message' => 'count unit']);
                                // }
                            }
                        }
                    }
                    else{
                        return response()->json(['status'=> 1]);
                    }
                }
                else{
                    return response()->json(['status'=> 0]);
                }
            }
            else{
                return response()->json(['status'=> 0]);
            }
            return response()->json(['status'=> 3]);
                   
        }
    }
}
