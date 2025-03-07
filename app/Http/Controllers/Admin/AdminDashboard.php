<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProviderBuilding;
use App\Models\Provider;
use App\Models\BuildingUnit;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use App\Models\BusinessLocation;
use App\Models\TroubleTicket;
use App\Models\ServiceType;
use App\Models\BusinessCategory;
use App\Models\Title;
use App\Models\ProviderSubType;
use App\Models\Deal;

class AdminDashboard extends Controller
{
    public function getDashboard(){
        if(auth()->user()->role_name == 'SUPER-ADMIN'){
        
            $count['providerCount'] = User::role('PROVIDER')->where('active',1)->count();
            $count['consumerCount'] = User::role('CONSUMER')->where('active',1)->count();
            $count['merchantCount'] = User::role('MERCHANT')->where('active',1)->count();
            $count['propertyCount'] = Provider::where('status',1)->count();
            $count['buildingCount'] = ProviderBuilding::where('status',1)->count();
            $count['unitCount'] = BuildingUnit::where('status',1)->count();

            $business = BusinessProfile::withCount('locations')->where('status',1)->get();
            $count['ticketCount']  = TroubleTicket::count();
            $count['serviceCount']  = ServiceType::where('status',1)->count();
            $count['businessCount']  = BusinessCategory::where('status',1)->count();
            $count['titleCount']  = Title::where('status',1)->count();
            $count['providertypeCount']  = ProviderSubType::count();
            $count['dealCount']  = Deal::count();
            $ip = "14.97.180.194"; 
            //Get IP Address of User in PHP
            //$ip = $_SERVER['REMOTE_ADDR']; 
            //call api
            $url = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip);
            
            //decode json data
            $getInfo = json_decode($url); 
            $lat = $getInfo->geoplugin_latitude;
            $long = $getInfo->geoplugin_longitude;
            $user = User::find(auth()->user()->id);
            $user->lat = $lat;
            $user->long = $long;
            $user->save();
            return view('admin.dashboard',compact('count','business'));
        }
        else{
            return redirect('index');
        }
    }
    public function userCreateShow(){
        return view('admin.user-create');
    }
    
}
