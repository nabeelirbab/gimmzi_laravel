<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use App\Models\BuildingUnit;
use App\Models\MerchantLocation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Provider;
use App\Models\PropertyUnderProviderUser;
use App\Models\ProviderBuilding;
use App\Models\ProviderSubType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class AuthController extends Controller
{
    public function propertyManagerLogin(Request $request){
       
        $this->validate($request,[
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password'  =>'required|min:8',
            // 'user_type' => "required"
        ],[
            'email.required' => 'The Preferred email field is required.',
            'email.email' => 'The Preferred email must be a valid email address',
            'email.regex' => 'The Preferred email format is invalid',
            'password.required' => 'The Password field is required',
            // 'user_type.required' => 'Select a provider portal'
        ]);
        if($request->user_type != null){
            
            if($request->user_type == 'Apartment portal'){
                $provider = User::role('PROVIDER')->where('email',strtolower($request->email))->where('active',1)->first();
                if($provider){
                    
                    if(Hash::check($request->password, $provider->password)){
                        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                            return redirect()->route('frontend.property-manager-profile')->with('success','Successfully Login.');
                        }
                    }else{
                        return redirect()->back()->with('error','Password Not match.'); 
                    }
                }else{
                    return redirect()->back()->with('error','Provider not found or not active.'); 
                }
            }
            else if($request->user_type == 'Travel & Tourism Portal'){
                $user = User::where('email',strtolower($request->email))->where('active',1)->first();
                if($user){
                    if($user->travel_type == 'short-rental'){
                        $provider = User::role('SHORT TERM RENTAL PROVIDER')->where('email',strtolower($request->email))->where('active',1)->first();
                        if($provider){
                            //dd($provider);
                            if(Hash::check($request->password, $provider->password)){
                                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                                    return redirect()->route('frontend.short_term.dashboard')->with('success','Successfully Login.');
                                }
                            }else{
                                return redirect()->back()->with('error','Password Not match.'); 
                            }
                        }else{
                            return redirect()->back()->with('error','Provider not found or not active.'); 
                        }
                    }
                    else{
                        $provider = User::role('HOTEL RESORT PROVIDER')->where('email',strtolower($request->email))->where('active',1)->first();
                        if($provider){
                        
                            if(Hash::check($request->password, $provider->password)){
                                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                                    return redirect()->route('frontend.hotel_resort.dashboard')->with('success','Successfully Login.');
                                }
                            }else{
                                return redirect()->back()->with('error','Password Not match.'); 
                            }
                        }else{
                            return redirect()->back()->with('error','Provider not found or not active.'); 
                        }
                    }
                }
                else{
                    return redirect()->back()->with('error','Provider not found or not active.'); 
                }
                
                
            }
            else{
                return redirect()->back()->with('error','Provider not found or not active.'); 
            }
        }else{
            return redirect()->back()->with('error','Please select a provider portal'); 
        }
        
        
       
    }

    public function propertyManagerProfile(){
        $user = Auth::user();
        $propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$user->id)->with('provider')->get();
        
        return view('frontend.property-manager.account',compact('user','propertyDetails'));
    }

    

    public function propertyManagerLogout(){
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect()->route('frontend.index');

    }

    // public function consumerLogin(Request $request){
    //     $this->validate($request,[
    //         'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
    //         'password'  =>'required|min:8'
    //     ],[
    //         'email.required' => 'The Preferred email field is required.',
    //         'email.email' => 'The Preferred email must be a valid email address',
    //         'email.regex' => 'The Preferred email format is invalid',
    //         'password.required' => 'The Password field is required'
    //     ]);
       
    //     $consumer = User::role('CONSUMER')->where('email',strtolower($request->email))->where('active',1)->first();
    //     if($consumer){
            
    //         if(Hash::check($request->password, $consumer->password)){
    //             if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
    //                 return redirect()->route('frontend.consumer-dashboard')->with('success','Successfully Login.');
    //             }
    //         }else{
    //             return redirect()->back()->with('error','Password Not match.'); 
    //         }
    //     }else{
    //         return redirect()->back()->with('error','Consumer not found or not active.'); 
    //     }
       
    // }
    // public function consumerProfile(){
    //     $user = Auth::user();
    //     $consumerBuilding = BuildingUnit::where('consumer_id', $user->id)->with('buildings')->with('user')->get();
    //     $providerTypeName1 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 1)->get();
    //     $providerTypeName2 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 2)->get();
    //     $providerTypeName3 = ProviderSubType::with('type')->with('provider')->where('provider_type_id', 3)->get();
    //     // $providerCount = Provider::with('type')->with('provider')->where('provider_type_id', 1)->count();
    //     $location = MerchantLocation::with('businessLocation')->where('user_id', $user->id)->first();
    //     //  dd($providerType);
    //     return view('frontend.consumer.consumer-dashboard',compact('user','consumerBuilding', 'providerTypeName1', 'providerTypeName2', 'providerTypeName3', 'location'));
    // }

    // public function consumerLogout(){
    //     if (Auth::check()) {
    //         Auth::logout();
    //         return redirect()->route('frontend.index');
    //     }
    

    // }

    public function propertyloginModal(Request $request){
        
        return redirect()->route('frontend.index')->with('error_code', 'open modal');
    }

    public function changeProviderUserPassword(Request $request){
        
        if ($request->ajax()) {
        //    dd($request->new_password);
            if ($request->new_password != '') {
                if ($request->confirm_password != '') {
                    if ($request->confirm_password != $request->new_password) {
                        return response()->json(['status' => 0]);
                    } else {
                        $userid = Auth::user()->id;
                        $user = User::find($userid);
                        $user->password = $request->new_password;
                        $user->created_password = '';
                        $user->remember_token = '';
                        $user->save();
                        $details = [
                            'password' => $request->new_password,
                            'name' => Auth::user()->full_name,
                        ];
                        Mail::to(Auth::user()->email)->queue(new ResetPasswordMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['status' => 1]);
                        } else {
                            return response()->json(['status' => 4]);
                        }
                    }
                } else {
                    return response()->json(['status' => 2]);
                }
            } else {
                return response()->json(['status' => 3]);
            }
        }
    }
    

}
