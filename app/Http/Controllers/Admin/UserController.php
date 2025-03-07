<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Traits\FileHelperTrait;
use App\Models\Badge;
use App\Models\BadgeBoost;
use Illuminate\Support\Facades\Log;
use App\Models\BusinessProfile;
use App\Models\ConsumerBadge;
use App\Models\Provider;
use App\Models\ProviderBuilding;
use App\Models\BuildingUnit;
use Database\Seeders\UserTableSeeder;
use App\Models\BusinessLocation;
use App\Models\MerchantLocation;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create-edit', ['user' => null]);
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
    public function edit(User $user)
    {
        return view('admin.user.create-edit', compact('user'));
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

    public function point($point_id)
    {
        // $point = Point::where('user_id', $id)->get();
        return view('admin.user.point', compact('point_id'));
    }
    public function badge($id)
    {
        $badge=ConsumerBadge::where('user_id',$id)->get();
        return view('admin.user.badge',compact('badge','id'));
    }

    public function provideridVerification($id){
        $user = User::find($id);
        return view('admin.provider.id-verification', compact('user'));
    }

    public function provideridVerificationSubmit(Request $request){
        $rules = [
            'doc_verify_status' => 'required',
            'upload_doc' => 'mimes:jpeg,png,jpg',
        ];

        $this->validate(request(), $rules);
        try {
            $user = User::find($request->user_id);
            $previous_photo = $user->upload_doc;
            $user->doc_verify_status = $request->doc_verify_status;
            $user->doc_type = $request->doc_type;

            if ($request->hasFile('upload_doc')) {
                $image = $request->file('upload_doc');
                $path = public_path('/upload/doc');
                $img_name = FileHelperTrait::fileUpload($image,$path);
                if(isset($previous_photo) && file_exists($path.'/'.$previous_photo)){
                    unlink($path.'/'.$previous_photo);
                }
                $user->upload_doc = $img_name;
            }

            $user->save();

            return redirect()->route('providers.index')->withSuccess('User doc verification complete');

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function merchantidVerification($id){
        $user = User::find($id);
        return view('admin.merchant.id-verification', compact('user'));
    }

    public function merchantidVerificationSubmit(Request $request){
        $rules = [
            'doc_verify_status' => 'required',
            'upload_doc' => 'mimes:pdf,docx',
        ];

        $this->validate(request(), $rules);
        try {
            $user = User::find($request->user_id);
            $previous_photo = $user->upload_doc;
            $user->doc_verify_status = $request->doc_verify_status;
            $user->doc_type = $request->doc_type;

            if ($request->hasFile('upload_doc')) {
                $image = $request->file('upload_doc');
                $path = public_path('uploads/business_verification');
                $img_name = FileHelperTrait::fileUpload($image,$path);
                $user->upload_doc = $img_name;
            }

            $user->save();

            return redirect()->route('merchants.index')->withSuccess('User doc verification complete');

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function businessProfile($id){
        $business = BusinessProfile::where('merchant_id', $id)->first();
        return view('admin.merchant.business-profile', compact('business'));
    }


    public function getProvider(Request $request){
        if ($request->ajax()) {
            $providerUser =User::select('first_name', 'id','last_name', 'userId')->where( 'provider_id' , $request->provider_Id)->where('active', 1)->first();
            return response()->json(['success' => 1, 'data' => $providerUser]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    // public function getHotelName(Request $request){
    //     if ($request->ajax()) {
    //         $providerUser =User::select('first_name', 'id','last_name', 'userId')->where( 'provider_id' , $request->provider_Id)->where('active', 1)->first();
    //         return response()->json(['success' => 1, 'data' => $providerUser]);
    //     } else {
    //         return response()->json(['success' => 0]);
    //     }
    // }

    public function pointCreate($id){
        return view('admin.user.add-point', compact('id'));
    }

    public function pointStore(Request $request){
        $rules = [
            'point' => 'required|numeric'
        ];

        $this->validate(request(), $rules);
        try {
           
            $user = User::find($request->consumer_id);
            if($user){
                $userpoint = new Point;
                $userpoint->user_id = $request->consumer_id;
                $userpoint->point = $request->point;
                $userpoint->came_from = auth()->id();
                $userpoint->save();
                $nowpoint = $user->point;
                $totalpoint = $nowpoint+$request->point;
                $user->point = $totalpoint;
                $user->save();
                return redirect()->route('consumers.point',$request->consumer_id)->withSuccess('Point added successfully');
            }
            else{
                return redirect()->route('consumers.point',$request->consumer_id)->withError('User not found');
            }
            
        }
        catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function badgeCreate($id){
        $badge = Badge::where('status',1)->get();
        return view('admin.user.add-badge', compact('id','badge'));
    }

    public function getBoost(Request $request){
        if($request->ajax()){
            $boost = BadgeBoost::where('badges_id', $request->badge_id)->where('status',1)->get();
            
            if($boost){
                return response()->json(['success' => 1, 'data' => $boost]);
            }
            else{
                return response()->json(['success' => 0, 'data' => []]);
            }
        }
    }

    public function badgeStore(Request $request){
        $rules = [
            'badge_id' => 'required',
            'boost_id' => 'required',
        ];

        $this->validate(request(), $rules);

        try {
            $today = date('Y-m-d');
            $consumer_id = $request->consumer_id;
            $user = User::find($consumer_id);
            $boost = BadgeBoost::find($request->boost_id);
            $boostpoint = $boost->point;
            if($boost){
                $userpoint = new Point;
                $userpoint->user_id = $consumer_id;
                $userpoint->point = $boostpoint;
                $userpoint->boost_id = $request->boost_id;
                $userpoint->sign = '+';
                $userpoint->save();
                $nowpoint = $user->point;
                $totalpoint = $nowpoint+$boostpoint;
                $user->point = $totalpoint;
                $user->save();

                $consumer_badge = new ConsumerBadge;
                $consumer_badge->user_id = $consumer_id;
                $consumer_badge->badges_id = $request->badge_id;
                $consumer_badge->status = 1;
                $consumer_badge->boost_id = $request->boost_id;
                $consumer_badge->point = $boostpoint;
                $consumer_badge->badge_activate_date = $today;
                $consumer_badge->save();
                if($consumer_badge){
                    return redirect()->route('consumers.badge',$consumer_id)->withSuccess('Badge added successfully');
                }
                else{
                    return redirect()->route('consumers.badge',$consumer_id)->withError('Badge not added');
                }
            }
            else{
                return redirect()->route('consumers.badge',$consumer_id)->withError('Boost not found');
            }

        }
        catch (\Exception $e) {
            Log::error(" :: EXCEPTION :: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            abort(500);
        }
    }

    public function getMerchantType(Request $request){
        if($request->ajax()){
            $business = BusinessProfile::find($request->businessid);
            $type = $business->merchant_type;
            if($type == 'Plus'){
                $locations = BusinessLocation::where('business_profile_id',$request->businessid)->get();
                if(count($locations) > 0){
                    return response()->json(['success' => 1,'data' => $locations]);
                }
                else{
                    return response()->json(['success' => 2]);
                }
                
            }
            else{
                return response()->json(['success' => 0]);
            }
        }
    }

    public function getLocation(Request $request){
        if($request->ajax()){
            $locations = BusinessLocation::where('business_profile_id',$request->businessid)->get();
            if(count($locations) > 0){
                return response()->json(['success' => 1,'data' => $locations]);
            }
            else{
                return response()->json(['success' => 0]);
            }
        }
    }

    public function getMerchantLocation($id){
        // MerchantLocation::where('merchant_id',$id)->get();
        return view('admin.merchant.location-list', compact('id'));
    }

    // public function test(){
    //   //  https://mybusinessbusinessinformation.googleapis.com/v1/accounts/9567095907851707986/locations?readMask=title

    //     $credentials = __DIR__ . '/client_secrets.json';

    //     $client = new Google\Client();
    //     $client->setAuthConfig($credentials);
    //     $client->addScope("https://www.googleapis.com/auth/business.manage");
    //     $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    //     $client->setRedirectUri($redirect_uri);
    //     $my_business_account = new Google_Service_MyBusinessAccountManagement($client);

    //     if (isset($_GET['logout'])) { // logout: destroy token
    //         unset($_SESSION['token']);
    //     die('Logged out.');
    //     }

    //     if (isset($_GET['code'])) { // get auth code, get the token and store it in session
    //         $client->authenticate($_GET['code']);
    //         $_SESSION['token'] = $client->getAccessToken();
    //     }


    //     if (isset($_SESSION['token'])) { // get token and configure client
    //         $token = $_SESSION['token'];
    //         $client->setAccessToken($token);
    //     }

    //     if (!$client->getAccessToken()) { // auth call 
    //         $authUrl = $client->createAuthUrl();
    //         header("Location: ".$authUrl);
    //         die;
    //     }

    //     $list_accounts_response = $my_business_account->accounts->listAccounts();
    //     Var_dump($list_accounts_response);
    // }

    public function getProviderProperty($id){
        $user = User::find($id);
        return view('admin.provider-user.property-list', ['id' => $id,'name'=> $user->full_name]);
    }

    public function getMainLocation(Request  $request){
        if($request->ajax()){
            $location = BusinessLocation::whereIn('id', $request->data)->get();
            if($location){
                return response()->json(['success' => 1, 'data' => $location]);
            } else{
                return response()->json(['success' => 0]);
            }
        }
    }
    public function getSingleMainLocation(Request  $request){
        if($request->ajax()){
            $location = BusinessLocation::where('id', $request->data)->first();
            if($location){
                return response()->json(['success' => 1, 'data' => $location]);
            } else{
                return response()->json(['success' => 0]);
            }
        }
    }

    public function merchantidVerificationRemove($id){
       $user =  User::find($id);
       if($user){
        $imagepath = public_path('uploads/business_verification/'.$user->upload_doc);
        if(File::exists($imagepath)){
            File::delete($imagepath);
            $user->upload_doc = '';
            if($user->doc_verify_status != 0){
                $user->doc_verify_status = 0;
            }
            if($user->doc_type != 'needs_review'){
                $user->doc_type = 'needs_review';
            }
            $user->save();
            return redirect()->route('admin.merchant.id-verification',$id)->withSuccess('Document removed successfully...');
        }
        else{
            return redirect()->route('admin.merchant.id-verification',$id)->withError('Document not found...');
        }
       }
       else{
         return redirect()->route('admin.merchant.id-verification',$id)->withError('User not found...');
       }
    }

    public function getTravelTourismUser(){
        return view('admin.travel-tourism-user.list');
    }

    public function createTravelTourismUser(){
        return view('admin.travel-tourism-user.create-edit', ['user' => null]);
    }

    public function editTravelTourismUser($id){
        $user = User::find($id);
        return view('admin.travel-tourism-user.create-edit', ['user' => $user]);
    }
}
