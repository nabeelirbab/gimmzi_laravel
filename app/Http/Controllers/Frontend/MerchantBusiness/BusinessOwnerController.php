<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Title;
use  Hash, DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Deal;
use App\Mail\MerchantRegistrationMail;
use App\Models\BusinessCategory;
use App\Models\ServiceType;
use App\Models\State;
use Illuminate\Validation\Rule;
use App\Models\BusinessProfile;
use App\Models\ItemOrService;
use App\Models\SuggestedDescription;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Support\Facades\Log;
use App\Mail\CreateBusinessProfileMail;
use App\Mail\MerchantForgetPasswordMail;
use App\Mail\MerchantResetPasswordMail;
use App\Mail\NewPasswordLinkMail;
use App\Models\DealLocation;
use App\Models\GiftItemValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\MerchantTitle;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\BusinessLocation;
use App\Models\BusinessVideo;
use App\Models\MerchantLocation;
use Illuminate\Support\Facades\Hash as FacadesHash;

class BusinessOwnerController extends Controller
{
    public function index() 
    {
        if (Auth::check()) {
            $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();

            if ($deal) {
                $deallocation = Deallocation::where('deal_id', $deal->id)->delete();
                $deal->delete();
            }
        }
        Session::forget('merchant_id');
        return view('frontend.merchant_owner.index');
    }

    public function merchantLogin(Request $request)
    {
        // dd();
        $rules = [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            // 'password' => 'required'
        ];

        $customMessages = [
            'email.required' => 'The Preferred email field is required.',
            'email.email' => 'The Preferred email must be a valid email address',
            'email.regex' => 'The Preferred email format is invalid',
            // 'password.required' => 'The Password field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()->with('merchant_error_code', 'Incorrect email or password');
        }

        // $this->validate($request, $rules, $customMessages);
        

        $merchantemail = strtolower($request->email);
        $merchant = User::where('email', $merchantemail)->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'MERCHANT');
            }
        )->where('active', 1)->first();

        if (is_null($merchant)) {
            return back()->with('merchant_error_code', 'Incorrect email or password');
        } else {
            // dd('sdsdvdsv');
            Session::put('email_address', $request->email);
            Session::put('merchant_pass', $merchant->password);
            // dd(Session::get('email_address'));

            return back()->with('valid_email', 'valid email');
            // if (FacadesHash::check($request->password, $merchant->password)) {
            //     if (Auth::attempt(['email' => $merchantemail, 'password' => $request->password])) {
            //         $user = User::where(["email" => $merchantemail])->first();
                    
            //         Auth::login($user);
            //         return redirect()->route('frontend.business_owner.account')->with('success', 'Login Successfully');
            //     }
            // } else {
            //     return redirect()->route('frontend.business_owner.index')->with('merchant_error', 'Incorrect password');
            // }
        }
    }

    public function merchantLoginPassword(Request $request){
        // dd($request->all());

        $rules = [
            'password' => 'required'
        ];

        $customMessages = [
            'password.required' => 'The Password field is required'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            return back()->with('merchant_error_code', 'Incorrect email or password');
        }
        $email = Session::get('email_address');
        $merchantemail = strtolower($email);
        $merchant_password = Session::get('merchant_pass');

        Session::forget('email_address');
        Session::forget('merchant_pass');

        // dd(Session::get('email_address'));

        if (FacadesHash::check($request->password, $merchant_password)) {
            if (Auth::attempt(['email' => $merchantemail, 'password' => $request->password])) {
                $user = User::where(["email" => $merchantemail])->first();
                
                Auth::login($user);
                return redirect()->route('frontend.business_owner.account')->with('success', 'Login Successfully');
            }
        } else {
            return redirect()->route('frontend.business_owner.index')->with('merchant_error', 'Incorrect password');
        }

    }
    public function merchantLogout()
    {
        if (Auth::check()) {
            $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal) {
                $deal->delete();
            }
            Auth::logout();
        }
        return redirect()->route('frontend.business_owner.index');
    }

    public function businessUserLogin()
    {
        if (Session::get('merchant_id') == '') {
            Session::forget('merchant_id');
        }

        return view('frontend.merchant_owner.auth.userLogin');
    }

    public function createBusinessUserLogin(Request $request)
    {

        Session::forget('merchant_id');
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'phone' => 'required|unique:users,phone|max:12|min:10',
            'phone_ext' => 'nullable|max:3|min:1',
        ];

        $customMessages = [
            'name.required' => 'The First & Last Name field is required.',
            'email.required' => 'The Preferred Email field is required.',
            'email.email' => 'The Preferred Email must be a valid email address',
            'email.unique' => 'The Preferred Email has already been taken',
            'email.regex' => 'The Preferred Email format is invalid',
            'phone.required' => 'The Preferred Phone field is required',
            'phone.unique' => 'The Preferred Phone has already been taken',
            'phone.max' => 'The Preferred Phone may not be greater than 12 characters',
            'phone.min' => 'The Preferred Phone must be at least 10 characters',
            'phone_ext.max' => 'The Phone Ext may not be greater than 3 characters',
            'phone_ext.min' => 'The Phone Ext must be at least 1 characters',
        ];
        $this->validate($request, $rules, $customMessages);
        $splitName = explode(' ', $request->name, 2); // Restricts it to only 2 values, for names like Billy Bob Jones
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';

        //$title = Title::where('title_name', 'Corporate System Admin')->first();
        $code = rand(100000, 999999);

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'active' => true,
            'validation_code' => $code
        ]);
        $user->assignRole('MERCHANT');
        $merchantid = strtoupper(substr($user->first_name, 0, 3)) . '/MER/0' . $user->id;
        if ($request->mail_receive != null) {
            $user->is_subscribe = 1;
            $user->userId = $merchantid;
            $user->save();
        }

        if ($user) {
            $details = [
                'email'  =>  $request->email,
                'validation_code' => $code,
                'name' => $request->name,
            ];

            Mail::to($request->email)->queue(new MerchantRegistrationMail($details));
            if (!Mail::failures()) {
                Session::put('merchant_id', $user->id);
                return back()->with('succes_merchant_reg', 'Registration Done');
            } else {
                return redirect()->route('frontend.business_owner.login')->with('error', 'Something Went Wrong!!');
            }
        }
    }

    public function createValidationBusiness()
    {
        $merchant_titles = MerchantTitle::get();
        if (Session::get('merchant_id')) {
            $user = User::find(Session::get('merchant_id'));
            return view('frontend.merchant_owner.auth.validate_business_account', compact('user', 'merchant_titles'));
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }


    public function saveBusinessValidation(Request $request)
    {
        $merchant_id = Session::get('merchant_id');
        $user = User::find($merchant_id);
        // dd($request->all());
        $rules = [
            'validation_code' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:new_password',
            'merchant_title_id' => 'required',
            'official_title' => 'required_if:merchant_title_id,=,not_owner',
            'verification_file' => 'mimes:pdf,docx',
            'not_verified' =>   'required_without:verification_file',
        ];

        $customMessages = [
            'validation_code.required' => 'The Validation Code field is required.',
            'validation_code.same' => 'The Validation Code does not match',
            'new_password.required' => 'The New Password field is required.',
            'new_password.min' => 'The New Password must be at least 6 characters',
            'confirm_password.required' => 'The Confirm Password field is required.',
            'confirm_password.min' => 'The Confirm Password must be at least 6 characters',
            'confirm_password.same' => 'The Confirm password is not same with New password',
            'merchant_title_id.required' => 'The Title field is required.',
            'official_title.required_if' => 'The Official Title field is required.',
            'verification_file.mimes' => 'The Business Verification file type must be pdf or doc',
            'not_verified.required_without' => 'Please click on checkbox when business verification is not present'
        ];
        $this->validate($request, $rules, $customMessages);

        $title = Title::where('title_name', 'Corporate System Admin')->first();
        if ($user) {
            // dd($user->remember_token);
            if ($request->validation_code == (int)$user->validation_code) {
                $user->validation_code = '';
                $user->password = $request->new_password;
                if ($request->merchant_title_id == 'not_owner') {
                    $user->official_title = $request->official_title;
                    $user->title_id = $title->id;
                } else {
                    $user->merchant_title_id = $request->merchant_title_id;
                    $user->title_id = $title->id;
                }
                if ($request->hasFile('verification_file')) {
                    $fileName = time() . '.' . $request->verification_file->extension();
                    $request->verification_file->move(public_path('uploads/business_verification'), $fileName);
                    $user->upload_doc = $fileName;
                    $user->doc_verify_status = 0;
                    $user->doc_type = 'needs_review';
                } else {
                    $user->doc_verify_status = 0;
                    $user->doc_type = 'needs_review';
                }
                $user->save();
                return redirect()->route('frontend.business_owner.select_solution')->with('success', 'Account validated successfully..');
            } else {

                return back()->with('error', 'Validation Code is not matched')->withInput();;
            }
        } else {
            return redirect()->route('frontend.business_owner.create_validation_business')->with('error', 'User not found');
        }
    }

    public function solutionView()
    {
        //dd(Session::get('merchant_id'));
        if (Session::get('merchant_id')) {
            return view('frontend.merchant_owner.auth.solution');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function storeSolution(Request $request)
    {

        Session::forget('type');
        if ($request->type != '') {
            Session::put('type', $request->type);
            return response()->json(['success' => 1]);
        } else {
            Session::forget('type');
            return response()->json(['success' => 0]);
        }
    }

    public function createBusinessProfile()
    {
        //dd(Session::get('merchant_id'));
        //dd(Session::get('type'));

        $category = BusinessCategory::where('status', 1)->get();
        $services = ServiceType::where('status', 1)->get();
        $stateList = State::get();
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;
            } else {
                $profile = '';
            }
        }
        if (Session::get('merchant_id') && Session::get('type')) {
            return view('frontend.merchant_owner.auth.create_business_profile', compact('category', 'stateList', 'services', 'profile'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function getServiceType(Request $request)
    {
        if ($request->ajax()) {
            $service = ServiceType::where('category_id', $request->category_id)->orderBy('service_name')->get();

            if ($service) {
                return response()->json(['success' => 1, 'data' => $service]);
            } else {
                return response()->json(['success' => 0, 'data' => []]);
            }
        }
    }

    public function getCity(Request $request)
    {
        if ($request->ajax()) {
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
            //return response()->json(['success' => 1, 'data' => $response]);
            $xml = simplexml_load_string($response) or die("Error: Cannot create object");
            //return response()->json(['success' => 1, 'data' => $xml]);
            if ($xml->ZipCode->City) {
                $state = State::where('code', $xml->ZipCode->State)->first();
                $id = $state->id;
                return response()->json(['success' => 1, 'data' => $xml->ZipCode, 'state_name' => $id]);
            } else {
                $error = $xml->ZipCode->Error->Description;
                return response()->json(['success' => 0, 'data' => $error]);
            }
        }
    }

    public function storeBusinessProfile(Request $request)
    {
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                return redirect()->route('frontend.business_owner.create_business_address')->with('success', 'Business profile created sucessfully..');
            } else {

                if ($request->business_type != "") {
                    if ($request->business_type == "Mobile Business" || $request->business_type == "Online Only") {
                        $rules = [
                            'business_category_id' => 'required',
                            'business_name' => 'required',
                            'service_type_id' => 'required',
                            'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                            'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                        ];

                        $customMessages = [
                            'business_category_id.required' => 'The Business Category field is required',
                            'business_name.required' => 'The Business Name field is required',
                            'service_type_id.required' => 'The Service Type field is required',
                            'business_phone.required' => 'The Business Phone Number field is required',
                            'business_phone.max' => 'The Business Phone Number may not be greater than 12 characters',
                            'business_phone.min' => 'The Business Phone Number must be at least 10 characters',
                            'business_phone.unique' => 'The Business Phone Number has already been taken',
                            'business_email.required' => 'The Business Email field is required',
                            'business_email.email' => 'The Business Email must be a valid email address',
                            'business_email.unique' => 'The Business Email has already been taken',
                            'business_email.regex' => 'The Business Email format is invalid',
                            'business_fax_number.unique' => 'The Business Fax Number has already been taken',
                            'business_fax_number.min' => 'The Business Fax Number must be at least 6 characters',
                        ];

                        $this->validate($request, $rules, $customMessages);
                    } else {
                        $rules = [
                            'business_category_id' => 'required',
                            'business_name' => 'required',
                            'service_type_id' => 'required',
                            'business_type' => 'required',
                            'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                            'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                            'business_fax_number' => 'nullable|unique:business_profiles,business_fax_number|min:6',
                        ];

                        $customMessages = [
                            'business_category_id.required' => 'The Business Category field is required',
                            'business_name.required' => 'The Business Name field is required',
                            'service_type_id.required' => 'The Service Type field is required',
                            'business_type.required' => 'The Business Type field is required',
                            'business_phone.required' => 'The Business Phone Number field is required',
                            'business_phone.max' => 'The Business Phone Number may not be greater than 12 characters',
                            'business_phone.min' => 'The Business Phone Number must be at least 10 characters',
                            'business_phone.unique' => 'The Business Phone Number has already been taken',
                            'business_email.required' => 'The Business Email field is required',
                            'business_email.email' => 'The Business Email must be a valid email address',
                            'business_email.unique' => 'The Business Email has already been taken',
                            'business_email.regex' => 'The Business Email format is invalid',
                            'business_fax_number.unique' => 'The Business Fax Number has already been taken',
                            'business_fax_number.min' => 'The Business Fax Number must be at least 6 characters',
                        ];

                        $this->validate($request, $rules, $customMessages);
                    }
                } else {
                    $rules = [
                        'business_category_id' => 'required',
                        'business_name' => 'required',
                        'service_type_id' => 'required',
                        'business_type' => 'required',
                        'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                        'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                        'business_fax_number' => 'nullable|unique:business_profiles,business_fax_number|min:6',
                    ];

                    $customMessages = [
                        'business_category_id.required' => 'The Business Category field is required',
                        'business_name.required' => 'The Business Name field is required',
                        'service_type_id.required' => 'The Service Type field is required',
                        'business_type.required' => 'The Business Type field is required',
                        'business_phone.required' => 'The Business Phone Number field is required',
                        'business_phone.max' => 'The Business Phone Number may not be greater than 12 characters',
                        'business_phone.min' => 'The Business Phone Number must be at least 10 characters',
                        'business_phone.unique' => 'The Business Phone Number has already been taken',
                        'business_email.required' => 'The Business Email field is required',
                        'business_email.email' => 'The Business Email must be a valid email address',
                        'business_email.unique' => 'The Business Email has already been taken',
                        'business_email.regex' => 'The Business Email format is invalid',
                        'business_fax_number.unique' => 'The Business Fax Number has already been taken',
                        'business_fax_number.min' => 'The Business Fax Number must be at least 6 characters',
                    ];

                    $this->validate($request, $rules, $customMessages);
                }
                // if ($request->number_of_location > 1) {
                //     $merchanttype = 'Plus';
                // } else {
                //     $merchanttype = 'Basic';
                // }
                if ($request->business_fax_number) {
                    $faxnumber = $request->business_fax_number;
                } else {
                    $faxnumber = '';
                }
                if ($request->business_page_link) {
                    $pagelink = $request->business_page_link;
                } else {
                    $pagelink = '';
                }
                $profileArray = array(
                    'business_category_id' => $request->business_category_id,
                    'business_name' => $request->business_name,
                    'business_page_link' => $pagelink,
                    'status' => 2,
                    'merchant_id' => Session::get('merchant_id'),
                    'service_type_id' => $request->service_type_id,
                    //'merchant_type' => $merchanttype,
                    'business_type' => $request->business_type,
                    'state_id' => $request->state_id,
                    'business_phone' => $request->business_phone,
                    'business_email' => $request->business_email,
                    'business_phone' => $request->business_phone,
                    'business_fax_number' => $faxnumber,
                    'no_physical_address' => false,
                    'same_address' => true,
                    'solution_type' => Session::get('type')
                );
                $profile = BusinessProfile::create($profileArray);
                //dd($profile );

                if ($request->allow_notification != null) {
                    $notification = true;
                } else {
                    $notification = false;
                }
                $businessid = strtoupper(substr($profile->business_name, 0, 3)) . '/0' . $profile->id;
                $profile->businessId = $businessid;
                $profile->allow_notification = $notification;
                $profile->save();
                $user = User::find(Session::get('merchant_id'));
                $user->business_id = $profile->id;
                $user->save();
                if ($profile) {
                    return redirect()->route('frontend.business_owner.create_business_address')->with('success', 'Business profile created sucessfully..');
                } else {
                    return redirect()->route('frontend.business_owner.create_business_profile')->with('error', 'Something Went Wrong!!');
                }
            }
        }
    }

    public function createBusinessAddress()
    {
        //dd(Session::get('merchant_id'));
        //dd(Session::get('type'));

        $category = BusinessCategory::where('status', 1)->get();
        $services = ServiceType::where('status', 1)->get();
        $stateList = State::get();
        // $profile = "";
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;
            } else {
                $profile = '';
            }
        }
        //dd($profile);
        // return view('frontend.merchant_owner.auth.create_business_address', compact('category', 'stateList', 'services', 'profile'));
        if (Session::get('merchant_id') && Session::get('type')) {
            return view('frontend.merchant_owner.auth.create_business_address', compact('category', 'stateList', 'services', 'profile'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function storeBusinessAddress(Request $request)
    {
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile->mailing_address != '') {
                return redirect()->route('frontend.business_owner.upload_business_photo')->with('success', 'Business profile created sucessfully..');
            } else {
                //dd($request->same_address);
                if ($request->no_physical_address == "") {
                    $rules = [
                        'street_address' => 'required',
                        'zip_code' => 'required',
                        'city' => 'required',
                        'state_id' => 'required',
                        'mailing_address' => 'required',
                        'mailing_zip_code' => 'required',
                        'mailing_city' => 'required',
                        'mailing_state_id' => 'required'
                    ];

                    $customMessages = [
                        'street_address.required' => 'The Street Address field is required',
                        'zip_code.required' => 'The Zip Code field is required',
                        'city.required' => 'The City field is required',
                        'state_id.required' => 'The State field is required',
                        'mailing_address.required' => 'The Mailing Address field is required',
                        'mailing_zip_code.required' => 'The Mailing Zip Code field is required',
                        'mailing_city.required' => 'The Mailing City field is required',
                        'mailing_state_id.required' => 'The Mailing State field is required',
                    ];

                    $this->validate($request, $rules, $customMessages);
                    $profile->street_address = $request->street_address;
                    $profile->zip_code = $request->zip_code;
                    $profile->city = $request->city;
                    $profile->state_id = $request->state_id;
                    $profile->mailing_address = $request->mailing_address;
                    $profile->mailing_city = $request->mailing_city;
                    $profile->mailing_zipcode = $request->mailing_zip_code;
                    $profile->mailing_state_id = $request->mailing_state_id;
                    if ($request->same_address == "on") {
                        $profile->same_address = true;
                    } else {
                        $profile->same_address = false;
                    }
                    $profile->no_physical_address = false;
                    $profile->save();
                } elseif ($request->no_physical_address == "on") {
                    $rules = [
                        'mailing_address' => 'required',
                        'mailing_zip_code' => 'required',
                        'mailing_city' => 'required',
                        'mailing_state_id' => 'required'
                    ];

                    $customMessages = [
                        'mailing_address.required' => 'The Mailing Address field is required',
                        'mailing_zip_code.required' => 'The Mailing Zip Code field is required',
                        'mailing_city.required' => 'The Mailing City field is required',
                        'mailing_state_id.required' => 'The Mailing State field is required',
                    ];

                    $this->validate($request, $rules, $customMessages);
                    $profile->mailing_address = $request->mailing_address;
                    $profile->mailing_city = $request->mailing_city;
                    $profile->mailing_zipcode = $request->mailing_zip_code;
                    $profile->mailing_state_id = $request->mailing_state_id;
                    if ($request->same_address == "on") {
                        $profile->same_address = true;
                    } else {
                        $profile->same_address = false;
                    }
                    $profile->no_physical_address = true;
                    $profile->save();
                }
                return redirect()->route('frontend.business_owner.upload_business_photo');
            }
        }
    }

    public function uploadBusinessPhoto()
    {


        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;

                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
                //dd($logo);
                if (($logo != null) || ($photos != null)) {
                    $images = 'images';
                } else {
                    $images = '';
                }
            } else {
                $profile = '';
                $images = '';
            }

            return view('frontend.merchant_owner.auth.business_logo_photo', compact('profile', 'images', 'photos', 'logo'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    
    public function merchantSaveBusinessPhoto(Request $request)
    {
        $merchant_id = Session::get('merchant_id');
        $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
        $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
        if($request->hasFile('business_logo')){
            $validator  =   Validator::make($request->all(), [
                "business_logo" => 'mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
            }
            if($logo != ''){
                $logo->delete();
                $fileAdders = $profile->addMedia($request->business_logo->getRealPath())
                             ->usingName($request->business_logo->getClientOriginalName())
                             ->toMediaCollection('businessProfileLogo');
            }
            else{
                $fileAdders = $profile->addMedia($request->business_logo->getRealPath())
                             ->usingName($request->business_logo->getClientOriginalName())
                             ->toMediaCollection('businessProfileLogo');
            }
        }
        if($request->hasFile('business_photos')){
            $validator  =   Validator::make($request->all(), [
                "business_photos.*" => 'mimes:png,jpg,jpeg',
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 3, "validation_errors" => $validator->errors()->first()]);
            }
            $fileAdders = $profile->addMultipleMediaFromRequest(['business_photos'])
                        ->each(function ($fileAdder) {
                            $fileAdder->toMediaCollection('businessProfilePhoto');
                        });

        }
        if ($request->main_image_id != '') {
            $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
            foreach ($photos as $key => $data) {
                if ($key == $request->main_image_id) {
                    $profile->main_image = $data->getUrl();
                    $profile->save();
                }
            }
        }

        if($request->hasFile('business_media')){
            $validator  =   Validator::make($request->all(), [
                "business_media" => 'mimes:mp4',
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 4, "validation_errors" => $validator->errors()->first()]);
            }
            $name = time() . rand(1, 100) . '.' . $request->business_media->extension();
            $path = $request->business_media->storeAs('public/business_video', $name);
            if($profile->video != ''){
                $profile->video = '';
                $profile->save();
            }
            $profile->video = 'business_video/' . $name;
            $profile->save();
        }
        return response()->json(['status' => 1]);

    }


    public function checkBusinessImage(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                if (count($photos) > 0) {
                    return response()->json(['status' => 1]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
        }
    }

    public function removeBusinessImage(Request $request){
        if ($request->ajax()) {
            //return response()->json(['status' => $request->all()]);
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
            if($request->type == 'main'){
                $profile->main_image = '';
                $profile->save();
            }
            if(count($photos) > 0){
                foreach($photos as $key=>$data){
                    if($request->image_id == $key){
                        $data->delete();
                        return response()->json(['status' => 1]);
                    }
                }
            }
            return response()->json(['status' => 0]);
        }
    }


    public function merchantCreateDealStep1()
    {
        //dd(Session::get('merchant_id'));
        //dd(Session::get('type'));
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = '';
                }
            } else {
                $profile = '';
            }
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            return view('frontend.merchant_owner.auth.create_deal_step1', compact('profile', 'deal', 'photos'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function merchantSaveDealStep1(Request $request)
    {
        //dd(Session::get('merchant_id'));
        //dd(Session::get('type'));
        $merchant_id = Session::get('merchant_id');
        if ($request->id == '') {
            if ($request->start_on != '') {
                $enddate =  date('Y-m-d', strtotime('+30 days', strtotime($request->start_on)));
                $today = date('Y-m-d');
                $afterdate = date('Y-m-d', strtotime('-1 days', strtotime($today)));
                $rules = [
                    'start_on' => 'required|after:'.$afterdate,
                    'end_on' => 'nullable|after:' . $enddate . ''
                ];
            } else {
                $today = date('Y-m-d');
                $afterdate = date('Y-m-d', strtotime('-1 days', strtotime($today)));
                $rules = [
                    'start_on' => 'required|after:'.$afterdate,
                    'end_on' => 'nullable|after:start_on +30 day'
                ];
            }


            $customMessages = [
                'start_on.required' => 'The Start Date field is required',
                'start_on.after'=> 'The Start Date should be after yesterday',
                'end_on.after' => 'The End Date can not be less than 30 days from start date'
            ];
            $this->validate($request, $rules, $customMessages);
            $business = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $deal = new Deal;
            $deal->merchant_id = $merchant_id;
            $deal->business_id = $business->id;
            $deal->start_Date = $request->start_on;
            if ($request->end_on != '') {
                $deal->end_Date = $request->end_on;
            }
            $deal->save();
        } else {
            $olddeal = Deal::find($request->id);
            if ($request->start_on != '')
                $olddeal->start_Date = $request->start_on;
            if ($request->end_on != '') {
                $olddeal->end_Date = $request->end_on;
            }
            $olddeal->save();
        }
        return redirect()->route('frontend.business_owner.deal_create_photo');
    }

    public function merchantCreateDealPhoto()
    {
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = '';
                }
            } else {
                $profile = '';
            }
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
                $dealphotos = Media::where(['model_id' => $deal->id, 'collection_name' => 'dealPhotos'])->get();
                if ($dealphotos) {
                    $dealphotos = $dealphotos;
                } else {
                    $dealphotos = NULL;
                }
                if ($deal->main_image) {
                    $maindealimage = $deal->main_image;
                } else {
                    $maindealimage = NULL;
                }
            } else {
                $deal = '';
            }
            return view('frontend.merchant_owner.auth.merchant_deal_photo', compact('profile', 'deal', 'photos', 'dealphotos', 'maindealimage'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }
    public function merchantSaveDealPhoto(Request $request)
    {
        if ($request->id == '') {
            $rules = [
                'deal_image' => 'required|max:25600',
                'main_deal_image' => 'required|max:25600',

            ];
            $customMessages = [
                'deal_image.required' => 'The Deal Image field is required',
                'deal_image.max' => 'The Deal Image size can be maximum 25 MB',
                'main_deal_image.required' => 'The Main Deal Image field is required',
                'main_deal_image.max' => 'The Main Deal Image size can be maximum 25 MB',

            ];
            $this->validate($request, $rules, $customMessages);
            $merchant_id = Session::get('merchant_id');
            if ($request->hasFile('deal_image')) {
                $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
                if ($deal) {
                    // dd($deal);
                    if ($request->hasFile('deal_image')) {
                        $fileAdders = $deal->addMultipleMediaFromRequest(['deal_image'])
                            ->each(function ($fileAdder) {
                                $fileAdder->toMediaCollection('dealPhotos');
                            });
                    }
                }
            }
            if ($request->hasFile('main_deal_image')) {
                $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
                if ($deal) {
                    // dd($deal);
                    if ($request->hasFile('main_deal_image')) {
                        $fileAdders = $deal->addMedia($request->main_deal_image->getRealPath())
                            ->usingName($request->main_deal_image->getClientOriginalName())
                            ->toMediaCollection('mainDealPhoto');
                    }
                }
            }
        } else {
            $merchant_id = Session::get('merchant_id');
            $olddeal =  Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($request->TotalFiles > 0) {
                if ($request->hasFile('deal_image')) {
                    $validator  =   Validator::make($request->all(), [
                        "deal_image.*" => 'mimes:png,jpg,jpeg',
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 3, "validation_errors" => $validator->errors()->first()]);
                    }
                    $fileAdders = $olddeal->addMultipleMediaFromRequest(['deal_image'])
                        ->each(function ($fileAdder) {
                            $fileAdder->toMediaCollection('dealPhotos');
                        });
                    if ($request->main_image_id != '') {
                        if ($olddeal) {
                            $photos = Media::where(['model_id' => $olddeal->id, 'collection_name' => 'dealPhotos'])->get();
                            foreach ($photos as $key => $data) {
                                if ($key == $request->main_image_id) {
                                    $olddeal->main_image = $data->getUrl();
                                }
                            }
                            $olddeal->save();
                        }
                    }
                }
                return response()->json(['status' => 1]);
            } else {
                if ($request->main_image_id != '') {
                    $merchant_id = Session::get('merchant_id');
                    $olddeal =  Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
                    $photos = Media::where(['model_id' => $request->id, 'collection_name' => 'dealPhotos'])->get();
                    if ($photos) {
                        foreach ($photos as $key => $data) {
                            if ($key == $request->main_image_id) {
                                $olddeal->main_image = $data->getUrl();
                            }
                        }
                        $olddeal->save();
                    }
                    return response()->json(['status' => 1]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }

            //}
        }

        //return redirect()->route('frontend.business_owner.deal_create_step2');
    }

    public function merchantRemoveDealPhoto(Request $request)
    {
        if ($request->ajax()) {
            $media = Media::find($request->imageid);
            //$merchant_id = Session::get('merchant_id');
            $olddeal =  Deal::find($media->model_id);
            if ($olddeal->main_image != null) {
                if ($olddeal->main_image == $media->getUrl()) {
                    return response()->json(['status' => 0]);
                } else {
                    $media->delete();
                    return response()->json(['status' => 1]);
                }
            } else {
                $media->delete();
                return response()->json(['status' => 1]);
            }
        }
    }

    public function merchantConfirmRemoveDealPhoto(Request $request)
    {
        if ($request->ajax()) {
            $media = Media::find($request->imageid);
            $olddeal =  Deal::find($media->model_id);
            $olddeal->main_image = '';
            $olddeal->save();
            $media->delete();
            return response()->json(['status' => 1]);
        }
    }

    public function checkDealPhoto(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Session::get('merchant_id');
            $olddeal =  Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($olddeal) {
                $photos = Media::where(['model_id' => $olddeal->id, 'collection_name' => 'dealPhotos'])->get();
                if (count($photos) > 0) {
                    return response()->json(['status' => 1]);
                } else {
                    return response()->json(['status' => 0]);
                }
            }
        }
    }

    public function merchantCreateDealStep2()
    {
        //dd(Session::get('type'));
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $user = User::find($merchant_id);
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = NULL;
                }
            } else {
                $profile = '';
            }
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            $business_category_id = $profile->business_category_id;
            $categoryData = BusinessCategory::find($business_category_id);
            $items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->get();
            $description = SuggestedDescription::where('status', 1)->where('business_id', $business_category_id)->get();
            return view('frontend.merchant_owner.auth.create_deal_step2', compact('profile', 'deal', 'description', 'photos', 'items', 'categoryData', 'user'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function merchantSaveDealStep2(Request $request)
    {
        // dd(Session::get('merchant_id'));
        //dd($request->all());
        $merchant_id = Session::get('merchant_id');
        $rules = [
            'description' => 'required',
            'original_price' => 'required|numeric|max:9999999',
            'discount_type' => 'required',
            'discount_amount' => 'required|max:999999',
            'bogo_type' => 'required',
            'item_id' => 'required'
        ];
        $customMessages = [
            'description.required' => 'The Description field is required',
            'original_price.required' => 'The Original Sales Price field is required',
            'original_price.numeric' => 'The Original Sales Price should be a number',
            'discount_type.required' => 'The Discount Type field is required',
            'discount_amount.required' => 'The Discount Amount field is required',
            'bogo_type.required' => 'The Bogo Type field is required',
            'item_id.required' => 'Select a item'
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->id) {
            $olddeal = Deal::find($request->id);
            $olddeal->item_id = $request->item_id;
            if ($request->bogo_type != '') {
                if ($request->bogo_type == 'bogo_yes')
                    $olddeal->is_bogo = true;
                else
                    $olddeal->is_bogo = false;
            }
            if ($request->description != '') {
                $olddeal->suggested_description = $request->description;
            }
            if ($request->original_price != '') {
                $olddeal->sales_amount = $request->original_price;
            }
            if ($request->discount_type != '') {
                $olddeal->discount_type = $request->discount_type;
            }
            if ($request->discount_amount != '') {
                $olddeal->discount_amount = $request->discount_amount;
            }
            if ($request->point != '') {
                $olddeal->point = $request->point;
            }
            if ($request->terms_conditions != '') {
                $olddeal->terms_conditions = $request->terms_conditions;
            }

            $olddeal->save();
        } else {
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal) {
                if ($request->bogo_type == 'bogo_yes')
                    $deal->is_bogo = true;
                else
                    $deal->is_bogo = false;
                $deal->suggested_description = $request->description;
                $deal->sales_amount = $request->original_price;
                $deal->discount_type = $request->discount_type;
                $deal->discount_amount = $request->discount_amount;
                $deal->point = $request->point;
                $deal->item_id = $request->item_id;
                $deal->terms_conditions = $request->terms_conditions;
                $deal->save();
            }
        }
        return redirect()->route('frontend.business_owner.deal_create_step3');
    }

    public function merchantCreateDealStep3()
    {

        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::with('states', 'locations', 'mailingstates')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $stateList = State::all();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = NULL;
                }
            } else {
                $profile = '';
            }
            $deal = Deal::with('dealLocation')->where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            $business_category_id = $profile->business_category_id;

            return view('frontend.merchant_owner.auth.create_deal_step3', compact('profile', 'deal', 'photos', 'stateList', 'photos', 'logo'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function merchantSaveDealStep3(Request $request)
    {
        $merchant_id = Session::get('merchant_id');
        //   dd($merchant_id);
        $user = User::find($merchant_id);
        $profile = BusinessProfile::with('locations')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();

        if (($profile->business_type == 'Mobile Business') || ($profile->business_type == 'Online Only')) {
            if ($request->voucher_number == '') {
                if ($request->voucher_unlimited == null) {
                    $rules = [
                        'voucher_number' => 'required|gt:15',
                    ];
                    $customMessages = [
                        'voucher_number.required' => 'Please enter number of voucher or check the unlimited checkbox',
                    ];
                    $this->validate($request, $rules, $customMessages);
                }
            } else {
                if ($request->voucher_unlimited == null) {
                    $rules = [
                        'voucher_number' => 'gt:14',
                    ];
                    $customMessages = [
                        'voucher_number.required' => 'Voucher number must be greater than 14',
                    ];
                    $this->validate($request, $rules, $customMessages);
                }
                // dd($profile->business_type );
            }
        } else {

            if (($request->voucher_number != '') && ($request->voucher_unlimited == null)) {
                $rules = [
                    'voucher_number' => 'gt:14',
                    'physical_location' => 'required|numeric'
                ];
                $customMessages = [
                    'voucher_number.gt' => 'Voucher number must be greater than 14',
                    'physical_location.required' => 'The Number of Physical Location field is required',
                    'physical_location.numeric' => 'The Number of Physical Location field should be a number'
                ];
            } elseif (($request->voucher_number == '') && ($request->voucher_unlimited != null)) {
                $rules = [
                    'physical_location' => 'required|numeric'
                ];
                $customMessages = [
                    'physical_location.required' => 'The Number of Physical Location field is required',
                    'physical_location.numeric' => 'The Number of Physical Location field should be a number'
                ];
            } elseif (($request->voucher_number == '') && ($request->voucher_unlimited != null)) {
                $rules = [
                    'voucher_number' => 'required',
                    'physical_location' => 'required|numeric'
                ];
                $customMessages = [
                    'voucher_number.required' => 'Please enter number of voucher or check the unlimited checkbox',
                    'physical_location.required' => 'The Number of Physical Location field is required',
                    'physical_location.numeric' => 'The Number of Physical Location field should be a number'
                ];
            } else {
                $rules = [
                    'voucher_number' => 'required|gt:15',
                    'physical_location' => 'required|numeric'
                ];
                $customMessages = [
                    'voucher_number.required' => 'Please enter number of voucher or check the unlimited checkbox',
                    'physical_location.required' => 'The Number of Physical Location field is required',
                    'physical_location.numeric' => 'The Number of Physical Location field should be a number'
                ];
            }

            $this->validate($request, $rules, $customMessages);
        }

        if ($request->id) {
            $olddeal = Deal::find($request->id);
            if (($profile->business_type == 'Mobile Business') || ($profile->business_type == 'Online Only')) {
            } else {

                $business_location_count = BusinessLocation::where('business_profile_id', $profile->id)->where('participating_type', 'Participating')->count();
                if ($business_location_count > 0) {
                    $total_location = ($request->physical_location) - $business_location_count;
                    $profile->number_of_location  = $total_location;
                    $profile->save();
                } else {
                    return redirect()->route('frontend.business_owner.deal_save_step3')->with('error', 'Please select one location for deal');
                }
            }
            if ($request->voucher_number != '') {
                $olddeal->voucher_number = $request->voucher_number;
            }
            if ($request->voucher_unlimited != '') {
                $olddeal->voucher_unlimited = true;
            }
            if ($request->available_location != '') {
                $olddeal->available_location = $request->available_location;
            }
            $olddeal->is_complete = true;
            $olddeal->save();
            return redirect()->route('frontend.business_owner.get_merchant_plan');
            //return redirect()->route('frontend.business_owner.deal_congratulation');
        } else {
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal) {
                if (($profile->business_type == 'Mobile Business') || ($profile->business_type == 'Online Only')) {
                } else {
                    $business_location_count = BusinessLocation::where('business_profile_id', $profile->id)->where('participating_type', 'Participating')->count();
                    if ($business_location_count > 0) {
                        $total_location = ($request->physical_location) - $business_location_count;
                        $profile->number_of_location  = $total_location;
                        $profile->save();
                    } else {
                        $profile->number_of_location  = $request->physical_location;
                        $profile->save();
                    }
                }
                if ($request->voucher_number != '') {
                    $deal->voucher_number = $request->voucher_number;
                }
                if ($request->voucher_unlimited != '') {
                    $deal->voucher_unlimited = $request->voucher_unlimited;
                }
                if ($request->available_location != '') {
                    $deal->available_location = $request->available_location;
                }
                //$deal->is_complete = true;
                $deal->save();
                if ($deal) {
                    $details = [
                        'name' => $user->first_name . ' ' . $user->last_name,
                    ];
                    Mail::to($user->email)->queue(new CreateBusinessProfileMail($details));
                    if (!Mail::failures()) {
                        return redirect()->route('frontend.business_owner.get_merchant_plan');
                       // return redirect()->route('frontend.business_owner.deal_congratulation');
                    } else {
                        return redirect()->route('frontend.business_owner.get_merchant_plan')->with('error', 'Deal is create but mail is not sent to your mail id');
                      //  return redirect()->route('frontend.business_owner.deal_congratulation')->with('error', 'Deal is create but mail is not sent to your mail id');
                    }
                } else {
                    return redirect()->route('frontend.business_owner.get_merchant_plan')->with('error', 'Something went wrong');
                    //return redirect()->route('frontend.business_owner.deal_congratulation')->with('error', 'Something went wrong');
                }
            } else {
                return redirect()->route('frontend.business_owner.deal_save_step3')->with('error', 'Deal not found');
            }
        }
    }

    public function getPlan(){
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::with('states', 'locations', 'mailingstates')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $stateList = State::all();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = NULL;
                }
            } else {
                $profile = '';
            }
            $deal = Deal::with('dealLocation')->where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            $business_category_id = $profile->business_category_id;

            return view('frontend.merchant_owner.auth.merchant_plan', compact('profile', 'deal', 'photos', 'stateList', 'photos', 'logo'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    
    }

    public function savePlan(Request $request){
        if($request->ajax()){
            $merchant_id = Session::get('merchant_id');
            $user = User::find($merchant_id);
            $profile = BusinessProfile::with('locations')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if($request->status == 'add_on_save'){
                if($profile){
                    $profile->status = 4;
                    $profile->save();
                    return response()->json(['status' => 1, 'message' => 'business status change']);
                }
                else{
                    return response()->json(['status' => 0, 'message' => 'business not found']);
                }

            }
            elseif($request->status == 'checkout'){
                if($profile ){
                    $profile->status = 2;
                    $profile->merchant_type = $request->plan;
                    $profile->save();
                    return response()->json(['status' => 1, 'message' => 'business status change']);
                }
                else{
                    return response()->json(['status' => 0, 'message' => 'business not found']);
                }
            }
            else{
                
                if($profile ){
                    if($request->status == 'save'){
                        $profile->status = 4;
                        $profile->merchant_type = $request->plan;
                        $profile->save();
                        return response()->json(['status' => 1, 'message' => 'business status change']);
                    }
                    else{
                        $profile->merchant_type = $request->plan;
                        $profile->save();
                        return response()->json(['status' => 1, 'message' => 'business plan add']);
                    }
                    
                }
                else{
                    return response()->json(['status' => 0, 'message' => 'business not found']);
                }
            }
        }
    }

    public function getPlanAddOn(){
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::with('states', 'locations', 'mailingstates')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $stateList = State::all();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = NULL;
                }
            } else {
                $profile = '';
            }
            $deal = Deal::with('dealLocation')->where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            $business_category_id = $profile->business_category_id;

            return view('frontend.merchant_owner.auth.merchant_plan_add_on', compact('profile', 'deal', 'photos', 'stateList', 'photos', 'logo'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }

    }

    public function paymentInfo(){
        if (Session::get('merchant_id') && Session::get('type')) {
            $merchant_id = Session::get('merchant_id');
            $profile = BusinessProfile::with('states', 'locations', 'mailingstates')->where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            $stateList = State::all();
            if ($profile) {
                $profile = $profile;
                $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfilePhoto'])->get();
                $logo = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessProfileLogo'])->first();
                if (count($photos) > 0) {
                    $photos = $photos;
                } else {
                    $photos = NULL;
                }
            } else {
                $profile = '';
            }
            $deal = Deal::with('dealLocation')->where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal != '') {
                $deal = $deal;
            } else {
                $deal = '';
            }
            $business_category_id = $profile->business_category_id;

            return view('frontend.merchant_owner.auth.payment_info', compact('profile', 'deal', 'photos', 'stateList', 'photos', 'logo'));
        } elseif (Session::get('merchant_id') != '' && Session::get('type') == '') {
            return redirect()->route('frontend.business_owner.select_solution');
        } elseif (Session::get('merchant_id') == '' && Session::get('type') != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }
    }

    public function saveItem(Request $request)
    {
        $rules = [
            'item_name' => 'required',
            'value' => 'required|numeric',
        ];
        $customMessages = [
            'item_name.required' => 'The Description field is required',
            'value.required' => 'The Original Price field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $merchant_id = Session::get('merchant_id');
        $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
        $itemService = new ItemOrService;
        $itemService->item_name = $request->item_name;
        $itemService->business_category_id = $profile->business_category_id;
        if ($request->note != '') {
            $itemService->note = $request->note;
        }
        $itemService->merchant_id = $merchant_id;
        $itemService->added_by = $merchant_id;
        $itemService->save();

        if ($itemService) {
            if ($request->value != '') {
                $itemprice = new GiftItemValue;
                $itemprice->price = $request->value;
                $itemprice->merchant_id = $merchant_id;
                $itemprice->item_id = $itemService->id;
                $itemprice->save();
            }
            return response()->json(['success' => 1]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function merchantDealCongratulation()
    {
        $merchant_id = Session::get('merchant_id');
        $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
        if ($profile) {
            $profile = $profile;
            $photos = Media::where(['model_id' => $profile->id, 'collection_name' => 'businessPhoto'])->get();
            if ($photos) {
                $photos = $photos;
            } else {
                $photos = NULL;
            }
        } else {
            return redirect()->route('frontend.business_owner.create_business_profile');
        }
        $deal = Deal::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
        if ($deal != '') {
            $deal = $deal;
            $deal->is_complete = true;
            $deal->save();
        } else {
            return redirect()->route('frontend.business_owner.deal_create_step1');
        }
        Session::forget('merchant_id');
        return view('frontend.merchant_owner.auth.deal_congratulation', compact('profile', 'deal', 'photos'));
    }

    public function merchantProfileCreateClose()
    {
        $merchant_id = Session::get('merchant_id');
        if ($merchant_id) {
            $deal = Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal) {
                $deal->delete();
            }
        }
        Session::forget('merchant_id');
        Session::forget('type');
        return redirect()->route('frontend.business_owner.index');
    }
    public function getCategoryItem(Request $request)
    {
        if ($request->ajax()) {
            $item_id = $request->item_id;
            $item = ItemOrService::with('value')->find($item_id);
            if ($item) {
                return response()->json(['success' => 1, 'data' => $item]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    public function loginModal()
    {
        return redirect()->route('frontend.business_owner.index')->with('error_code', 'open modal');
    }

    public function resetUserPassword(Request $request)
    {
        if ($request->ajax()) {
            if ($request->new_password != '') {
                if ($request->confirm_password != '') {
                    if ($request->confirm_password != $request->new_password) {
                        return response()->json(['status' => 0]);
                    } else {
                        $user = User::where('remember_token', $request->token)->where('active', 1)->first();
                        // dd($user);
                        if ($user) {
                            $user->password = $request->new_password;
                            $user->remember_token = '';
                            $user->save();
                            $details = [
                                'password' => $request->new_password,
                                'name' => $user->full_name,
                            ];
                            Mail::to($user->email)->queue(new NewPasswordLinkMail($details));
                            if (!Mail::failures()) {
                                return response()->json(['status' => 1]);
                            } else {
                                return response()->json(['status' => 4]);
                            }
                        } else {
                            return response()->json(['status' => 0, 'message' => 'user not found']);
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

    public function merchantForgetPassword(Request $request)
    {
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "email"  =>  "required|email"
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 3, "validation_errors" => $validator->errors()->first()]);
                // return response()->json(['success' => false, 'status' => 0, 'message' => "Please enter a valid email address"]);
                
            }
            if ($request->email != '') {
                $user = User::where('email', $request->email)->role('MERCHANT')->first();
                if ($user) {
                    $created_token = Str::random(6);
                    $user->remember_token = $created_token;
                    $user->save();
                    $url = url('merchant-reset-password/' . $created_token);
                    $details = [
                        'name' => $user->full_name,
                        'email'  =>  $request->email,
                        'url' => $url
                    ];
                    Mail::to($user->email)->queue(new MerchantForgetPasswordMail($details));
                    if (!Mail::failures()) {
                        return response()->json(['success' => true, 'status' => 2, 'message' => "Reset link sent to your email"]);
                    } else {
                        return response()->json(['success' => false, 'status' => 1, 'message' => "Mail not sent"]);
                    }
                } else {
                    return response()->json(['success' => false, 'status' => 0, 'message' => "User not found"]);
                }
            }
        }
    }

    public function merchantResetPassword($token)
    {
        if ($token != '') {
            $user = User::where('remember_token', $token)->first();
            //dd($user);
            if ($user) {
                return redirect()->route('frontend.business_owner.index')->with('merchant_token', $token);
            } else {
                $token = '';
                return redirect()->route('frontend.business_owner.index')->with('merchant_token', $token);
            }
        } else {
            return redirect()->route('frontend.business_owner.index');
        }
    }

    public function storeMerchantResetPassword(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $validator  =   Validator::make($request->all(), [
                "new_password"  =>  "required|min:6",
                "confirm_password"  =>  "required|min:6"
            ]);
            if ($validator->fails()) {
                return response()->json(["status" => 5, "validation_errors" => $validator->errors()->first()]);
            }
            if ($request->new_password != '') {
                if ($request->new_password == $request->confirm_password) {
                    $user = User::where('remember_token', $request->user_token)->first();
                    if ($user) {
                        $details = [
                            'name' => $user->full_name,
                            'password' => $request->new_password
                        ];
                        $user->password = $request->new_password;
                        $user->remember_token = '';
                        $user->save();
                        Mail::to($user->email)->queue(new MerchantResetPasswordMail($details));
                        if (!Mail::failures()) {
                            return response()->json(['success' => true, 'status' => 3, 'message' => "Password updated successfully and mail sent"]);
                        } else {
                            return response()->json(['success' => false, 'status' => 4, 'message' => "Password updated successfully and mail not sent"]);
                        }
                    } else {
                        return response()->json(['success' => false, 'status' => 2, 'message' => "User not found"]);
                    }
                } else {
                    return response()->json(['success' => false, 'status' => 0, 'message' => "Confirm password does not matched with new password sdsd"]);
                }
            } else {
                return response()->json(['success' => false, 'status' => 1, 'message' => "New password should not be blank"]);
            }
        }
    }

    public function yesParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Session::get('merchant_id');
            $deal = Deal::find($request->deal_id);
            if ($deal) {
                $business = BusinessProfile::find($request->profile_id);
                $business_location = new BusinessLocation;
                $business_location->business_profile_id = $request->profile_id;
                $business_location->location_name = $business->mailing_address;
                $business_location->address = $business->mailing_address;
                $business_location->city = $business->mailing_city;
                $business_location->state_id = $business->mailing_state_id;
                $business_location->zip_code = $business->mailing_zipcode;
                $business_location->business_phone = $business->business_phone;
                $business_location->business_email = $business->business_email;
                $business_location->business_fax_number = $business->business_fax_number;
                $business_location->participating_type = 'Participating';
                $business_location->save();
                $locationid = strtoupper(substr($business->business_name, 0, 3)) . '/' . strtoupper(substr($business_location->location_name, 0, 3)) . '/0' . $business_location->id;
                $business_location->locationId = $locationid;
                $business_location->save();

                $deallocation = new DealLocation;
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $business_location->id;
                $deallocation->participating_type = 'Participating';
                $deallocation->status = 1;
                $deallocation->save();
                $merchant_location = new MerchantLocation;
                $merchant_location->user_id = $merchant_id;
                $merchant_location->location_id  = $business_location->id;
                $merchant_location->status = true;
                $merchant_location->is_main = true;
                $merchant_location->save();
                $deal_location = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deal_location) {
                    return response()->json(["status" => 1, "data" => $deal_location]);
                } else {
                    return response()->json(["status" => 0]);
                }
            }
        }
    }

    public function dealNotRedeem(Request $request)
    {
        if ($request->ajax()) {
            $business = BusinessProfile::with('locations')->find($request->profile_id);
            if ($business) {
                return response()->json(["status" => 1, "data" => $business]);
            } else {
                return response()->json(["status" => 0]);
            }
        }
    }

    public function addNonParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Session::get('merchant_id');
            $deal = Deal::find($request->deal_id);
            // $location = BusinessLocation::find($request->location_id);

            if ($deal) {
                $business = BusinessProfile::find($request->profile_id);
                $business_location = new BusinessLocation();
                $business_location->business_profile_id = $request->profile_id;
                $business_location->location_name = $business->mailing_address;
                $business_location->address = $business->mailing_address;
                $business_location->city = $business->mailing_city;
                $business_location->state_id = $business->mailing_state_id;
                $business_location->zip_code = $business->mailing_zipcode;
                $business_location->business_phone = $business->business_phone;
                $business_location->business_email = $business->business_email;
                $business_location->business_fax_number = $business->business_fax_number;
                $business_location->participating_type = 'Non-Participating';
                $business_location->save();
                $merchant_location = new MerchantLocation;
                $merchant_location->user_id = $merchant_id;
                $merchant_location->location_id  = $business_location->id;
                $merchant_location->status = true;
                $merchant_location->is_main = true;
                $merchant_location->save();
                $locationid = strtoupper(substr($business->business_name, 0, 3)) . '/' . strtoupper(substr($business_location->location_name, 0, 3)) . '/0' . $business_location->id;
                $business_location->locationId = $locationid;
                $business_location->save();
                $nonparticipating_location = BusinessLocation::where('business_profile_id', $request->profile_id)->where('participating_type', 'Non-Participating')->first();
                if ($nonparticipating_location) {
                    return response()->json(["status" => 1, "data" => $nonparticipating_location]);
                } else {
                    return response()->json(["status" => 0]);
                }
            } else {
                return response()->json(["status" => 0]);
            }
        }
    }

    public function removeNonParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Session::get('merchant_id');
            $business = BusinessProfile::find($request->profile_id);
            $deal = Deal::find($request->deal_id);
            if ($deal) {
                // $deallocation = new DealLocation();
                $business_location = new BusinessLocation();
                $business_location->business_profile_id = $request->profile_id;
                $business_location->location_name = $business->mailing_address;
                $business_location->address = $business->mailing_address;
                $business_location->city = $business->mailing_city;
                $business_location->state_id = $business->mailing_state_id;
                $business_location->zip_code = $business->mailing_zipcode;
                $business_location->business_phone = $business->business_phone;
                $business_location->business_email = $business->business_email;
                $business_location->business_fax_number = $business->business_fax_number;
                $business_location->participating_type = 'Participating';
                $business_location->save();
                $merchant_location = new MerchantLocation;
                $merchant_location->user_id = $merchant_id;
                $merchant_location->location_id  = $business_location->id;
                $merchant_location->status = true;
                $merchant_location->is_main = true;
                $merchant_location->save();
                $locationid = strtoupper(substr($business->business_name, 0, 3)) . '/' . strtoupper(substr($business_location->location_name, 0, 3)) . '/0' . $business_location->id;
                $business_location->locationId = $locationid;
                $business_location->save();
                if ($business_location) {
                    return response()->json(["status" => 1, "data" => $business_location]);
                } else {
                    return response()->json(["status" => 0]);
                }
            }
        }
    }

    public function addBusinessLocation(Request $request)
    {
        if ($request->ajax()) {
            $deal = Deal::find($request->add_deal_id);
            if ($request->location_name != '') {
                if ($request->location_phone != '') {
                    $validator  =   Validator::make($request->all(), [
                        "location_phone"  =>  "numeric|unique:business_locations,business_phone"
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        if ($request->location_fax != '') {
                            $validator  =   Validator::make($request->all(), [
                                "location_fax" => 'numeric|min:6',
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->location_email != '') {
                            $validator  =   Validator::make($request->all(), [
                                "location_email" => 'email|unique:business_locations,business_email',
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->address != '') {
                            if ($request->zip_code != '') {
                                if ($request->city != '') {
                                    if ($request->state_id != '') {
                                        $merchant_id = Session::get('merchant_id');
                                        if ($request->check_location == 'yes_participate') {
                                            $locationdata = array(
                                                'business_profile_id' => $deal->business_id,
                                                'location_name' => $request->location_name,
                                                'business_phone' => $request->location_phone,
                                                'business_fax_number' => $request->location_fax,
                                                'business_email' => $request->location_email,
                                                'address' => $request->address,
                                                'zip_code' => $request->zip_code,
                                                'city' => $request->city,
                                                'state_id' => $request->state_id,
                                                'participating_type' => 'Participating'
                                            );
                                            $location = BusinessLocation::create($locationdata);
                                            $locationid = strtoupper(substr($location->business->business_name, 0, 3)) . '/' . strtoupper(substr($location->location_name, 0, 3)) . '/0' . $location->id;
                                            $location->locationId = $locationid;
                                            $location->save();
                                            if ($location) {
                                                $deal_location = new DealLocation;
                                                $deal_location->deal_id = $request->add_deal_id;
                                                $deal_location->location_id = $location->id;
                                                $deal_location->participating_type = 'Participating';
                                                $deal_location->status = true;
                                                $deal_location->save();
                                            }
                                            $merchant_location = new MerchantLocation;
                                            $merchant_location->user_id = $merchant_id;
                                            $merchant_location->location_id  = $location->id;
                                            $merchant_location->status = true;
                                            $merchant_location->is_main = false;
                                            $merchant_location->save();
                                            $business_locations = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                            $dealocations = DealLocation::where('deal_id', $request->add_deal_id)->pluck('location_id')->toArray();
                                            return response()->json(["status" => 10, "message" => 'Participating Location saved', 'data' => $business_locations, 'deal_location_ids' => $dealocations]);
                                        } else if ($request->check_location == 'yes_non_participate') {
                                            $existNonparticipating = BusinessLocation::where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                            if ($existNonparticipating) {
                                                return response()->json(["status" => 12, "message" => 'Already non-participating exists']);
                                            } else {
                                                $locationdata = array(
                                                    'business_profile_id' => $deal->business_id,
                                                    'location_name' => $request->location_name,
                                                    'business_phone' => $request->location_phone,
                                                    'business_fax_number' => $request->location_fax,
                                                    'business_email' => $request->location_email,
                                                    'address' => $request->address,
                                                    'zip_code' => $request->zip_code,
                                                    'city' => $request->city,
                                                    'state_id' => $request->state_id,
                                                    'participating_type' => 'Non-participating'
                                                );
                                                $location = BusinessLocation::create($locationdata);
                                                $locationid = strtoupper(substr($location->business->business_name, 0, 3)) . '/' . strtoupper(substr($location->location_name, 0, 3)) . '/0' . $location->id;
                                                $location->locationId = $locationid;
                                                $location->save();

                                                return response()->json(["status" => 13, "message" => 'Non-participating location added successfully',"data" => $location ]);
                                            }
                                        } else {
                                            return response()->json(["status" => 11, "message" => 'Something Wrong']);
                                        }
                                    } else {
                                        return response()->json(["status" => 3, "message" => 'State field is required']);
                                    }
                                } else {
                                    return response()->json(["status" => 4, "message" => 'City field is required']);
                                }
                            } else {
                                return response()->json(["status" => 5, "message" => 'Zip Code field is required']);
                            }
                        } else {
                            return response()->json(["status" => 6, "message" => 'Address field is required']);
                        }
                    }
                } else {
                    return response()->json(["status" => 7, "message" => 'Location phone field is required']);
                }
            } else {
                return response()->json(["status" => 8, "message" => 'Location name field is required']);
            }
        }
    }


    public function findBusinessLocation(Request $request){
        if ($request->ajax()) {
            if($request->locationid != ''){
                $business_location = BusinessLocation::find($request->locationid);
                $deal_location = DealLocation::where('deal_id',$request->dealid)->where('location_id',$request->locationid)->first();
                if($business_location){
                    return response()->json(["status" => 1, "message" => 'Location found', "data" => $business_location,"deal_location" => $deal_location]);
                }
                else{
                    return response()->json(["status" => 0, "message" => 'Location not found']);
                }
            }
        }
    }

    public function editBusinessLocation(Request $request){
        if ($request->ajax()) {
            $deal = Deal::find($request->edit_deal_id);
            $business_location = BusinessLocation::find($request->edit_location_id);
            if ($request->edit_location_name != '') {
                if ($request->edit_location_phone != '') {

                    $validator  =   Validator::make($request->all(), [
                        "edit_location_phone"  =>  "numeric|unique:business_locations,business_phone,". $business_location->id
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        if ($request->edit_location_fax != '') {
                            $validator  =   Validator::make($request->all(), [
                                "edit_location_fax" => 'numeric|min:6',
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 1, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->business_location_email != '') {
                            $validator  =   Validator::make($request->all(), [
                                "business_location_email" => 'email|unique:business_locations,business_email,'.$business_location->id,
                            ]);
                            if ($validator->fails()) {
                                return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
                            }
                        }
                        if ($request->edit_address != '') {
                            if ($request->edit_zip_code != '') {
                                if ($request->edit_city != '') {
                                    if ($request->edit_state_id != '') {
                                        $merchant_id = Session::get('merchant_id');
                                        if ($request->edit_check_location == 'yes_participate') {
                                            if($business_location->participating_type == 'Participating'){
                                                $business_location->location_name = $request->edit_location_name;
                                                $business_location->business_phone = $request->edit_location_phone;
                                                $business_location->business_fax_number = $request->edit_location_fax;
                                                $business_location->business_email = $request->business_location_email;
                                                $business_location->address = $request->edit_address;
                                                $business_location->zip_code = $request->edit_zip_code;
                                                $business_location->city = $request->edit_city;
                                                $business_location->state_id = $request->edit_state_id;
                                                $business_location->save();
                                                $business_locations = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                                $dealocations = DealLocation::where('deal_id', $request->edit_deal_id)->pluck('location_id')->toArray();
                                                $nonbusiness_location = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                                return response()->json(["status" => 10, "message" => 'Participating Location saved', 'data' => $business_locations, 'deal_location_ids' => $dealocations,'non_business_location' => $nonbusiness_location]);

                                            }
                                            elseif($business_location->participating_type == 'Non-participating'){
                                                $participating_count = BusinessLocation::where('business_profile_id',$business_location->business_profile_id)->where('participating_type','Participating')->count();
                                                if($participating_count == $request->physical_location){
                                                    return response()->json(["status" => 14, "message" => 'You can not add participating location more than physical location number']);
                                                }
                                                else{
                                                    $business_location->location_name = $request->edit_location_name;
                                                    $business_location->business_phone = $request->edit_location_phone;
                                                    $business_location->business_fax_number = $request->edit_location_fax;
                                                    $business_location->business_email = $request->business_location_email;
                                                    $business_location->address = $request->edit_address;
                                                    $business_location->zip_code = $request->edit_zip_code;
                                                    $business_location->city = $request->edit_city;
                                                    $business_location->state_id = $request->edit_state_id;
                                                    $business_location->participating_type = 'Participating';
                                                    $business_location->save();
                                                    $deal_location = new DealLocation;
                                                    $deal_location->deal_id = $request->edit_deal_id;
                                                    $deal_location->location_id = $business_location->id;
                                                    $deal_location->participating_type = 'Participating';
                                                    $deal_location->status = true;
                                                    $deal_location->save();
                                                    $business_locations = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                                    $dealocations = DealLocation::where('deal_id', $request->edit_deal_id)->pluck('location_id')->toArray();
                                                    $nonbusiness_location = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                                    return response()->json(["status" => 10, "message" => 'Participating Location saved', 'data' => $business_locations, 'deal_location_ids' => $dealocations, 'non_business_location' => $nonbusiness_location ]);
                                                }
                                            }
                                            
                                           
                                        } else if ($request->edit_check_location == 'yes_non_participate') {
                                            if($business_location->participating_type == 'Non-participating'){
                                                $business_location->location_name = $request->edit_location_name;
                                                $business_location->business_phone = $request->edit_location_phone;
                                                $business_location->business_fax_number = $request->edit_location_fax;
                                                $business_location->business_email = $request->business_location_email;
                                                $business_location->address = $request->edit_address;
                                                $business_location->zip_code = $request->edit_zip_code;
                                                $business_location->city = $request->edit_city;
                                                $business_location->state_id = $request->edit_state_id;
                                                $business_location->save();
                                                    $business_locations = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                                    $dealocations = DealLocation::where('deal_id', $request->edit_deal_id)->pluck('location_id')->toArray();
                                                    $nonbusiness_location = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                                return response()->json(["status" => 10, "message" => 'Participating Location saved', 'data' => $business_locations, 'deal_location_ids' => $dealocations, 'non_business_location' => $nonbusiness_location]);
                                            }
                                            else if($business_location->participating_type == 'Participating'){
                                                $existNonparticipating = BusinessLocation::where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                                if ($existNonparticipating) {
                                                    
                                                    return response()->json(["status" => 12, "message" => 'Already non-participating exists']);
                                                }
                                                else{
                                                    $business_location->location_name = $request->edit_location_name;
                                                    $business_location->business_phone = $request->edit_location_phone;
                                                    $business_location->business_fax_number = $request->edit_location_fax;
                                                    $business_location->business_email = $request->business_location_email;
                                                    $business_location->address = $request->edit_address;
                                                    $business_location->zip_code = $request->edit_zip_code;
                                                    $business_location->city = $request->edit_city;
                                                    $business_location->state_id = $request->edit_state_id;
                                                    $business_location->participating_type = 'Non-participating';
                                                    $business_location->save();
                                                    $dealocation = DealLocation::where('deal_id', $request->edit_deal_id)->where('location_id',$business_location->id)->first();
                                                    if($dealocation){
                                                        $dealocation->delete();
                                                    }
                                                    $business_locations = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                                    $dealocations = DealLocation::where('deal_id', $request->edit_deal_id)->pluck('location_id')->toArray();
                                                    $nonbusiness_location = BusinessLocation::with('states')->where('business_profile_id', $deal->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                                    return response()->json(["status" => 13, "message" => 'Non-participating location updated successfully','data' => $business_locations, 'deal_location_ids' => $dealocations, 'non_business_location' => $nonbusiness_location ]);

                                                }
                                            }
                                            
                                        } else {
                                            return response()->json(["status" => 11, "message" => 'Something Wrong']);
                                        }
                                    } else {
                                        return response()->json(["status" => 3, "message" => 'State field is required']);
                                    }
                                } else {
                                    return response()->json(["status" => 4, "message" => 'City field is required']);
                                }
                            } else {
                                return response()->json(["status" => 5, "message" => 'Zip Code field is required']);
                            }
                        } else {
                            return response()->json(["status" => 6, "message" => 'Address field is required']);
                        }
                    }
                } else {
                    return response()->json(["status" => 7, "message" => 'Location phone field is required']);
                }
            } else {
                return response()->json(["status" => 8, "message" => 'Location name field is required']);
            }
        }
    }

    
    // public function createCustomer(){
    //     $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //     $stripe->customers->create([
    //         'name' => 'Jenny Rosen',
    //         'email' => 'jennyrosen@example.com',
    //     ]);
    //     dd($stripe->customers->id);
    //     $stripe->subscriptions->create([
    //         'customer' => 'cus_Na6dX7aXxi11N4',
    //         'items' => [['price' => 'price_1QRq84KSRycFM4otGw4YIZXd']],
    //       ]);
    //     dd($stripe);
    // }
    

    
}
