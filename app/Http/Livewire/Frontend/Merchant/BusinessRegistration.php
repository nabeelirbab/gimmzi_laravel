<?php

namespace App\Http\Livewire\Frontend\Merchant;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\MerchantTitle;
use App\Models\Title;
use App\Models\BusinessLocation;
use App\Models\BusinessCategory;
use App\Models\ServiceType;
use App\Models\State;
use App\Models\Deal;
use App\Models\Events;
use App\Models\MerchantLoyaltyProgram;
use App\Models\LoyaltyProgramItem;
use App\Models\LoyaltyRewardLocation;
use App\Models\Subscription;
use App\Models\UserSavedCard;
use App\Models\MerchantLocation;
use App\Models\DealLocation;
use App\Models\GiftItemValue;
use App\Models\ItemServiceLocation;
use App\Models\BusinessProfile;
use App\Models\ItemOrService;
use App\Models\TermsAndCondition;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\MerchantRegistrationMail;
use App\Http\Livewire\Traits\AlertMessage;
use Livewire\WithFileUploads;
use  Hash, DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash as FacadesHash;




class BusinessRegistration extends Component
{
    use AlertMessage;
    use WithFileUploads;
    public $name, $email, $phone, $phone_ext, $mail_receive , $merchant_id, $merchant_titles, $official_title, $type, $complete_percent, $profile_complete_value,$info_readonly,$user_name,$user_email,$user_phone, $random_code;
    public $step1, $step2 = false, $offic_ttle_div = false, $step3 = false, $step4 = false, $step5 = false, $step6 = false, $step7 = false, $step8 = false, $pyamentPage = false, $step9 = false, $business_story = false, $business_overview = false, $overview_message;
    public $title,$merchant_title_id, $validation_code, $new_password, $confirm_password, $verification_file, $not_verified;
    public $category, $stateList, $services, $profile, $business_id, $primary_business_address, $merchantLocationAdd;
    public $business_type, $business_category_id, $service_type_id, $business_name, $business_phone, $business_fax_number, $business_email, $business_page_link, $allow_notification, $deal, $newDealCreate, $stateName, $MailingstateName;
    public $faxnumber,$pagelink, $businessProfileArray,$payment_state_name,$create_business_profile, $story_message;
    public $no_physical_address = false, $street_address, $zip_code, $city, $state_id, $same_address, $mailing_address, $mailing_zip_code, $mailing_city, $mailing_state_id,$loyalty_create,$deal_create,$business_story_image;
    public $business_logo, $business_image, $business_media, $businessLogo='', $imageBusiness='', $mainMediaBusiness='';
    public $deal_step = false , $deal_step1 = false, $deal_step2 = false, $deal_step3 = false, $deal_step4 = false, $deal_step5 = false;
    public $start_date, $end_date, $deal_image, $selected_option, $business_location_name, $business_location_phone, $business_location_email, $business_location_street, $business_location_city, $business_location_state,$business_location_zip,$business_location_fax, $physical_location, $added_physical_location, $frist_location, $perticipating_location_array = array(), $display, $voucher_limit, $voucher_unlimited, $business_location_state_name;
    public $items = [],$item_select_display, $item_id, $item_price, $deal_discount, $is_bogo, $discount_type, $discount_amount, $deal_point, $deal_description, $show_discount_amount,$categoryData, $about_program, $terms_condition, $item_service_name, $note, $value_one, $value_two, $seleted_locations = [] , $loyalty_item_select_display,$new_business_location, $DealLocationAdd,$deal_address,$main_deal_image_upload,$location_latitude,$location_longitude,$edit_location_latitude,$edit_location_longitude,$listing_location_latitude,$listing_location_longitude,$mailing_listing_location_latitude,$mailing_listing_location_longitude;

    public $loyalty_step = false,$loyalty_step1 = false,$loyalty_step2 = false,$loyalty_step3 = false,$loyalty_step4 = false, $loyalty_step5 = false;
    public $loyalty_image, $loyalty_location_number, $loyalty_location_added, $loyalty_selected_option, $loyalty_business_location, $get_all_location, $edit_loc_id, $edit_loc_name, $edit_loc_phone, $edit_loc_fax, $edit_loc_mail, $edit_loc_address, $edit_loc_zip, $edit_loc_city, $edit_loc_state_id, $lctn_id;

    public $edit_business_location_name, $edit_business_location_phone, $edit_business_location_fax, $edit_business_location_email, $edit_business_location_street, $edit_business_location_zip, $edit_business_location_city, $edit_business_location_state,$have_to_buy,$free_item,$free_item_no,$percentages,$off_percentage,$loyalty_about,$loyalty_terms,$edit_physical_address,$edit_added_location;

    public $yes_end,$loyalty_start_date,$loyalty_end_date,$loyalty_location_ids=[],$purchase_goal,$no_end,$locations =[];

    public $payment_street, $payment_state, $payment_city, $payment_country, $payment_zip, $payment_user_f_name, $payment_user_l_name, $payment_user_email, $card_number, $card_cvv, $card_expiry_date, $f_name, $l_name,$stripe_token;

    public $loyalty_discount_type, $spend_amount, $program_amount, $loyalty_discount_amount, $dscnt_amount, $when_order, $loyalty_item_id=[], $main_image_upload_loyalty, $loyalty_main_photo, $loyalty_main_photo_id, $loyalty_address,$progameName,$program_point,$loyalty_single_photo;

    public $loyalty_business_location_business_profile_id,$loyalty_business_location_location_name,$loyalty_business_location_address, $loyalty_business_location_city, $loyalty_business_location_state,$loyalty_business_location_state_id,$loyalty_business_location_zip_code,$loyalty_business_location_location_type,$loyalty_business_location_participating_type;

    public $deal_event_step = false, $serving_area1_street, $serving_area1_city, $serving_area1_state, $serving_area1_zip, $serving_area2_street, $serving_area2_city, $serving_area2_state, $serving_area2_zip,$serving_area3_street, $serving_area3_city, $serving_area3_state, $serving_area3_zip, $advertise_event, $event_name, $event_start_date, $event_end_date, $one_day_event = 0, $event_address, $event_city, $event_state, $event_zip;

    public $serving_area1_latitude, $serving_area1_longitude, $serving_area2_latitude, $serving_area2_longitude,$serving_area3_latitude, $serving_area3_longitude, $event_latitude, $event_longitude, $eventAdd, $deal_business_location,$serving_area1_array,$serving_area2_array,$serving_area3_array,$save_deal_event, $click_no_advertise_event = false, $is_loyalty = false;

    public $selected_item_value = [] , $get_items = [], $item_service_modal = true, $item_service_modal_open;


    public $showModal = false;

    // protected $listeners = ['dealDatepickerEnable'];
    protected $listeners = [
        'dealDatepickerEnable' => 'handleDealDatepickerEnable',
        'createCardToken' => 'handleCreateCardToken',
        'updateStreetAddress' => 'setStreetAddress',
        'updateCity' => 'setCity',
        'updateState' => 'setState',
        'updateZipCode' => 'setZipCode',
        'updateLatLng' => 'setLatLng',
        'mailupdateStreetAddress'=>'mailsetStreetAddress',
        'mailupdateCity' => 'mailsetCity',
        'mailupdateState' => 'mailsetState',
        'mailupdateZipCode' => 'mailsetZipCode',
        'mailupdateLatLng' => 'mailsetLatLng',
        'closeitemservice' => 'closeitemservicepopup',
        // 'serving area 1'
        'serving1StreetAddress'=>'serving1setStreetAddress',
        'serving1updateCity' => 'serving1setCity',
        'serving1updateState' => 'serving1setState',
        'serving1updateZipCode' => 'serving1setZipCode',
        'serving1updateLatLng' => 'serving1setLatLng',
        //serving area 2
        'serving2StreetAddress'=>'serving2setStreetAddress',
        'serving2updateCity' => 'serving2setCity',
        'serving2updateState' => 'serving2setState',
        'serving2updateZipCode' => 'serving2setZipCode',
        'serving2updateLatLng' => 'serving2setLatLng',
        //serving area 3
        'serving3StreetAddress'=>'serving3setStreetAddress',
        'serving3updateCity' => 'serving3setCity',
        'serving3updateState' => 'serving3setState',
        'serving3updateZipCode' => 'serving3setZipCode',
        'serving3updateLatLng' => 'serving3setLatLng',
        //event
        'eventStreetAddress'=>'eventsetStreetAddress',
        'eventupdateCity' => 'eventsetCity',
        'eventupdateState' => 'eventsetState',
        'eventupdateZipCode' => 'eventsetZipCode',
        'eventupdateLatLng' => 'eventsetLatLng',
    ];

    protected $rules = [
        'street_address' => 'required|string',
        'zip_code' => 'nullable|string',
        'city' => 'nullable|string',
        'state_id' => 'nullable|string',
    ];

    
    
    public function mount(){
        
        $this->step1 = true;

        // $this->loyalty_step3 = true;
        // $this->loyalty_item_select_display = true;
        // $this->items = ItemOrService::where('status', 1)->orderBy('id', 'desc')->get();
        // $this->emit('select2');

        // $this->no_physical_address = true;
        
        $this->merchant_titles = MerchantTitle::get();
        $this->merchant_title_id = $this->merchant_titles->first()->id ?? null;
        // dd($this->merchant_titles);
        $this->type = '';

        $this->overview_message = '';
        $this->business_id = '';
        $this->business_type = '';
        $this->business_category_id = '';
        $this->business_logo = '';
        $this->service_type_id = '';
        $this->physical_location = '';
        $this->added_physical_location= '';
        $this->frist_location = 0;
        $this->profile_complete_value = 0;
        $this->primary_business_address = '';
        $this->deal_point = '';
        $this->discount_type = 'amount ($)';
        $this->display = true;
        $this->item_select_display = true;
        $this->about_program = '';
        $this->terms_condition = '';
        $this->info_readonly = 'readonly';
        $this->f_name = '';
        $this->l_name = '';
        $this->loyalty_location_ids = '';

        $this->loyalty_terms ='';
        $this->loyalty_about ='';

        $this->percentages = [  ['value' => 'Free', 'text' => 'Free'],
                                ['value' => '25% OFF', 'text' => '25% OFF'],
                                ['value' => '35% OFF', 'text' => '35% OFF'],
                                ['value' => '50% OFF', 'text' => '50% OFF'],
                                ['value' => '75% OFF', 'text' => '75% OFF']];
        $this->off_percentage = 'Free';
        $this->stateList = State::get();
        $this->event_state = '';
        $this->serving_area1_state = '';
        $this->serving_area2_state = '';
        $this->serving_area3_state = '';
        $this->get_items = '';
        $item_service_modal_open = false;
    }



    public function personal_info_submit(){
        $this->merchant_id = '';
        // dd($this->mail_receive);
        $input =  $this->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                'phone' => 'required|unique:users,phone|max:12|min:10',
            ],
            [
                'name.required' => 'The First & Last Name field is required.',
                'email.required' => 'The Preferred Email field is required.',
                'email.email' => 'The Preferred Email must be a valid email address',
                'email.unique' => 'The Preferred Email has already been taken',
                'email.regex' => 'The Preferred Email format is invalid',
                'phone.required' => 'The Preferred Phone field is required',
                'phone.unique' => 'The Preferred Phone has already been taken',
                'phone.max' => 'The Preferred Phone may not be greater than 12 characters',
                'phone.min' => 'The Preferred Phone must be at least 10 characters',
                
            ]
        );

        $splitName = explode(' ', $this->name, 2);
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $code = rand(100000, 999999);
        // $code = 123456;
        $this->random_code = $code;
        $this->f_name = $first_name;
        $this->l_name = $last_name;

        $user = User::create([
            'first_name' => $this->f_name,
            'last_name' => $this->l_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'phone_ext' =>$this->phone_ext,
            'active' => true,
            'validation_code' => $code
        ]);
        $user->assignRole('MERCHANT');
        $rand = rand(1000,9999);
        $merchantid = $rand.substr($user->first_name, 0, 3);
        if ($this->mail_receive != null) {
            $user->is_subscribe = 1;
            
        }
        $user->userId = $merchantid;
        $user->save();

        if ($user) {
            $details = [
                'email'  =>  $this->email,
                'validation_code' => $code,
                'name' => $this->name,
            ];

            $this->merchant_id = $user->id;
            Mail::to($this->email)->queue(new MerchantRegistrationMail($details));

            $this->emit('mailSendPopup');
            $this->profile_complete_value=0;
        }
    }

    public function close_email_send_popup(){
        $this->profile_complete_value=50;
        $this->emit('closeSuccessPopup');
        $this->step1 = false;
        $this->step2 = true;
    }

    public function merchantTitleChange(){
        if($this->merchant_title_id == 'not_owner'){
            $this->offic_ttle_div = true;
        }
        else{
            $this->offic_ttle_div = false;
        }
    }

    public function UpdatedVerificationFile(){
        // dd($this->verification_file);
        $input =  $this->validate(
            [
                'verification_file' => 'nullable|mimes:pdf,docx',
            ],
            [
                'verification_file.mimes' => 'The Business Verification file type must be pdf or doc',
            ]
        );
    }

    public function personal_contact_submit(){
        $user = User::find($this->merchant_id);
        
        if ($user) {
            $input =  $this->validate(
                [
                    'validation_code' => 'required',
                    'new_password' => 'required|min:6',
                    'confirm_password' => 'required|min:6|same:new_password',
                    'merchant_title_id' => 'required',
                    'official_title' => 'required_if:merchant_title_id,=,not_owner',
                    'verification_file' => 'nullable|mimes:pdf,docx',
                    'not_verified' =>   'required_without:verification_file',
                ],
                [
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
                ]
            );

            $this->title = Title::where('title_name', 'Corporate System Admin')->first();
            if ($this->validation_code == (int)$user->validation_code) {
                $user->validation_code = '';
                $user->password = $this->new_password;
                if ($this->merchant_title_id == 'not_owner') {
                    $user->official_title = $this->official_title;
                    $user->title_id = $this->title->id;
                } else {
                    $user->merchant_title_id = $this->merchant_title_id;
                    $user->title_id = $this->title->id;
                }
                if (!empty($this->verification_file)) {
                    $fileName = time() . '.' . $this->verification_file->extension();
                    $destinationPath = public_path('uploads/business_verification');
                    $filePath = $this->verification_file->storeAs('uploads/business_verification', $fileName, 'public');
                    $user->upload_doc = $fileName;
                    $user->doc_verify_status = 0;
                    $user->doc_type = 'needs_review';
                } else {
                    $user->doc_verify_status = 0;
                    $user->doc_type = 'needs_review';
                }
                $user->save();
                // return redirect()->route('frontend.business_owner.select_solution')->with('success', 'Account validated successfully..');
                $this->category = BusinessCategory::where('status', 1)->get();
                $this->stateList = State::get();
                if ($this->merchant_id) {
                    $merchant_id = $this->merchant_id;
                    $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
                    if ($profile) {
                        $this->profile = $profile;
                    } else {
                        $this->profile = '';
                    }
                }
                $this->profile_complete_value = 20;
                $this->step2 = false;
                $this->step4 = true;

            } else {
                $msgAction = "Validation Code is not matched";
                $this->emit('popUp',['text' => $msgAction]);
            }
        }else{
            $msgAction = "User Not Found";
            $this->emit('popUp',['text' => $msgAction]);
        }
    }

    public function fetchSubcategories(){
        // dd($this->business_category_id);
        $this->services = ServiceType::where('status', 1)->where('category_id',$this->business_category_id)->get();

    }

    public function solutionClick($parameter){
        $this->type = $parameter;
        $this->category = BusinessCategory::where('status', 1)->get();
        $this->services = ServiceType::where('status', 1)->get();
        $this->stateList = State::get();
        if ($this->merchant_id && $this->type) {
            $merchant_id = $this->merchant_id;
            $profile = BusinessProfile::where('merchant_id', $merchant_id)->orderBy('id', 'desc')->first();
            if ($profile) {
                $this->profile = $profile;
            } else {
                $this->profile = '';
            }
        }

        if ($this->merchant_id && $this->type) {
            $this->step3 = false;
            $this->step4 = true;
        } elseif ($this->merchant_id != '' && $this->type == '') {
            $this->step2 = false;
            $this->step3 = true;
            $this->step4 = false;
        } elseif ($this->merchant_id == '' && $this->type != '') {
            return redirect()->route('frontend.business_owner.login');
        } else {
            return redirect()->route('frontend.business_owner.login');
        }  
    }

    public function goToStepThree(){
        $this->step4 = false;
        $this->step2 = true;
        $this->deal_step = false;

    }

    public function goToStepFour(){
        $this->step4 = true;
        $this->step5 = false;
        $this->deal_step = false;

    }

    public function goToStepFive(){
        $this->step5 = true;
        $this->business_story = false;
        $this->deal_step = false;
        $this->step6 = false;


    }

    public function goToStepSix(){
        $this->step6 = true;
        $this->step7 = false;
        $this->deal_step = false;
    }

    public function goToStepSeven(){
        $this->step7 = true;
        $this->deal_step = false;
    }

    public function UpdatedBusinessLogo(){
        // dd('sdvsd');
        $this->validate([
            'business_logo' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'business_logo.required' => 'select at least one image for deal',
            'business_logo.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]);  
        // dd(asset('storage/tmp/'.$this->business_image->getFilename()));  
    }

    public function UpdatedBusinessImage(){
        // dd('1111');
          

        $this->validate([
            'business_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'business_image.required' => 'select at least one image for deal',
            'business_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]); 
        // dd(asset('storage/tmp/'.$this->business_image->getFilename()));  
        $this->imageBusiness = $this->business_image;
    }

    public function UpdatedBusinessMedia(){
        $this->validate([
            'business_media' => 'required|mimes:pm4,flv,mov,wmv',
        ], [
            'business_media.required' => 'select at least one image for deal',
            'business_media.mimes' => "The Upload File must be a file type of:pm4,flv,mov,wmv"
        ]);   
        $this->mainMediaBusiness = $this->business_media;
    }

    public function UpdatedDealImage(){
        $this->validate([
            'deal_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'deal_image.required' => 'select at least one image for deal',
            'deal_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]); 
    }

    public function toggleSameAddress(){
        // dd($this->same_address);
        if($this->same_address == true){
            $this->mailing_address = $this->street_address;
            $this->mailing_zip_code = $this->zip_code;
            $this->mailing_city = $this->city;
            $this->mailing_state_id = $this->state_id;

        }else{
            $this->mailing_address ='';
            $this->mailing_zip_code = '';
            $this->mailing_city = '';
            $this->mailing_state_id = '';
        }
    }

    public function business_profile_submit(){
        if ($this->business_type != "") {
            if ($this->business_type == "Mobile Business" || $this->business_type == "Online Only") {
                $input =  $this->validate(
                    [
                        'business_category_id' => 'required',
                        'business_name' => 'required',
                        'service_type_id' => 'required',
                        'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                        'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    ],
                    [
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
                    ]
                );
            }else{
                $input =  $this->validate(
                    [
                        'business_category_id' => 'required',
                        'business_name' => 'required',
                        'service_type_id' => 'required',
                        'business_type' => 'required',
                        'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                        'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                        'business_fax_number' => 'nullable|unique:business_profiles,business_fax_number|min:6',
                    ],
                    [
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
                    ]
                );
            }
           
        }else{
            $input =  $this->validate(
                [
                    'business_category_id' => 'required',
                    'business_name' => 'required',
                    'service_type_id' => 'required',
                    'business_type' => 'required',
                    'business_phone' => 'required|unique:business_profiles,business_phone|max:12|min:10',
                    'business_email' => 'required|email|unique:business_profiles,business_email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
                    'business_fax_number' => 'nullable|unique:business_profiles,business_fax_number|min:6',
                ],
                [
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
                ]
            );
        }

        if ($this->business_fax_number) {
            $this->faxnumber = $this->business_fax_number;
        } else {
            $this->faxnumber = '';
        }
        if ($this->business_page_link) {
            $this->pagelink = $this->business_page_link;
        } else {
            $this->pagelink = '';
        }
        $this->businessProfileArray = array(
            'business_category_id' => $this->business_category_id,
            'business_name' => $this->business_name,
            'business_page_link' => $this->pagelink,
            'status' => 2,
            'merchant_id' => $this->merchant_id,
            'service_type_id' => $this->service_type_id,
            'type_of_service' => $this->business_type,
            'business_type' => $this->business_type,
            'business_phone' => $this->business_phone,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_fax_number' => $this->faxnumber,
            // 'no_physical_address' => false,
            'same_address' => true,
            // 'solution_type' =>$this->type,
        );
        // dd($this->businessProfileArray );
        $this->step3 = false;
        $this->step4 = false;
        $this->step5 = true;
        $this->profile_complete_value=20;
    }

    public function setStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];

        $this->street_address = $get_street;
        $this->business_location_street = $get_street;
        $this->edit_business_location_street = $get_street;
    }

    public function mailsetStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        $this->mailing_address = $get_street;
    }

    public function setCity($value)
    {
        $this->city = $value;
        $this->business_location_city = $value;
        $this->edit_business_location_city = $value;
    }
    public function mailsetCity($value)
    {
        $this->mailing_city = $value;
    }

    public function setState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->state_id = $get_state_value->id;
            $this->business_location_state = $get_state_value->id;
            $this->edit_business_location_state = $get_state_value->id;
        }else{
            $this->state_id = $value;
            $this->business_location_state = $value;
            $this->edit_business_location_state = $value;
        }
        
    }
    public function mailsetState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->mailing_state_id = $get_state_value->id;
        }else{
            $this->mailing_state_id = $value;
        }
        
    }

    public function setZipCode($value)
    {
        $this->zip_code = $value;
        $this->business_location_zip = $value;
        $this->edit_business_location_zip = $value;

        // dd($this->street_address,$this->city ,$this->state_id, $this->zip_code);
    }
    public function mailsetZipCode($value)
    {
        $this->mailing_zip_code = $value;
    }
    
    public function setLatLng($data){
        $this->location_latitude = $data['lat'];
        $this->listing_location_latitude = $data['lat'];
        $this->edit_location_latitude = $data['lat'];

        $this->location_longitude = $data['lng'];
        $this->listing_location_longitude = $data['lng'];
        $this->edit_location_longitude = $data['lng'];
    }

    public function mailsetLatLng($data){
        $this->mailing_listing_location_latitude = $data['lat'];
        $this->mailing_listing_location_longitude = $data['lng'];
    }

    public function business_address_submit(){
        // dd($this->type);
        if ($this->no_physical_address != true) {
            $input =  $this->validate(
                [
                    'street_address' => 'required',
                    'zip_code' => 'required|max:6|min:5',
                    'city' => 'required',
                    'state_id' => 'required',
                    'mailing_address' => 'required',
                    'mailing_zip_code' => 'required|max:6|min:5',
                    'mailing_city' => 'required',
                    'mailing_state_id' => 'required'
                ],
                [
                    'street_address.required' => 'The Street Address field is required',
                    'zip_code.required' => 'The Zip Code field is required',
                    'zip_code.max' => 'The Zip Code must be 6 digit',
                    'zip_code.min' => 'The Zip Code atlist 5 digit',
                    'city.required' => 'The City field is required',
                    'state_id.required' => 'The State field is required',
                    'mailing_address.required' => 'The Mailing Address field is required',
                    'mailing_zip_code.required' => 'The Mailing Zip Code field is required',
                    'mailing_zip_code.max' => 'The Mailing Zip Code must be 6 digit',
                    'mailing_zip_code.min' => 'The Mailing Zip Code must be 6 digit',
                    'mailing_city.required' => 'The Mailing City field is required',
                    'mailing_state_id.required' => 'The Mailing State field is required',
                ]
            );

        }else{
            $input =  $this->validate([
                'mailing_address' => 'required',
                'mailing_zip_code' => 'required|max:6|min:5',
                'mailing_city' => 'required',
                'mailing_state_id' => 'required',
            ],
            [
                'mailing_address.required' => 'The Mailing Address field is required',
                'mailing_zip_code.required' => 'The Mailing Zip Code field is required',
                'mailing_zip_code.max' => 'The Mailing Zip Code must be 6 digit',
                'mailing_zip_code.min' => 'The Mailing Zip Code atlist 5 digit',
                'mailing_city.required' => 'The Mailing City field is required',
                'mailing_state_id.required' => 'The Mailing State field is required',
            ]);
        }
        $this->create_business_profile = BusinessProfile::create($this->businessProfileArray);
        if ($this->allow_notification != null) {
            $notification = true;
        } else {
            $notification = false;
        }
        

        $businessid = strtoupper(substr($this->create_business_profile->business_name, 0, 3)) . '/0' . $this->create_business_profile->id;
        $this->create_business_profile->businessId = $businessid;
        $this->create_business_profile->allow_notification = $notification;

        // dd($this->no_physical_address);
        if ($this->no_physical_address == false) {
            // dd('endter');
            $this->create_business_profile->street_address = $this->street_address;
            $this->create_business_profile->zip_code = $this->zip_code;
            $this->create_business_profile->city = $this->city;
            $this->create_business_profile->state_id = $this->state_id;
            $this->create_business_profile->mailing_address = $this->mailing_address;
            $this->create_business_profile->mailing_city = $this->mailing_city;
            $this->create_business_profile->mailing_zipcode = $this->mailing_zip_code;
            $this->create_business_profile->mailing_state_id = $this->mailing_state_id;
            $this->create_business_profile->same_address = false;
            $this->create_business_profile->no_physical_address = false;
            $state_name = State::where('id',$this->state_id)->first();
            $this->stateName = $state_name->name;
            $this->primary_business_address = $this->street_address.', '.$this->city.', '.$state_name->name.', '.$this->zip_code;
        }else{
            // dd('sdvds');

            $this->create_business_profile->mailing_address = $this->mailing_address;
            $this->create_business_profile->mailing_city = $this->mailing_city;
            $this->create_business_profile->mailing_zipcode = $this->mailing_zip_code;
            $this->create_business_profile->mailing_state_id = $this->mailing_state_id;
            $this->create_business_profile->same_address = false;
            $this->create_business_profile->no_physical_address = true;
            $state_name = State::where('id',$this->mailing_state_id)->first();
            $this->MailingstateName = $state_name->name;
            $this->primary_business_address = $this->mailing_address.', '.$this->mailing_city.', '.$state_name->name.', '.$this->mailing_zip_code;
        }
        $this->create_business_profile->save();

        



        $user = User::find($this->merchant_id);
                $user->business_id = $this->create_business_profile->id;
                $user->save();
        $this->business_id = $this->create_business_profile->id;
        if($this->create_business_profile){
            $this->step5 = false;
            // $this->step6 = true;
            $this->profile_complete_value=25;
            $this->business_story = true;
            $this->emit('summernoteOn');

        }
        // $this->step5 = false;
        // $this->step6 = true;


    }

    public function UpdatedBusinessStoryImage(){
        $this->validate([
            'business_story_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'business_story_image.required' => 'select at least one image for deal',
            'business_story_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]);  
    }
    
    public function business_story_submit(){
        // dd($this->business_story_image,$this->story_message);
        $input =  $this->validate(
            [
                'story_message' => 'required'
            ],
            [
                'story_message.required' => 'The Story field is required',
            ]
        );

        $this->create_business_profile->business_story = $this->story_message;
        $this->create_business_profile->save();
        if($this->business_story_image){
            $business_story_image_submit = $this->create_business_profile->addMedia($this->business_story_image->getRealPath())
            ->usingName($this->business_story_image->getClientOriginalName())
            ->toMediaCollection('businessStoryImage');
            $this->create_business_profile->save();
        }

        $this->emit('summernoteOver');
        $this->business_story = false;
        $this->overview_message = '';
        $this->business_overview = true;
        $this->profile_complete_value=20;

    }

    public function skipStoryPhoto(){
        // $this->create_business_profile->business_story = $this->story_message;
        // $this->create_business_profile->save();
        // $input =  $this->validate(
        //     [
        //         'story_message' => 'required'
        //     ],
        //     [
        //         'story_message.required' => 'The Story field is required',
        //     ]
        // );
        $this->emit('summernoteOver');
        $this->business_story = false;
        $this->overview_message = '';
        $this->business_overview = true;
    }

    public function business_overview_submit(){
        // dd('dcdc');
        // dd($this->overview_message);
        if($this->overview_message){
            $this->create_business_profile->business_overview = $this->overview_message;
            $this->create_business_profile->save();
        }
        $this->business_story = false;
        $this->overview_message = '';
        $this->business_overview = false;
        $this->step6 = true;
        $this->profile_complete_value=20;

    }

    public function goToStory(){
        $this->emit('summernoteOn');
        $this->business_story = true;
        $this->business_overview = false;
    }

    public function business_photo_submit(){
        // dd($this->businessLogo, $this->imageBusiness, $this->mainMediaBusiness);
        $this->validate([
            'business_logo' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'business_logo.required' => 'Please select an image for Business',
            'business_logo.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]);
        if($this->business_logo){
            $business_logo_submit = $this->create_business_profile->addMedia($this->business_logo->getRealPath())
            ->usingName($this->business_logo->getClientOriginalName())
            ->toMediaCollection('businessProfileLogo');
            $this->create_business_profile->main_image = '/storage/'.$business_logo_submit->id.'/'.$business_logo_submit->file_name;
            $this->create_business_profile->save();
        }
        $this->complete_percent = 50;
        $this->step6 = false;
        $this->step7 = true;
    }

    public function deal_create(){
        $this->step7 = false;
        $this->deal_step = true;
        $this->deal_step1 = false;
        $this->is_loyalty = false;
        $this->emit('dealDatepicker');
    }

    public function handleDealDatepickerEnable(){
        $this->emit('dealDatepicker');
        $this->emit('enableeventdatepicker');
        
    }

    public function loyalty_create(){
        $this->step7 = false;
        $this->loyalty_step = true;
        $this->deal_step1 = false;
        $this->is_loyalty = true;
        $this->emit('dealDatepicker');
    }

    public function goToStep7(){
        $this->step7 = true;
        $this->loyalty_step = false;
        $this->deal_step1 = false;
    }

    // public function hydrate()
    // {
    //     $this->emit('select2');
    // }

    public function UpdatedLoyaltyImage(){
        $this->validate([
            'loyalty_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'loyalty_image.required' => 'Select an image for loyalty',
            'loyalty_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]); 
        $this->loyalty_main_photo = $this->loyalty_image;
    }

    public function loyalty_step_submit(){
        $this->validate([
            'loyalty_image' => 'required|mimes:jpg,jpeg,png,svg',
        ], [
            'loyalty_image.required' => 'select at least one image for deal',
            'loyalty_image.mimes' => "The Upload File must be a file type of:jpg,jpeg,png,svg"
        ]);
        
        $this->business_location_street = '';
        $this->business_location_city = '';
        $this->business_location_state = '';
        $this->business_location_zip = '';
        // dd($this->no_physical_address);
        // if($this->no_physical_address == true){ // 000000000000
        //     $this->loyalty_step = false;
        //     $this->deal_event_step = true;
        //     $this->loyalty_step1 = false; 
        // }else{
            $this->deal_event_step = false;
            $this->loyalty_step = false;
            $this->loyalty_step1 = true; 
        // }
    }

    public function goToLoyaltyStep(){
        $this->loyalty_step = true;
        $this->loyalty_step1 = false;
    }

    public function skipLoyaltyPhoto(){
        $this->business_location_street = '';
        $this->business_location_city = '';
        $this->business_location_state = '';
        $this->business_location_zip = '';

        // dd($this->no_physical_address);

        // if($this->no_physical_address == true){ // 000000000000
        //     $this->loyalty_step = false;
        //     $this->deal_event_step = true;
        //     $this->loyalty_step1 = false;
        // }else{
            $this->loyalty_step = false;
            $this->deal_event_step = false;
            $this->loyalty_step1 = true;
        // }
    }

    public function UpdatedLoyaltySelectedOption(){
        // // dd($$this->business_id);
        // $this->business_id = 10000;
        // $this->businessProfileArray['business_name'] = 'aaaaaaaaaaaaa';
        $find_business_loc = BusinessLocation::where('business_profile_id', $this->business_id)->where('participating_type','=','Participating')->get()->toArray();

        if($this->loyalty_selected_option == "for_yes"){
            
            // if(empty($find_business_loc)){
            //     $this->loyalty_business_location = new BusinessLocation;
            //     $this->loyalty_business_location->business_profile_id =  $this->business_id;
            //     $this->loyalty_business_location->location_name =  $this->mailing_address;
            //     $this->loyalty_business_location->address =  $this->mailing_address;
            //     $this->loyalty_business_location->city =  $this->mailing_city;
            //     $this->loyalty_business_location->state =  $this->MailingstateName;
            //     $this->loyalty_business_location->zip_code =  $this->mailing_zip_code;
            //     $this->loyalty_business_location->location_type = 'Not Headquarters';
            //     $this->loyalty_business_location->participating_type = 'Participating';
            //     $this->loyalty_business_location->latitude = $this->listing_location_latitude;
            //     $this->loyalty_business_location->longitude = $this->listing_location_longitude;
            //     $this->loyalty_business_location->save();

            //     $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->street_address,0,3)).'/0'.$this->loyalty_business_location->id;
            //     $this->loyalty_business_location->locationId = $locationId; 
            //     $this->loyalty_business_location->save();
            // }
        }
        elseif($this->loyalty_selected_option == "for_no"){
            // dd('ascsc');
            // $this->emit('participatingLocationPopup');
            if(empty($find_business_loc)){
                $this->emit('nonParticipatingLocationPopup');
            }
        }
    }

    public function clickToOpenPerticipatingModal(){
        $find_business_loc = BusinessLocation::where('business_profile_id', $this->business_id)->where('participating_type','=','Participating')->get()->toArray();
        if(empty($find_business_loc)){
            $this->emit('participatingLocationPopup');
        }else{
            $this->emit('CloseNonParticipatingLocationPopup');
        }
    }

    public function loyalty_step1_submit(){

        $input =  $this->validate(
            [
                'loyalty_location_number' => 'required',
                'loyalty_location_added' => 'required',
                'loyalty_selected_option' => 'required',
            ],
            [
                'loyalty_location_number.required' => 'The field is required.',
                'loyalty_location_added.required' => 'The field is required.',
                'loyalty_selected_option.required' => 'The field is required.',

            ]
        );

        $find_business_loc = BusinessLocation::where('business_profile_id', $this->business_id)->where('participating_type','=','Participating')->count();
        if($find_business_loc == 0){
            if($this->loyalty_selected_option == "for_yes"){
                
                if($this->street_address){
                    $this->loyalty_business_location = new BusinessLocation;
                    $this->loyalty_business_location->business_profile_id =  $this->business_id;
                    $this->loyalty_business_location->location_name =  $this->street_address;
                    $this->loyalty_business_location->address =  $this->street_address;
                    $this->loyalty_business_location->city =  $this->street_address;
                    $state_name = State::where('id',$this->state_id)->first();
                    $this->loyalty_business_location->state =  $state_name->name;
                    $this->loyalty_business_location->state_id = $this->state_id;
                    $this->loyalty_business_location->zip_code =  $this->zip_code;
                    $this->loyalty_business_location->location_type = 'Not Headquarters';
                    $this->loyalty_business_location->participating_type = 'Participating';
                    $this->loyalty_business_location->business_phone = $this->business_phone;
                    $this->loyalty_business_location->business_email = $this->business_email;
                    $this->loyalty_business_location->latitude = $this->listing_location_latitude;
                    $this->loyalty_business_location->longitude = $this->listing_location_longitude;
                    $this->loyalty_business_location->save();
                }else{
                    $this->loyalty_business_location = new BusinessLocation;
                    $this->loyalty_business_location->business_profile_id =  $this->business_id;
                    $this->loyalty_business_location->location_name =  $this->mailing_address;
                    $this->loyalty_business_location->address =  $this->mailing_address;
                    $this->loyalty_business_location->city =  $this->mailing_city;
                    $state_name = State::where('id',$this->mailing_state_id)->first();
                    $this->loyalty_business_location->state =  $state_name->name;
                    $this->loyalty_business_location->state_id = $this->mailing_state_id;
                    $this->loyalty_business_location->zip_code =  $this->mailing_zip_code;
                    $this->loyalty_business_location->location_type = 'Not Headquarters';
                    $this->loyalty_business_location->participating_type = 'Participating';
                    $this->loyalty_business_location->latitude = $this->mailing_listing_location_latitude;
                    $this->loyalty_business_location->longitude = $this->mailing_listing_location_longitude;
                    $this->loyalty_business_location->business_phone = $this->business_phone;
                    $this->loyalty_business_location->business_email = $this->business_email;
                    $this->loyalty_business_location->save();
                }

                $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->street_address,0,3)).'/0'.$this->loyalty_business_location->id;
                $this->loyalty_business_location->locationId = $locationId; 
                $this->loyalty_business_location->save();
            }else{
                $this->emit('participatingLocationPopup');
            }
            
        }else{
            $this->locations = BusinessLocation::where('business_profile_id',$this->business_id)->where('status',1)->where('participating_type','Participating')->get();
            $this->loyalty_step = false;
            $this->loyalty_step1 = false;
            $this->loyalty_step2 = true;
            $this->emit('enableloyaltydatepicker');
        }

    }

    public function UpdatedLoyaltyLocationNumber(){
        $loyalty_location_number = $this->loyalty_location_number;
        $added_number = $this->frist_location + 1;
        $this->loyalty_location_added = $added_number.' of '.$loyalty_location_number.' location';
        $this->edit_physical_address = $this->loyalty_location_number;
        $this->edit_added_location = $this->loyalty_location_added;
    }

    public function updatedNoEnd(){
        if($this->no_end == true){
            $this->yes_end = false;
           
        }
        else{
            $this->yes_end = true;
        }
        $this->emit('enableloyaltydatepicker');
    }

    public function selectLoyaltyType(){
        if($this->no_end == true){
            // dd($this->loyalty_location_ids);
            $this->validate([
                'loyalty_start_date' => 'required',
                'no_end'=> 'required',
                'loyalty_location_ids' => 'required',
                'loyalty_location_ids' => 'required',
                'purchase_goal' => 'required',
            ], [
                'loyalty_start_date.required' => 'select start date of loyalty deal',
                'loyalty_location_ids.required' => 'Please select at least one location',
                'purchase_goal.required' => 'Please select any one purchase goal'
            ]);
            $this->emit('enableloyaltydatepicker');
        }
        else{
            $this->validate([
                'loyalty_start_date' => 'required',
                'loyalty_end_date'=> 'required',
                'loyalty_location_ids' => 'required',
                'loyalty_location_ids' => 'required',
                'purchase_goal' => 'required',
            ], [
                'loyalty_start_date.required' => 'select start date of loyalty deal',
                'loyalty_end_date.required' => 'select end date of loyalty deal',
                'loyalty_location_ids.required' => 'Please select at least one location',
                'purchase_goal.required' => 'Please select any one purchase goal'
            ]);
            $this->emit('enableloyaltydatepicker');
        }
        if($this->purchase_goal == 'free'){
            // dd('next');
            $business_category_id = $this->businessProfileArray['business_category_id'];
            $this->categoryData = BusinessCategory::find($business_category_id);
            $text = str_replace('[Merchant Name]', $this->businessProfileArray['business_name'], $this->categoryData->terms_conditions);
            $text2 = strip_tags($text);
            $this->loyalty_about =  str_replace('&nbsp;', '', $text2);
            $terms = TermsAndCondition::where('id',2)->first();
            $this->loyalty_terms =  $terms->description;
            $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
            // $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
            // $this->loyalty_item_select_display = true;

            $this->loyalty_step2 = false;
            $this->loyalty_step3 = true;
        }
        else{
            $this->loyalty_step2 = false;
            $this->loyalty_step4 = true;
        }

        $this->loyalty_item_select_display = true;
        
    }

    public function goToLoyaltyStep1(){
        // if($this->no_physical_address == true){ // 000000000000
        //     $this->loyalty_step = false;
        //     $this->loyalty_step1 = false;
        //     $this->loyalty_step2 = false;
        //     $this->deal_event_step = true;
        // }else{
            $this->loyalty_step = false;
            $this->loyalty_step1 = true;
            $this->loyalty_step2 = false;
            $this->deal_event_step = false;
        // }
    }

    public function goToLoyaltyStep2(){
        $this->loyalty_step3 = false;
        $this->loyalty_step4 = false;
        $this->loyalty_step1 = false;
        $this->loyalty_step2 = true;
    }

    public function createLoyaltyProgram(){
        if($this->purchase_goal == 'deal_discount'){
            $dis_amount = substr($this->loyalty_discount_amount, 1);
            $dis_amount = str_replace(',', '', $dis_amount);
            $dis_amount = (float)$dis_amount;
            $this->disAmount = $dis_amount;
            //dd($this->program_amount);
            $this->validate([
                'loyalty_item_id' => 'required',
                'program_amount' => 'required|numeric|lte:5000',
                'disAmount' => 'required|numeric',
                'when_order'  => 'required',
                'loyalty_discount_type' => 'required',
                'dscnt_amount' => 'required|numeric|' . ($this->loyalty_discount_type === 'percentage' ? 'lt:100' : '')
            ],
            [
                'loyalty_item_id.required' => 'Please select any one item',
                'program_amount.required' => 'This field is required',
                'program_amount.numeric' => 'This field must be a number',
                'program_amount.lte' => 'This amount cannot exceed $5,000',
                'disAmount.required' => 'This field is required',
                'disAmount.numeric' => 'This field must be a number',
                'when_order.required' => 'This field is required',
                'loyalty_discount_type.required' => 'This field is required',
                'dscnt_amount.required' => 'This discount amount field is required',
            ]);
            // if($this->loyalty_discount_type == 'percentage'){
            //     $this->validate([
            //         'program_amount' => 'required|numeric|lt:100',
            //         'dscnt_amount'=> 'required|numeric|lt:100'
            //     ],
            //     [
            //         'program_amount.required' => 'This field is required',
            //         'program_amount.numeric' => 'This field must be a number',
            //         'program_amount.lt' => 'This field must be less than 100',
            //         'dscnt_amount.required' => 'This field is required',
            //         'dscnt_amount.numeric' => 'This field must be a number',
            //         'dscnt_amount.lt' => 'Amount entered should be less than the 100%',
            //     ]);
            // }

            if($this->loyalty_discount_type == 'dollar'){
                $p_amnt = $this->program_amount;
                $hidden_d_amnt = $this->dscnt_amount;
                if($p_amnt <= $hidden_d_amnt){
                    $this->validate([
                        'program_amount' => 'required',
                        'dscnt_amount' => 'lt:dscnt_amount',
                    ],
                    [
                        'dscnt_amount.lt' => 'Amount entered should be less than the dollar amount to spend.'
                    ]);
                }
                
            }
        }
        else{
            $this->validate([
                'loyalty_item_id' => 'required',
                'have_to_buy' => 'required|numeric',
                'free_item'  => 'required',
                'off_percentage' => 'required',
            ],
            [
                'loyalty_item_id.required' => 'Please select any one item',
                'have_to_buy.required' => 'This field is required',
                'have_to_buy.numeric' => 'This field must be a number',
                'free_item.required' => 'This field is required',
                'off_percentage.required' => 'This field is required',
            ]);
        }
        // dd('sdcsdc');
        // $this->saveFinalLoyalty();
        
        // dd($this->item_service_modal);
        if($this->item_service_modal == true){
            $this->item_service_modal_open = true;
            // $this->emit('openItemPriceModal');
            // $this->emit('hideStyle');
            $this->get_items = ItemOrService::with('value')
            ->whereIn('id', $this->loyalty_item_id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'item_name' => $item->item_name,
                    'price' => $item->value->isNotEmpty() ? $item->value->first()->price : '00'
                ];
            })->toArray();
            // dd($this->get_items);
            $this->selected_item_value = collect($this->get_items)
            ->pluck('price', 'id')
            ->toArray();
        }else{
            $this->saveFinalLoyalty();
        }
    }

    public function UpdatedSelectedItemValue(){
        $this->emit('hideStyle');
    }

    public function closeSubmitNewItemPrice(){
        $this->loyalty_item_id = '';
        $this->item_service_modal_open = false;
    }
    public function submitNewItemPrice()
    {
        // $this->emit('hideStyle');
        $this->validate([
            'selected_item_value.*' => 'required|numeric|min:0.01',
        ], [
            'selected_item_value.*.required' => 'The price field is required.',
            'selected_item_value.*.numeric' => 'The price must be a valid number.',
            'selected_item_value.*.min' => 'The price must be greater than 0.',
        ]);

        
        foreach ($this->selected_item_value as $item_id => $price) {
           
            $find_item_id = GiftItemValue::where('item_id',$item_id)->first();
            if($find_item_id){
                GiftItemValue::where('item_id', $item_id)->update(['price' => $price]);
            }else{
                $itemvalue = new GiftItemValue;
                $itemvalue->item_id = $item_id;
                $itemvalue->price = $price;
                $itemvalue->merchant_id = $this->merchant_id;
                $itemvalue->save();
            } 
        }
        $this->item_service_modal =false;
        $this->item_service_modal_open = false;
    }

    public function UpdatedMainImageUploadLoyalty(){
        // dd($this->main_image_upload_loyalty);
        $this->validate([
            'main_image_upload_loyalty' => 'nullable|mimes:png,jpg|max:25600',
        ], [
            'main_image_upload_loyalty.mimes' => 'Image file should be  jpg and png type',
            'main_image_upload_loyalty.max' => 'Image file size may not be greater than 25 mb',
        ]);
    }

    public function PreviewProgram(){
        // dd($this->loyalty_location_ids);
        $blnkArr = array();
        $this->program_point = 0;
        $this->loyalty_item_id = array();
        if (is_array($this->loyalty_item_id)) {
            if (count($this->loyalty_item_id) >= 0) {
                for ($i = 0; $i < count($this->loyalty_item_id); $i++) {
                    $itemNameList = ItemOrService::find($this->loyalty_item_id[$i]);
                    $itemName =  $itemNameList->item_name;
                    if($itemNameList->item_price != ''){
                        $price = $itemNameList->item_price->price;
                        if ($this->purchase_goal == "free") {
                            if($this->have_to_buy != ''){
                                $this->program_point = round(((($price*0.075)/.50)*$this->have_to_buy) + $this->program_point);
                            }
                        }
                       
                        if ($this->purchase_goal == "deal_discount") {
                           
                            if($this->spend_amount != ''){
                                $amount = substr($this->spend_amount, 1);
                                $amount = str_replace(',', '', $amount);
                                $amount = (float)$amount;
                                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                            }
                            
                        }
                        
                    }
                    array_push($blnkArr, $itemName);
                }
            }
        }
        if ($this->purchase_goal == "free") {
            if($this->have_to_buy != ''){
                if($this->free_item != ''){
                    if($this->off_percentage != ''){
                        $this->progameName = "Purchase" . " " . $this->have_to_buy . " " . implode(",", $blnkArr) . " " . "And Get" . " " . $this->free_item . " " . "For ".$this->off_percentage;
                    }
                }
            }
        }
        if ($this->purchase_goal == "deal_discount") {
            if($this->spend_amount != ''){
                if($this->loyalty_discount_amount != ''){
                    if($this->when_order != ''){
                        $this->progameName = "Purchase" . " " . $this->spend_amount . " " . "Or More Worth Of" . " " . implode(",", $blnkArr) . " " . "And Receive A" . " " . $this->loyalty_discount_amount . " " . "Discount on" . " " . $this->when_order . " " . "Order";
                    }
                }
            }
        }
        $loyalty_address = BusinessLocation::where('id',$this->loyalty_location_ids)->first();
        $this->loyalty_address = $loyalty_address->address;
        $this->loyalty_single_photo = $this->loyalty_main_photo;
        $this->loyalty_item_select_display = false;
        // dd('ssc');
        $this->emit('enablepreviewprogram');
    }

    public function saveFinalLoyalty(){
        $startdate = date_create($this->loyalty_start_date);
        $startDate = date_format($startdate, 'Y-m-d');
        $this->loalty_program = new MerchantLoyaltyProgram;
        $this->loalty_program->merchant_id =$this->merchant_id;
        $this->loalty_program->business_profile_id = $this->business_id;
        $this->loalty_program->purchase_goal = $this->purchase_goal;
        $this->loalty_program->start_on = $startDate;
        $this->loalty_program->about_program = $this->loyalty_about;
        $this->loalty_program->terms_conditions = $this->loyalty_terms;

        if ($this->no_end != true) {
            $enddate = date_create($this->loyalty_end_date);
            $endDate = date_format($enddate, 'Y-m-d');
            $this->loalty_program->end_on = $endDate;
        }
        if($this->purchase_goal == 'free'){
            $this->loalty_program->have_to_buy = $this->have_to_buy;
            $this->loalty_program->free_item_no = $this->free_item_no;
            $this->loalty_program->off_percentage = $this->off_percentage;
            $abbreviation =  $this->free_item;

        }else{
            $this->loalty_program->spend_amount = $this->spend_amount;
            $this->loalty_program->discount_amount = $this->loyalty_discount_amount;
            $this->loalty_program->when_order = $this->when_order;

            if($this->spend_amount != ''){
                // dd($this->program_point);
                $amount = substr($this->spend_amount, 1);
                $amount = str_replace(',', '', $amount);
                $amount = (float)$amount;
                // dd($amount);
                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                //dd($this->program_point);
            }
        }
        $this->loalty_program->save();

        // dd($this->loyalty_item_id);
        $blnkArr = array();
        // // $this->loyalty_item_id = array();
        // // if (is_array($this->loyalty_item_id)) {
            
        //     if ($this->loyalty_item_id) {
                
        //         // for ($i = 0; $i < count($this->loyalty_item_id); $i++) {
        //             $item = new LoyaltyProgramItem();
        //             $item->loyalty_program_id = $this->loalty_program->id;
        //             $item->item_id = $this->loyalty_item_id;
        //             $item->save();
        //             $itemNameList = ItemOrService::find($this->loyalty_item_id);
        //             $itemName =  $itemNameList->item_name;
        //             if($itemNameList->item_price != ''){
        //                 $price = $itemNameList->item_price;
        //                 if ($this->purchase_goal == "free") {
        //                     if($this->have_to_buy != ''){
        //                         $this->program_point = round(((($price*0.075)/.50)*$this->have_to_buy) + $this->program_point);
        //                         $this->loalty_program->program_points = $this->program_point;
        //                         $this->loalty_program->save();
        //                     }
        //                 }
                       
        //                 if ($this->purchase_goal == "deal_discount") {
                           
        //                     if($this->spend_amount != ''){
        //                         $amount = substr($this->spend_amount, 1);
        //                         $amount = str_replace(',', '', $amount);
        //                         $amount = (float)$amount;
        //                         $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
        //                         $this->loalty_program->program_points = $this->program_point;
        //                         $this->loalty_program->save();
        //                     }
                            
        //                 }
                        
        //             }
        
        //             array_push($blnkArr, $itemName);
                    
        //         // }
        //     }
        // // }

        if (is_array($this->loyalty_item_id)) {
            // dd(is_array($request->free_item));
            if (count($this->loyalty_item_id) > 0) {
                for ($i = 0; $i < count($this->loyalty_item_id); $i++) {
                    $item = new LoyaltyProgramItem();
                    $item->loyalty_program_id = $this->loalty_program->id;
                    $item->item_id = $this->loyalty_item_id[$i];
                    $item->save();
                    $itemNameList = ItemOrService::find($this->loyalty_item_id[$i]);
                    $itemName =  $itemNameList->item_name;
                    // dd($itemNameList->item_price);
                    if($itemNameList->item_price != ''){
                        // $price = $itemNameList->item_price->price;
                        $price = $itemNameList->item_price;
                        if ($this->purchase_goal == "free") {
                            if($this->have_to_buy != ''){
                                $this->program_point = round(((($price*0.075)/.50)*$this->have_to_buy) + $this->program_point);
                                $this->loalty_program->program_points = $this->program_point;
                                $this->loalty_program->save();
                            }
                        }
                       
                        if ($this->purchase_goal == "deal_discount") {
                           
                            if($this->spend_amount != ''){
                                // dd($this->program_point);
                                $amount = substr($this->spend_amount, 1);
                                $amount = str_replace(',', '', $amount);
                                $amount = (float)$amount;
                                // dd($amount);
                                $this->program_point = round(((($amount*0.075)/.50)) + $this->program_point);
                                $this->loalty_program->program_points = $this->program_point;
                                $this->loalty_program->save();
                                //dd($this->program_point);
                            }
                            
                        }
                        
                    }
        
                    array_push($blnkArr, $itemName);
                    // dd($itemName);
                }
            }
        }

        if($this->serving_area1_street == null && $this->serving_area2_street == null && $this->serving_area2_street == null){
            $reward_location = new LoyaltyRewardLocation;
            $reward_location->loyalty_program_id = $this->loalty_program->id;
            $reward_location->location_id = $this->loyalty_location_ids;
            $reward_location->status = 1;
            if ($this->loalty_program->end_on != null) {
                $reward_location->end_date = $this->loalty_program->end_on;
            }
            $reward_location->save();

            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->loyalty_business_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        if($this->main_image_upload_loyalty){
            $loyalty_photo = $this->loalty_program->addMedia($this->main_image_upload_loyalty->getRealPath())
                ->usingName($this->main_image_upload_loyalty->getClientOriginalName())
                ->toMediaCollection('loyaltyPhotos');
            $this->loalty_program->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
            $this->loalty_program->save();
        }else{
            if($this->loyalty_single_photo){
                if($this->loyalty_single_photo){
                        $loyalty_photo = $this->loalty_program->addMedia($this->loyalty_single_photo->getRealPath())
                        ->usingName($this->loyalty_single_photo->getClientOriginalName())
                        ->toMediaCollection('loyaltyPhotos');
                        $this->loalty_program->main_photo = '/storage/'.$loyalty_photo->id.'/'.$loyalty_photo->file_name;
                        $this->loalty_program->save();
                }
            }
        }
        
        if ($this->purchase_goal == "free") {
            $progameName = "Purchase" . " " . $this->have_to_buy . " " . implode(",", $blnkArr) . " " . "And Get" . " " . $abbreviation . " " . "For ".$this->off_percentage;
            $this->loalty_program->program_name = $progameName;
            $this->loalty_program->save();
        }
        if ($this->purchase_goal == "deal_discount") {
            $progameName = "Purchase" . " " . $this->spend_amount . " " . "Or More Worth Of" . " " . implode(",", $blnkArr) . " " . "And Receive A" . " " . $this->loyalty_discount_amount . " " . "Discount on" . " " . $this->when_order . " " . "Order";
            $this->loalty_program->program_name = $progameName;
            $this->loalty_program->save();
        }
        $this->start_on_date = date_format(date_create($this->loyalty_start_date),'l F dS Y' );



        if($this->serving_area1_street != null){
            // $this->create_serving1_deal_location = BusinessLocation::create($this->serving_area1_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area1_street,0,3)).'/0'.$this->create_serving1_deal_location->id;
            $this->create_serving1_deal_location->locationId = $locationId; 
            $this->create_serving1_deal_location->save();

            $reward_location = new LoyaltyRewardLocation;
            $reward_location->loyalty_program_id = $this->loalty_program->id;
            $reward_location->location_id = $this->create_serving1_deal_location->id;
            $reward_location->status = 1;
            if ($this->loalty_program->end_on != null) {
                $reward_location->end_date = $this->loalty_program->end_on;
            }
            $reward_location->save();

            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving1_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();

        }
        if($this->serving_area2_street != null){
            // $this->create_serving2_deal_location = BusinessLocation::create($this->serving_area2_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area2_street,0,3)).'/0'.$this->create_serving2_deal_location->id;
            $this->create_serving2_deal_location->locationId = $locationId; 
            $this->create_serving2_deal_location-> save();

            $reward_location = new LoyaltyRewardLocation;
            $reward_location->loyalty_program_id = $this->loalty_program->id;
            $reward_location->location_id = $this->create_serving2_deal_location->id;
            $reward_location->status = 1;
            if ($this->loalty_program->end_on != null) {
                $reward_location->end_date = $this->loalty_program->end_on;
            }
            $reward_location->save();

            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving2_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        if($this->serving_area3_street != null){
            // $this->create_serving3_deal_location = BusinessLocation::create($this->serving_area2_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area3_street,0,3)).'/0'.$this->create_serving3_deal_location->id;
            $this->create_serving3_deal_location->locationId = $locationId; 
            $this->create_serving3_deal_location->save();

            $reward_location = new LoyaltyRewardLocation;
            $reward_location->loyalty_program_id = $this->loalty_program->id;
            $reward_location->location_id = $this->create_serving3_deal_location->id;
            $reward_location->status = 1;
            if ($this->loalty_program->end_on != null) {
                $reward_location->end_date = $this->loalty_program->end_on;
            }
            $reward_location->save();
            
            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving3_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        
        if($this->event_name){
            $startFormattedDate = Carbon::createFromFormat('m/d/Y', $this->event_start_date)->format('Y-m-d');
            if($this->event_end_date){
                $endFormattedDate = Carbon::createFromFormat('m/d/Y', $this->event_end_date)->format('Y-m-d');
            }else{
                $endFormattedDate = null;
            }
            $this->save_deal_event = new Events;
            $this->save_deal_event->business_id = $this->business_id;
            $this->save_deal_event->loyalty_id = $this->loalty_program->id;
            $this->save_deal_event->event_name = $this->event_name;
            $this->save_deal_event->is_event_advertise = $this->advertise_event;
            $this->save_deal_event->event_start_date = $startFormattedDate;
            $this->save_deal_event->event_end_date = $endFormattedDate;
            $this->save_deal_event->one_day_event = $this->one_day_event;
            $this->save_deal_event->event_street_address = $this->event_address;
            $this->save_deal_event->event_city = $this->event_city;
            $this->save_deal_event->event_state_id = $this->event_state;
            $this->save_deal_event->event_zip = $this->event_zip;
            $this->save_deal_event->event_lat = $this->event_latitude;
            $this->save_deal_event->event_long = $this->event_longitude;
            $this->save_deal_event->save();
        }

        if( $this->loalty_program){
            $this->loyalty_step5 = true;
            $this->loyalty_step4 = false;
            $this->loyalty_step3 = false;
        }

    }

    public function completeLoyalty(){
        $this->loyalty_step5 = false;
        $this->user_name = $this->name;
        $this->user_email = $this->email;
        $this->user_phone = $this->phone;
        $this->deal_step5 = false;
        $this->step8 = true;
        $this->profile_complete_value=100;

    }

    public function deal_step_submit(){
       $this->deal_step = false;
       $this->deal_step1 = true;
       $this->business_location_street = '';
       $this->business_location_city = '';
       $this->business_location_state = '';
       $this->business_location_zip = '';
    }

    public function goToStepDealStep(){
        $this->deal_step = true;
        $this->deal_event_step = false;
        $this->deal_step1 = false;
        $this->emit('dealDatepicker');
    }
    
    public function goToStepDealStep1(){
        $this->deal_event_step = false;
        $this->deal_step1 = true;
        $this->deal_step2 = false;
        $this->physical_location = '';
    }

    public function goToStepDealStep2(){
        // if($this->no_physical_address == true){ // 000000000000
        //     $this->deal_event_step = true;
        //     $this->deal_step1 = false;
        //     $this->deal_step2 = false;
        //     $this->deal_step3 = false;
        //     $this->emit('enableeventdatepicker');
        // }else{
            $this->deal_event_step = false;
            $this->deal_step1 = false;
            $this->deal_step3 = false;
            $this->deal_step2 = true;
        // }

    }

    public function goToStepDealStep3(){
        

        $business_category_id = $this->businessProfileArray['business_category_id'];
        $this->categoryData = BusinessCategory::find($business_category_id);
        $text = str_replace('[Merchant Name]', $this->businessProfileArray['business_name'], $this->categoryData->terms_conditions);
        $text2 = strip_tags($text);
        $this->about_program =  str_replace('&nbsp;', '', $text2);
        $terms = TermsAndCondition::where('id',2)->first();
        $this->terms_condition =  $terms->description;        
        $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
        $this->emit('offAdvertiseModel');
        $this->deal_step3 = true;
        $this->deal_step4 = false;

    }

    public function deal_step1_submit(){
        // if($this->no_physical_address == true){ // 000000000000
        //     $this->deal_step1 = false;
        //     $this->deal_event_step = true;
        //     $this->emit('enableeventdatepicker');
        // }else{
            $this->deal_step1 = false;
            $this->deal_step2 = true;
        // }
       
    }

    public function skipDealPhoto(){
        // if($this->no_physical_address == true){ // 000000000000
        //     $this->deal_step1 = false;
        //     $this->deal_step2 = false;
        //     $this->deal_event_step = true;
        //     $this->emit('enableeventdatepicker');
        // }else{
            $this->deal_step1 = false;
            $this->deal_step2 = true;
        // }
    }

    public function UpdatedSelectedOption(){
        $find_business_loc = BusinessLocation::where('business_profile_id', $this->business_id)->where('participating_type','=','Participating')->get()->toArray();

        if($this->selected_option == "for_no"){
            if(empty($find_business_loc)){
                $this->emit('nonParticipatingLocationPopup');
            }
        }elseif($this->selected_option == "for_yes"){
            if(empty($find_business_loc)){
                $this->loyalty_business_location_business_profile_id =  $this->business_id;
                $this->loyalty_business_location_location_name =  $this->mailing_address;
                $this->loyalty_business_location_address =  $this->mailing_address;
                $this->loyalty_business_location_city =  $this->mailing_city;
                $this->loyalty_business_location_state =  $this->MailingstateName;
                $this->loyalty_business_location_state_id = $this->mailing_state_id;
                $this->loyalty_business_location_zip_code =  $this->mailing_zip_code;
                $this->loyalty_business_location_location_type = 'Not Headquarters';
                $this->loyalty_business_location_participating_type = 'Participating';
            }
        }
    }
    
    public function UpdatedPhysicalLocation(){
        $physical_location = $this->physical_location;
        $added_number = $this->frist_location + 1;
        $this->added_physical_location = $added_number.' of '.$physical_location.' location';
        $this->edit_physical_address = $this->physical_location;
        $this->edit_added_location = $this->added_physical_location;
    }

    public function deal_participating_location(){
        // dd('sdcsdcds');
        $input =  $this->validate(
            [
                'business_location_name' => 'required',
                'business_location_phone' => 'required',
                'business_location_street' => 'required',
                'business_location_zip' => 'required|max:6|min:5',
                'business_location_city' => 'required',
                'business_location_state' => 'required',
            ],
            [
                'business_location_name.required' => 'The Business Name field is required.',
                'business_location_phone.required' => 'The Business Phone field is required.',
                'business_location_street.required' => 'The Business Street field is required.',
                'business_location_city.required' => 'The Business City field is required.',
                'business_location_state.required' => 'The Business State field is required.',
                'business_location_zip.required' => 'The Preferred Phone must be at least 6 characters',
                'business_location_zip.max' => 'The Zip Code may not be greater than 6 characters',
                'business_location_zip.min' => 'The Zip Code may not be less than 5 characters',
            ]
        );
        if(!empty($this->business_location_name)){
            $this->perticipating_location_array['business_location_name'] = $this->business_location_name;
        }
        if(!empty($this->business_location_phone)){
            $this->perticipating_location_array['business_location_phone'] = $this->business_location_phone;
        }
        if(!empty($this->business_location_street)){
            $this->perticipating_location_array['business_location_street'] = $this->business_location_street;
        }
        if(!empty($this->business_location_zip)){
            $this->perticipating_location_array['business_location_zip'] = $this->business_location_zip;
        }
        if(!empty($this->business_location_city)){
            $this->perticipating_location_array['business_location_city'] = $this->business_location_city;
        }
        if(!empty($this->business_location_state)){
            $this->perticipating_location_array['business_location_state'] = $this->business_location_state;
        }
        
        $this->loyalty_business_location = new BusinessLocation;
        $this->loyalty_business_location->business_profile_id =  $this->business_id;
        $this->loyalty_business_location->location_name =  $this->business_location_name;
        $this->loyalty_business_location->address =  $this->business_location_street;
        $this->loyalty_business_location->city =  $this->business_location_city;
        $this->loyalty_business_location->state_id = $this->business_location_state;

        $this->loyalty_business_location->business_phone = $this->business_location_phone;
        $this->loyalty_business_location->business_email = $this->business_location_email;
        $this->loyalty_business_location->business_fax_number = $this->business_location_fax;

        $state_name = State::where('id',$this->business_location_state)->first();
        $this->business_location_state_name = $state_name->name;
        $this->loyalty_business_location->state =  $state_name->name;
        $this->loyalty_business_location->zip_code =  $this->business_location_zip;
        $this->loyalty_business_location->location_type = 'Not Headquarters';
        $this->loyalty_business_location->participating_type = 'Participating';
        $this->loyalty_business_location->save();
        $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->street_address,0,3)).'/0'.$this->loyalty_business_location->id;
        $this->loyalty_business_location->locationId = $locationId; 
        if($this->location_latitude){$latitude = $this->location_latitude;}else{$latitude =null;}
        if($this->location_longitude){$longitude = $this->location_longitude;}else{$longitude =null;}
        $this->loyalty_business_location->latitude = $latitude;
        $this->loyalty_business_location->longitude = $longitude;
        $this->loyalty_business_location->save();


        // dd($this->perticipating_location_array);
        $this->get_all_location = BusinessLocation::where('business_profile_id',$this->business_id)->where('participating_type','=','Participating')->get();
        $this->emit('participatingLocationClosePopup');
    }

    public function participating_location_add()
    {
        $this->emit('participatingLocationEditClosePopup');
    }

    public function EditLocation(){
        $get_all_location = BusinessLocation::where('business_profile_id',$this->business_id)->where('participating_type','=','Participating')->first();
        $this->lctn_id = $get_all_location->id;
        $this->edit_business_location_name =  $get_all_location->location_name;
        $this->edit_business_location_phone =  $get_all_location->business_phone; 
        $this->edit_business_location_fax =  $get_all_location->business_fax_number;
        $this->edit_business_location_email =  $get_all_location->business_email;
        $this->edit_business_location_street =  $get_all_location->address;
        $this->edit_business_location_zip =  $get_all_location->zip_code;
        $this->edit_business_location_city =  $get_all_location->city;
        $this->edit_business_location_state =  $get_all_location->state_id;
        $this->edit_location_latitude =  $get_all_location->latitude;
        $this->edit_location_longitude =  $get_all_location->longitude;

        $this->emit('openeditModal');
    }

    public function save_participating_location(){
        // dd($this->lctn_id,$this->edit_business_location_name);
        $state_name = State::where('id',$this->edit_business_location_state)->first();

        $loc_update = BusinessLocation::where('id',$this->lctn_id)->update([
            'location_name'=>$this->edit_business_location_name ,
            'address' =>$this->edit_business_location_street,
            'city'=>$this->edit_business_location_city,
            'state'=>$state_name->name,
            'zip_code' => $this->edit_business_location_zip,
            'state_id' =>$this->edit_business_location_state,
            'business_phone'=>$this->edit_business_location_phone,
            'business_email'=>$this->edit_business_location_email,
            'business_fax_number'=>$this->edit_business_location_fax,
            'latitude'=>$this->edit_location_latitude,
            'longitude'=>$this->edit_location_longitude,
        ]);
        $this->emit('closeditModal');

    }

    public function deal_non_participating_location(){
        $this->emit('nonParticipatingLocationClosePopup');
    }

    public function deal_step2_submit(){
        // dd('sdvsd');
        $input =  $this->validate(
            [
                'physical_location' => 'required',
                'selected_option' => 'required',
            ],
            [
                'physical_location.required' => 'The field is required.',
                'selected_option.required' => 'The field is required.',
            ]
        );

        $find_business_loc = BusinessLocation::where('business_profile_id', $this->business_id)->where('participating_type','=','Participating')->get()->toArray();
        if(empty($find_business_loc)){
            if($this->selected_option == "for_no"){
                $this->emit('participatingLocationPopup');
            }else{
                if($this->street_address){
                    $this->loyalty_business_location = new BusinessLocation;
                    $this->loyalty_business_location->business_profile_id =  $this->business_id;
                    $this->loyalty_business_location->location_name =  $this->street_address;
                    $this->loyalty_business_location->address =  $this->street_address;
                    $this->loyalty_business_location->city =  $this->street_address;
                    $state_name = State::where('id',$this->state_id)->first();
                    $this->loyalty_business_location->state =  $state_name->name;
                    $this->loyalty_business_location->state_id = $this->state_id;
                    $this->loyalty_business_location->zip_code =  $this->zip_code;
                    $this->loyalty_business_location->location_type = 'Not Headquarters';
                    $this->loyalty_business_location->participating_type = 'Participating';
                    $this->loyalty_business_location->business_phone = $this->business_phone;
                    $this->loyalty_business_location->business_email = $this->business_email;
                    $this->loyalty_business_location->latitude = $this->listing_location_latitude;
                    $this->loyalty_business_location->longitude = $this->listing_location_longitude;
                    $this->loyalty_business_location->save();
                }else{
                    $this->loyalty_business_location = new BusinessLocation;
                    $this->loyalty_business_location->business_profile_id =  $this->business_id;
                    $this->loyalty_business_location->location_name =  $this->mailing_address;
                    $this->loyalty_business_location->address =  $this->mailing_address;
                    $this->loyalty_business_location->city =  $this->mailing_city;
                    $state_name = State::where('id',$this->mailing_state_id)->first();
                    $this->loyalty_business_location->state =  $state_name->name;
                    $this->loyalty_business_location->state_id = $this->mailing_state_id;
                    $this->loyalty_business_location->zip_code =  $this->mailing_zip_code;
                    $this->loyalty_business_location->location_type = 'Not Headquarters';
                    $this->loyalty_business_location->participating_type = 'Participating';
                    $this->loyalty_business_location->latitude = $this->mailing_listing_location_latitude;
                    $this->loyalty_business_location->longitude = $this->mailing_listing_location_longitude;
                    $this->loyalty_business_location->business_phone = $this->business_phone;
                    $this->loyalty_business_location->business_email = $this->business_email;
                    $this->loyalty_business_location->save();
                }

                    $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->street_address,0,3)).'/0'.$this->loyalty_business_location->id;
                    $this->loyalty_business_location->locationId = $locationId; 
                    $this->loyalty_business_location->save();
            }
        }else{
            $business_category_id = $this->businessProfileArray['business_category_id'];
            $this->categoryData = BusinessCategory::find($business_category_id);
            $text = str_replace('[Merchant Name]', $this->businessProfileArray['business_name'], $this->categoryData->terms_conditions);
            $text2 = strip_tags($text);
            $this->about_program =  str_replace('&nbsp;', '', $text2);
            $terms = TermsAndCondition::where('id',2)->first();
            $this->terms_condition =  $terms->description;        
            $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
            // dd($this->items);
            $this->item_select_display = true;
            $this->deal_step1 = false;
            $this->deal_step2 = false;
            $this->deal_step3 = true;
        }
    }

    public function cancelAddItem(){
        $this->loyalty_item_select_display = true;
        $this->item_select_display = true;
        $this->emit('add_item_cancel');
    }

    public function closeMessageModal(){
        // dd(123);
        $this->item_select_display = true;
        $this->loyalty_item_select_display = true;
        $this->emit('offmessagemodal');
    }

    public function openModalAddItam(){
        $this->item_service_name = "";
        $this->value_one = "";
        $this->value_two = "";
        $this->note = "";
        // $this->loyalty_item_select_display = false;
        // $this->loyalty_item_id;
        // $this->item_select_display = false;
        // $this->emit('openAddItemModal');
        $this->item_id = '';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false; // Hide the modal
    }

    public function addItemService(){

        //dd($this->participating_location_ids);
        // $this->emit('offselectitem');
        // dd('dcdcd');
        $this->validate(
            [
                'item_service_name' => ['required'],
                'value_one' => ['required','numeric'],
                'value_two' => ['nullable', 'numeric'],
                'note' => ['nullable'],
            ],
            [
                'item_service_name.required' => "The Item Name field is required",
                'value_one.required' => "The Amount field is required",
                'value_one.numeric' => "The Amount should be number",
                'value_two.numeric' => "The Amount should be number",
            ]
        );
        // $this->emit('offselectitem');
        $itemService = new ItemOrService;
        $itemService->item_name = $this->item_service_name;
        $itemService->business_category_id = $this->businessProfileArray['business_category_id'];
        if ($this->note != '') {
            $itemService->note = $this->note;
        }
        $itemService->merchant_id = $this->merchant_id;
        $itemService->added_by = $this->merchant_id;
        $itemService->save();
        if(($this->value_one != '') && ($this->value_two != '')){
            $value = $this->value_one.'.'.$this->value_two;
        }
        elseif(($this->value_one != '') && ($this->value_two == '')){
            $value = $this->value_one.'.00';
        }
        else{
            $value = '';
        }
        if ($value != '') {
            $itemvalue = new GiftItemValue;
            $itemvalue->item_id = $itemService->id;
            $itemvalue->price = $value;
            $itemvalue->merchant_id = $this->merchant_id;
            $itemvalue->save();
        }
        if(count($this->seleted_locations) > 0){
            foreach($this->seleted_locations as $locationid){
                $itemlocation = new ItemServiceLocation();
                $itemlocation->item_id = $itemService->id;
                $itemlocation->location_id = $locationid;
                $itemlocation->merchant_id = $this->merchant_id;
                $itemlocation->status = 1;
                $itemlocation->save();

            }
            
           }
        $business_category_id = $this->businessProfileArray['business_category_id'];
        $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();

        // $this->item_service_name = "";
        // $this->value_one = "";
        // $this->value_two = "";
        // $this->note = "";

        $this->showModal = false;
    }

    public function closeitemservicepopup(){
        $this->showModal = false;
    }
    
    public function updatedItemId(){
        if($this->item_id != ''){
            
            $this->item_select_display = true;
            $selected_item = ItemOrService::find($this->item_id);
            // dd($selected_item->item_price->price);
            if($selected_item->item_price){
                $this->item_price = '$'.number_format($selected_item->item_price);
            }
            else{
                $this->item_price = '$'.number_format($selected_item->item_value);
            }
            if($this->deal_discount != ''){
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$selected_item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$selected_item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = $this->discount_amount.'% OFF '.$selected_item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($item_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$selected_item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $dis_amount = substr($this->discount_amount, 1);
                                if($this->discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                }
                                $this->deal_description = 'BUY 1, AND GET 1 '. $selected_item->item_name .' '.$this->show_discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point= '';
                                $this->deal_description = '';
                            }
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $selected_item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point= '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->discount_amount = $this->discount_amount;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount ;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            // if(mb_substr($this->discount_amount,-1) == '%'){
                            //     mb_substr($this->discount_amount,-1);
                            // dd($this->discount_amount);
                            // }
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $this->discount_amount;
                            $this->deal_description = $this->deal_description ;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            // $this->discount_amount = $this->discount_amount.'%';
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_description = '';
                            $this->deal_point = '';
                        }
                        
                    }
                }
            }
            else{
                $this->discount_amount = '';
                $this->discount_type = 'amount ($)';               
            }
            
        }
        else{
            $this->item_price = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function updatedDealDiscount(){
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($item_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){

                                $char = substr($this->show_discount_amount,-1);
                                if($char == '%'){
                                 $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                 $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                                 $this->discount_amount = $this->discount_amount;
                                 $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                 $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                                }
                                else{
                                    $this->show_discount_amount = $this->show_discount_amount;
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                    $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }

                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->show_discount_amount, 1);
                                if($this->show_discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->show_discount_amount = $dis_amount.'%';
                                    $this->discount_amount = $dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                                $this->deal_description =  $this->discount_amount.'% OFF '.$item->item_name;

                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            // dd($this->discount_amount);
                         
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                // $this->show_discount_amount = 
                                $char = substr($this->show_discount_amount,-1);
                                if($char == '%'){
                                 $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                 $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                                 $this->discount_amount = $this->discount_amount;
                                 $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                 $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }
                                else{
                                    $this->show_discount_amount = $this->show_discount_amount;
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                    $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' '. $this->show_discount_amount.' OFF';
                                }
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->show_discount_amount, 1);
                                if($this->show_discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->show_discount_amount = $dis_amount.'%';
                                    $this->discount_amount = $dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                                
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->show_discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        // $this->show_discount_amount = $this->item_price;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);

                        $this->discount_type = 'amount ($)';
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount; 
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            // $this->disAmount = $dis_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $this->show_discount_amount = $this->show_discount_amount;
                            }
                            else{
                               $char = substr($this->show_discount_amount,-1);
                               if($char == '%'){
                                $this->show_discount_amount = str_replace('%', '', $this->show_discount_amount);
                                $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                               }                                
                                // dd($this->show_discount_amount);
                            }
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = ''; 
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->show_discount_amount = $this->show_discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $this->show_discount_amount = (int)$dis_amount.'%';
                            $this->discount_amount = (int)$dis_amount;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                    }
                }
            }
            else{
                    $this->discount_amount = '';
                    $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function updatedIsBogo(){
        
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $dis_amount = substr($this->discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $dis_amount = substr($this->show_discount_amount, 1);
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                $this->deal_description = '$'.$dis_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $dis_amount = substr($this->discount_amount, 1);
                            $dis_amount = str_replace(',', '', $dis_amount);
                            $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                // $dis_amount = substr($this->discount_amount, 1);
                                // $dis_amount = str_replace(',', '', $dis_amount);
                                // $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $dis_amount = substr($this->discount_amount, 1);
                        $dis_amount = str_replace(',', '', $dis_amount);
                        $dis_amount = (float)$dis_amount;
                        $this->deal_point = intval(ceil($item_amount/0.25));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil($this->discount_amount/0.25));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                }
            }
            else{
                    $this->discount_amount = '';
                    $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
        
    }

    public function updatedDiscountAmount(){
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = ceil(($item_amount/0.25));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                // $dis_amount = substr($this->discount_amount, 1);
                                // $dis_amount = str_replace(',', '', $dis_amount);
                                // $dis_amount = (float)$dis_amount;
                                $this->deal_point =intval(ceil($this->discount_amount/0.25));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $dis_amount = substr($this->discount_amount, 1);
                                if($this->discount_amount[0] == '$'){
                                    $dis_amount = str_replace(',', '', $dis_amount);
                                    $dis_amount = (int)$dis_amount;
                                    $this->deal_point = intval(ceil(((($dis_amount/100)*$item_amount)/0.25)));
                                }
                                else{
                                    $this->discount_amount = $this->discount_amount;
                                    $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                }
                              
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->deal_point = ceil(($item_amount/0.25));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = ceil(($this->discount_amount/0.25));
                                $this->show_discount_amount = $this->show_discount_amount;
                                // dd($this->show_discount_amount);
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = ceil(($item_amount/0.25));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point =intval(ceil($this->discount_amount/0.25));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $this->discount_amount = (int)$dis_amount;
                                $this->show_discount_amount = (int)$dis_amount.'%';
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            else{
                                // dd($this->discount_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    else{
                        $this->discount_amount = $this->discount_amount;
                        $this->deal_point = '';
                    }
                }
            }
            else{
                if($this->discount_amount != ''){
                    $this->discount_amount =  $this->discount_amount;
                }
                else{
                    $this->discount_amount = '';
                }
                    
                $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function updatedItemPrice(){
        // dd($this->item_price);
        if($this->item_id){
            $item = ItemOrService::find($this->item_id);
            if($this->deal_discount != ''){
                // $this->discount_amount = $this->item_price;
                $item_price = substr($this->item_price, 1);
                if($this->item_price[0] == '$'){
                    $item_price = substr($this->item_price, 1);
                }
                else{
                    $item_price = $this->item_price;
                    $this->item_price = '$'.number_format($this->item_price,2);
                }
                if($this->is_bogo != ''){
                    if($this->is_bogo == 'no'){
                        
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                            $this->deal_description = 'Free '.$item->item_name;
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $dis_amount = substr($this->discount_amount, 1);
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $dis_amount = (float)$dis_amount;
                                $this->deal_point = intval(ceil(($dis_amount/0.25)));
                                $this->deal_description = '$'.$this->discount_amount.' OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));                            
                                $this->deal_description = $this->discount_amount.'% OFF '.$item->item_name;
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                        }
                    }
                    else{
                        if($this->deal_discount == 'Free'){
                            $this->discount_type = 'amount ($)';
                            $item_amount = substr($this->item_price, 1);
                            $item_amount = str_replace(',', '', $item_amount);
                            $this->discount_amount = $item_amount;
                            $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                            $this->deal_point = intval(ceil(($item_amount/0.25)));
                            $this->deal_description = 'BUY 1, AND GET 1 ' .$item->item_name. ' FREE';
                        }
    
                        elseif($this->deal_discount == 'Dollar'){
                            $this->discount_type = 'amount ($)';
                            if($this->discount_amount != ''){
                                
                                $this->discount_amount = $this->discount_amount;
                                $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                                $this->show_discount_amount = $this->show_discount_amount;
                                // dd($this->show_discount_amount);
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name .' $'.$this->discount_amount.' OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
    
                        elseif($this->deal_discount == 'Percentage'){
                            $this->discount_type = 'percentage (%)';
                            if($this->discount_amount != ''){
                                $this->discount_amount = $this->discount_amount;
                                $item_amount = substr($this->item_price, 1);
                                $item_amount = str_replace(',', '', $item_amount);
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                                $this->deal_description = 'BUY 1, AND GET 1 '. $item->item_name. ' '.$this->discount_amount.'% OFF';
                            }
                            else{
                                $this->discount_amount = '';
                                $this->deal_point = '';
                                $this->deal_description = '';
                            }
                            
                        }
                    }
                }
                else{
                    if($this->deal_discount == 'Free'){
                        $this->discount_type = 'amount ($)';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        $this->discount_amount = $item_amount;
                        $this->show_discount_amount = '$'.number_format($this->discount_amount,2);
                        $this->deal_point = intval(ceil(($item_amount/0.25)));
                        $this->deal_description = '';
                    }
                    elseif($this->deal_discount == 'Dollar'){
                        $this->discount_type = 'amount ($)';
                        $this->deal_description = '';
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            // $dis_amount = substr($this->discount_amount, 1);
                            // $dis_amount = str_replace(',', '', $dis_amount);
                            // $dis_amount = (float)$dis_amount;
                            $this->deal_point = intval(ceil(($this->discount_amount/0.25)));
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    elseif($this->deal_discount == 'Percentage'){
                        $this->discount_type = 'percentage (%)';
                        $this->deal_description = '';
                        $item_amount = substr($this->item_price, 1);
                        $item_amount = str_replace(',', '', $item_amount);
                        if($this->discount_amount != ''){
                            $this->discount_amount = $this->discount_amount;
                            $dis_amount = substr($this->show_discount_amount, 1);
                            if($this->show_discount_amount[0] == '$'){
                                $dis_amount = str_replace(',', '', $dis_amount);
                                $this->discount_amount = (int)$dis_amount;
                                $this->show_discount_amount = (int)$dis_amount.'%';
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            else{
                                // dd($this->discount_amount);
                                $this->discount_amount = $this->discount_amount;
                                $this->show_discount_amount = $this->show_discount_amount;
                                $this->deal_point = intval(ceil(((($this->discount_amount/100)*$item_amount)/0.25)));
                            }
                            
                        }
                        else{
                            $this->discount_amount = '';
                            $this->deal_point = '';
                        }
                        
                    }
                    else{
                        $this->discount_amount = $this->discount_amount;
                        $this->deal_point = '';
                    }
                }
            }
            else{
                if($this->discount_amount != ''){
                    $this->discount_amount =  $this->discount_amount;
                }
                else{
                    $this->discount_amount = '';
                }
                    
                $this->discount_type = 'amount ($)';               
            }
        }
        else{
            $this->item_id = '';
            $this->discount_amount = '';
            $this->discount_type = 'amount ($)';    
            $this->deal_point = '';
            $this->deal_description = '';
        }
    }

    public function createDealDescription(){
       
        // dd($this->location_ids);
        $price = substr($this->item_price, 1);
        $price = str_replace(',', '', $price);

        $this->real_item_price = $price;
         $this->validate([
             'item_id' => 'required',
             'real_item_price' => 'required',
             'deal_discount' => 'required',
             'discount_amount' => 'required',
             'is_bogo' => 'required',
             'deal_description' => 'required',
          
         ], [
             'item_id.required' => 'Please select one item',
             'real_item_price.required' => 'Original Sales price field is required',
             'deal_discount.required' => 'Please select one Discount Type',
             'discount_amount.required' => 'Discount Amount field is required',
             'is_bogo.required' => 'Please select Bogo or not',
             'deal_description.required' => 'Description field is required',
         ]);
         $this->selected_item_id = $this->item_id;
         if($this->deal_discount == 'Percentage'){
 
             $this->validate([
                 'discount_amount' => 'lt:100',
                 
             ], [
                 'discount_amount.lt' => 'Discount Amount not be greater than 99%',
             ]);
             
         }
         else if($this->deal_discount == 'Dollar'){
 
             $this->validate([
                 'discount_amount' => 'lt:real_item_price',
             ], [
                 'discount_amount.lt' => 'Discount amount must be less than the original sales amount. To apply a  full discount on the item, select Free as the discount type',
             ]);
             
         }
         else{
             $this->validate([
                 'discount_amount' => 'numeric',
             ], [
                 'discount_amount.lt' => 'Discount amount should be a number',
             ]);
         }
        //  dd('sdcsd11111ddd');

         $this->deal_step3 = false;
         $this->deal_step4 = true;
    }

    public function addVoucher(){
        if($this->voucher_unlimited == false){
            $this->validate([
                'voucher_limit' => 'required|gt:14',
            ],
            [
                'voucher_limit.required' => 'Voucher Number field is required',
                'voucher_limit.min' => 'Voucher number must be greater than 14'
            ]);
        }
        $this->saveFinalDeal();
    }

    public function saveFinalDeal(){
        // dd($this->event_start_date);
       $this->newDealCreate = new Deal;
       //dd($this->merchant_id,$this->business_id,$this->start_date,$this->end_date,$this->deal_description,$this->item_price,  $this->deal_discount,$this->discount_amount,$this->deal_point,$this->voucher_limit,$this->is_bogo,$this->terms_condition,$this->about_program,$this->selected_item_id,$this->deal_image);
       $this->newDealCreate->merchant_id = $this->merchant_id;
       $this->newDealCreate->business_id = $this->business_id;
       $startdate = date_format(date_create($this->start_date),'Y-m-d');
       $this->newDealCreate->start_Date = $startdate;
       if($this->end_date){
        $enddate = date_format(date_create($this->end_date),'Y-m-d');
        $this->newDealCreate->end_Date = $enddate;
       }
       $this->newDealCreate->suggested_description = $this->deal_description;
       $amount = str_replace('$', '', $this->item_price);
       $formattedAmount = number_format($amount, 2, '.', '');
       $this->newDealCreate->sales_amount = $formattedAmount;
       $this->newDealCreate->discount_type = $this->deal_discount;
       $this->newDealCreate->discount_amount = $this->discount_amount;
       $this->newDealCreate->point = $this->deal_point;
       if($this->voucher_unlimited == true){
        $this->newDealCreate->voucher_unlimited = true;
       }
       else{
        $this->newDealCreate->voucher_number = $this->voucher_limit;
       }
       
       $this->newDealCreate->status = true;

       if($this->is_bogo == 'yes'){
            $this->newDealCreate->is_bogo = true;
       }
       else{
            $this->newDealCreate->is_bogo = false;
       }
       $this->newDealCreate->terms_conditions = $this->terms_condition;
       $this->newDealCreate->about = $this->about_program;
       $this->newDealCreate->item_id = $this->selected_item_id;
       $this->newDealCreate->is_complete = true;
       $this->newDealCreate->save();

        if($this->serving_area1_street == null && $this->serving_area2_street == null && $this->serving_area2_street == null){
           $this->DealLocationAdd = new DealLocation;
           $this->DealLocationAdd->deal_id = $this->newDealCreate->id;
           $this->DealLocationAdd->status = true;
           $this->DealLocationAdd->location_id = $this->loyalty_business_location->id;
           $this->DealLocationAdd->participating_type = 'Participating';
           $this->DealLocationAdd->save();
           
           $this->merchantLocationAdd = new MerchantLocation;
           $this->merchantLocationAdd->user_id = $this->merchant_id;
           $this->merchantLocationAdd->location_id = $this->loyalty_business_location->id;
           $this->merchantLocationAdd->is_main = 1;
           $this->merchantLocationAdd->save();
        } 

        if($this->main_deal_image_upload){
            $main_deal_photo = $this->newDealCreate->addMedia($this->main_deal_image_upload->getRealPath())
                ->usingName($this->main_deal_image_upload->getClientOriginalName())
                ->toMediaCollection('dealPhotos');
            $this->newDealCreate->main_image = '/storage/'.$main_deal_photo->id.'/'.$main_deal_photo->file_name;
            $this->newDealCreate->save();
        }else{
            if($this->deal_image){
                $main_deal_photo = $this->newDealCreate->addMedia($this->deal_image->getRealPath())
                    ->usingName($this->deal_image->getClientOriginalName())
                    ->toMediaCollection('dealPhotos');
                $this->newDealCreate->main_image = '/storage/'.$main_deal_photo->id.'/'.$main_deal_photo->file_name;
                $this->newDealCreate->save();
            }
        }

        if($this->serving_area1_street != null){
            $this->create_serving1_deal_location = BusinessLocation::create($this->serving_area1_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area1_street,0,3)).'/0'.$this->create_serving1_deal_location->id;
            $this->create_serving1_deal_location->locationId = $locationId; 
            $this->create_serving1_deal_location->save();

            $this->DealLocationAdd = new DealLocation;
            $this->DealLocationAdd->deal_id = $this->newDealCreate->id;
            $this->DealLocationAdd->status = true;
            $this->DealLocationAdd->location_id = $this->create_serving1_deal_location->id;
            $this->DealLocationAdd->participating_type = 'Participating';
            $this->DealLocationAdd->save();
            
            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving1_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        if($this->serving_area2_street != null){
            $this->create_serving2_deal_location = BusinessLocation::create($this->serving_area2_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area2_street,0,3)).'/0'.$this->create_serving2_deal_location->id;
            $this->create_serving2_deal_location->locationId = $locationId; 
            $this->create_serving2_deal_location-> save();

            $this->DealLocationAdd = new DealLocation;
            $this->DealLocationAdd->deal_id = $this->newDealCreate->id;
            $this->DealLocationAdd->status = true;
            $this->DealLocationAdd->location_id = $this->create_serving2_deal_location->id;
            $this->DealLocationAdd->participating_type = 'Participating';
            $this->DealLocationAdd->save();
            
            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving2_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        if($this->serving_area3_street != null){
            $this->create_serving3_deal_location = BusinessLocation::create($this->serving_area2_array);
            $locationId =strtoupper(substr($this->businessProfileArray['business_name'],0,3)).'/'.strtoupper(substr($this->serving_area3_street,0,3)).'/0'.$this->create_serving3_deal_location->id;
            $this->create_serving3_deal_location->locationId = $locationId; 
            $this->create_serving3_deal_location->save();

            $this->DealLocationAdd = new DealLocation;
            $this->DealLocationAdd->deal_id = $this->newDealCreate->id;
            $this->DealLocationAdd->status = true;
            $this->DealLocationAdd->location_id = $this->create_serving3_deal_location->id;
            $this->DealLocationAdd->participating_type = 'Participating';
            $this->DealLocationAdd->save();
            
            $this->merchantLocationAdd = new MerchantLocation;
            $this->merchantLocationAdd->user_id = $this->merchant_id;
            $this->merchantLocationAdd->location_id = $this->create_serving3_deal_location->id;
            $this->merchantLocationAdd->is_main = 1;
            $this->merchantLocationAdd->save();
        }
        
        if($this->event_name){
            $startFormattedDate = Carbon::createFromFormat('m/d/Y', $this->event_start_date)->format('Y-m-d');
            if($this->event_end_date){
                $endFormattedDate = Carbon::createFromFormat('m/d/Y', $this->event_end_date)->format('Y-m-d');
            }else{
                $endFormattedDate = null;
            }
            $this->save_deal_event = new Events;
            $this->save_deal_event->business_id = $this->business_id;
            $this->save_deal_event->deal_id = $this->newDealCreate->id;
            $this->save_deal_event->event_name = $this->event_name;
            $this->save_deal_event->is_event_advertise = $this->advertise_event;
            $this->save_deal_event->event_start_date = $startFormattedDate;
            $this->save_deal_event->event_end_date = $endFormattedDate;
            $this->save_deal_event->one_day_event = $this->one_day_event;
            $this->save_deal_event->event_street_address = $this->event_address;
            $this->save_deal_event->event_city = $this->event_city;
            $this->save_deal_event->event_state_id = $this->event_state;
            $this->save_deal_event->event_zip = $this->event_zip;
            $this->save_deal_event->event_lat = $this->event_latitude;
            $this->save_deal_event->event_long = $this->event_longitude;
            $this->save_deal_event->save();
        }

        $this->deal_step4 = false;
        $this->deal_step5 = true;
    }

    public function PreviewDeal(){
        $state_name = State::where('id',$this->business_location_state)->first();
        $this->payment_state_name = $state_name->name;
        $address = $this->business_location_name.', '.$this->business_location_city.', '.$state_name->name.', '.$this->business_location_zip;
        // dd($address);
        if($address){
            $this->deal_address = $address;
        }else{
            $this->deal_address = '';
        }

        $this->emit('enablepreviewdeal');
    }

    public function UpdatedMainDealImageUpload(){
        // dd($this->main_deal_image_upload);
        $this->validate([
            'main_deal_image_upload' => 'nullable|mimes:png,jpg|max:25600',
        ], [
            'main_deal_image_upload.mimes' => 'Image file should be  jpg and png type',
            'main_deal_image_upload.max' => 'Image file size may not be greater than 25 mb',
        ]);
    }

    public function goToUserEdit(){
        $this->user_name = $this->name;
        $this->user_email = $this->email;
        $this->user_phone = $this->phone;
        $this->deal_step5 = false;
        $this->step8 = true;
        $this->profile_complete_value=100;

    }

    public function removeReadonly($attribute){
        if($attribute == 'personal_info'){
            $this->info_readonly = '';
        }
    }

    public function submitUserPhone(){
        // if($this->business_location_state){
        //     $st_id = $this->business_location_state;
        // }else{
        //     $st_id = $this->mailing_state_id;
        // }
        
        $business_info = BusinessProfile::where('id',$this->business_id)->where('merchant_id',$this->merchant_id)->first();

        if($business_info->state_id){
            $st_id = $business_info->state_id;
        }else{
            $st_id = $this->mailing_state_id;
        }
        $state_name = State::where('id',$st_id)->first();

        if($business_info->street_address){
            $street_address = $business_info->street_address;
        }else{
            $street_address = $business_info->mailing_address;
        }
        if($business_info->city){
            $city = $business_info->city;
        }else{
            $city = $business_info->mailing_city;
        }
        if($business_info->zip_code){
            $zip = $business_info->zip_code;
        }else{
            $zip = $business_info->mailing_zipcode;
        }
        $this->payment_street = $street_address;
        $this->payment_state = $state_name->name;
        $this->payment_city = $city;
        $this->payment_zip = $zip;
        $this->payment_user_f_name = $this->f_name;
        $this->payment_user_l_name = $this->l_name;
        $this->payment_user_email = $this->email;
        // $this->card_number
        // $this->card_cvv
        // $this->card_expiry_date
        // $msgAction = "Phone number updated successfully";
        // $this->emit('popUp',['text' => $msgAction]);
        $this->profile_complete_value=100;
        $this->step8 = false;
        $this->emit('executeJS');
        // $this->emit('dealDatepicker');
        $this->pyamentPage = true;
        

    }

    public function goToCongrax(){
        $this->step8 = true;
        $this->pyamentPage = false;
    }

    public function savePhoneNumber(){
        if($this->user_phone){
            $get_user = User::where('id',$this->merchant_id)->first();
            if($get_user->phone != $this->user_phone){
                $user_edit = User::where('id',$this->merchant_id)->update([
                    'phone'=>$this->user_phone
                ]);
                $msgAction = "Profile updated successfully";
                $this->emit('popUp',['text' => $msgAction]);
            }
            
        }
        // dd($this->payment_state);

    }

    public function handleCreateCardToken($token){
        // dd('dddvdvd',$token);
        $input =  $this->validate(
            [
                'payment_street' => 'required',
                'payment_state' => 'required',
                'payment_zip' => 'required',
                'payment_user_f_name' => 'required',
                // 'payment_user_l_name' => 'required',
                'payment_user_email' => 'required|email',


            ],
            [
                'payment_street.required' => 'The Street field is required.',
                'payment_state.required' => 'The State field is required.',
                'payment_city.required' => 'The City field is required.',
                'payment_zip.required' => 'The Zip field is required.',
                'payment_user_f_name.required' => 'The First Name field is required.',
                'payment_user_l_name.required' => 'The Last Name field is required.',
                'payment_user_email.required' => 'The Email field is required.',
                'payment_user_email.email' => 'The Preferred Email must be a valid email address.', 
            ]
        );
        if($this->payment_country){
            $this->payment_country = $this->payment_country;
        }else{
            $this->payment_country = 'United States';
        }

        if($this->business_location_state){
            $st_id = $this->business_location_state;
        }else{
            $st_id = $this->mailing_state_id;
        }
        $state_name = State::where('id',$st_id)->first();
        $update_payment_busines_profile = BusinessProfile::where('id',$this->business_id)->update([
            'payment_street' =>$this->payment_street,
            'payment_country' =>$this->payment_country,
            'payment_city' =>$this->payment_city,
            'payment_state' =>$state_name->name,
            'payment_zip' =>$this->payment_zip,
            'payment_user_f_name' =>$this->payment_user_f_name,
            'payment_user_l_name' =>$this->payment_user_l_name,
            'payment_user_email' =>$this->payment_user_email,

        ]);

        $this->stripe_token = $token;
        // dd($token,$this->stripe_token);

        $this->addNewCard();
    }

    public function addNewCard()
    {
        try {

            $user = User::where('id', $this->merchant_id)->first();

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $cust = $stripe->customers->create([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $save_customer_id = User::where('id', $this->merchant_id)->update([
                'stripe_customer_id'=>$cust->id
            ]);

            $cust_up = $stripe->customers->update($cust->id, [
                'source' => $this->stripe_token,
            ]);

            $customer = $stripe->customers->retrieve($cust->id);
                if ($customer->default_source) {
                    // $msgAction = 'Payment source attached successfully!';
                    // $this->emit('popUp',['text' => $msgAction]);
                }

            
            $subscription = $stripe->subscriptions->create([
                'customer' => $cust->id,
                'items' => [
                    ['price' => 'price_1QRq84KSRycFM4otGw4YIZXd'], // Replace with your Stripe Price ID
                ],
                'expand' => ['latest_invoice.payment_intent'], // Useful for immediate payment status
            ]);
            // dd($subscription,$subscription->current_period_end);
            // dd($this->merchant_id,$subscription->id,$subscription->customer,$subscription->status);

            $subscriptionData = [
                'user_id' => $this->merchant_id,
                'sub_id' => $subscription->id, 
                'customer_id' => $cust->id,
                'stripe_price_id' => 'price_1QRq84KSRycFM4otGw4YIZXd',
                'status' => $subscription->status,
                'current_period_start' => now(),
                'current_period_end' => $subscription->current_period_end ? Carbon::createFromTimestamp($subscription->current_period_end) : null,
            ];
            Subscription::create($subscriptionData);


            if ($subscription->status === 'active') {
                Log::debug("Subscription created and active!".print_r($subscription,true));
                $msgAction = 'Subscription created and active!';
                $this->emit('stripePopUp',['text' => $msgAction]);
            } elseif ($subscription->status === 'incomplete') {
                Log::info("Payment incomplete. Further action required");
                $paymentIntent = $subscription->latest_invoice->payment_intent;
                $msgAction = 'Payment incomplete. Further action required: ' . $paymentIntent->status;
                $this->emit('errorPopUp',['text' => $msgAction]);
            } else {
                Log::info("Payment else");
                $msgAction = 'Something wents wrong. please try again later.';
                $this->emit('errorPopUp',['text' => $msgAction]);
            }

        } catch (\Exception $e) {
            Log::error(" :: EXCEPTION Ocurred in card creation:: " . $e->getMessage() . "\n" . $e->getTraceAsString());
            // return back()->with('error', $e->getMessage() . 'Server error');
            $msgAction = $e->getMessage();
                $this->emit('errorPopUp',['text' => $msgAction]);
        }
    }

    public function goToPayment(){
        $this->step9 = false;
        
    }

    public function stripe_new_popup_close(){
        $get_user_pass= User::where('id',$this->merchant_id)->first();

        if (FacadesHash::check($this->new_password, $get_user_pass->password)) {
            if (Auth::attempt(['email' => $this->email, 'password' => $this->new_password])) {
                $user = User::where(["email" => $this->email])->first();
                
                Auth::login($user);
                return redirect()->route('frontend.business_owner.account')->with('success', 'Login Successfully');
            }
        } else {
            return redirect()->route('frontend.business_owner.index')->with('merchant_error', 'Incorrect password');
        }
    }

    public function stripe_error_popup_close(){
        $this->emit('executeJS');
    }

    public function previousstep(){

        $this->deal_event_step = false;
        $this->deal_step2 = false;
        $this->deal_step3 = false;
        $this->deal_step1 = true;
        
    }


    public function serving1setStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        $this->serving_area1_street = $get_street;
        $this->emit('enableeventdatepicker');

    }

    public function serving1setCity($value)
    {
        $this->serving_area1_city = $value;
    }

    public function serving1setState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->serving_area1_state = $get_state_value->id;
        }else{
            $this->serving_area1_state = $value;
        }
        
    }

    public function serving1setZipCode($value)
    {
        $this->serving_area1_zip = $value;
    }

    public function serving1setLatLng($data){
        $this->serving_area1_latitude = $data['lat'];
        $this->serving_area1_longitude = $data['lng'];
    }

    public function serving2setStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        $this->serving_area2_street = $get_street;
        $this->emit('enableeventdatepicker');

    }

    public function serving2setCity($value)
    {
        $this->serving_area2_city = $value;
    }

    public function serving2setState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->serving_area2_state = $get_state_value->id;
        }else{
            $this->serving_area2_state = $value;
        }
        
    }

    public function serving2setZipCode($value)
    {
        $this->serving_area2_zip = $value;
    }

    public function serving2setLatLng($data){
        $this->serving_area2_latitude = $data['lat'];
        $this->serving_area2_longitude = $data['lng'];
    }

    public function serving3setStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        $this->serving_area3_street = $get_street;
        $this->emit('enableeventdatepicker');

    }

    public function serving3setCity($value)
    {
        $this->serving_area3_city = $value;
    }

    public function serving3setState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->serving_area3_state = $get_state_value->id;
        }else{
            $this->serving_area3_state = $value;
        }
        
    }

    public function serving3setZipCode($value)
    {
        $this->serving_area3_zip = $value;
    }

    public function serving3setLatLng($data){
        $this->serving_area3_latitude = $data['lat'];
        $this->serving_area3_longitude = $data['lng'];
    }

    public function eventsetStreetAddress($value)
    {
        $get_street = explode(',', $value)[0];
        $this->event_address = $get_street;
        $this->emit('enableeventdatepicker');

    }

    public function eventsetCity($value)
    {
        $this->event_city = $value;
    }

    public function eventsetState($value)
    {
        $get_state_value = State::where('code',$value)->first();
        if($get_state_value){
            $this->event_state = $get_state_value->id;
        }else{
            $this->event_state = $value;
        }
        
    }

    public function eventsetZipCode($value)
    {
        $this->event_zip = $value;
    }

    public function eventsetLatLng($data){
        $this->event_latitude = $data['lat'];
        $this->event_longitude = $data['lng'];
    }
    
    public function deal_event_step_submit(){
        $input = $this->validate([
            // Validation for serving_area1
            'serving_area1_street' => 'required_without_all:serving_area2_street,serving_area3_street',
            'serving_area1_city' => 'nullable|required_with:serving_area1_street',
            'serving_area1_state' => 'nullable|required_with:serving_area1_street',
            'serving_area1_latitude' => 'nullable|required_with:serving_area1_street',
            // Validation for serving_area2
            'serving_area2_street' => 'required_without_all:serving_area1_street,serving_area3_street',
            'serving_area2_city' => 'nullable|required_with:serving_area2_street',
            'serving_area2_state' => 'nullable|required_with:serving_area2_street',
            'serving_area2_latitude' => 'nullable|required_with:serving_area2_street',
            // Validation for serving_area3
            'serving_area3_street' => 'required_without_all:serving_area1_street,serving_area2_street',
            'serving_area3_city' => 'nullable|required_with:serving_area3_street',
            'serving_area3_state' => 'nullable|required_with:serving_area3_street',
            'serving_area3_latitude' => 'nullable|required_with:serving_area3_street',
        ], [
            'serving_area1_street.required_without_all' => 'At least one serving area is required.',
            'serving_area2_street.required_without_all' => 'At least one serving area is required.',
            'serving_area3_street.required_without_all' => 'At least one serving area is required.',       
            'serving_area1_city.required_with' => 'City is required when Street is filled for Serving Area 1.',
            'serving_area1_state.required_with' => 'State is required when Street is filled for Serving Area 1.',
            'serving_area1_latitude.required_with' => 'Pleace select address from Google Autocomplete.',        
            'serving_area2_city.required_with' => 'City is required when Street is filled for Serving Area 2.',
            'serving_area2_state.required_with' => 'State is required when Street is filled for Serving Area 2.',
            'serving_area2_latitude.required_with' => 'Pleace select address from Google Autocomplete.',       
            'serving_area3_city.required_with' => 'City is required when Street is filled for Serving Area 3.',
            'serving_area3_state.required_with' => 'State is required when Street is filled for Serving Area 3.',
            'serving_area3_latitude.required_with' => 'Pleace select address from Google Autocomplete.',        
        ]);
        if($this->one_day_event == 0){
            $input = $this->validate([
                'event_name' => 'nullable',
                'event_start_date' => 'required_with:event_name',
                'event_end_date' => 'required_with:event_name',
                'one_day_event' => 'nullable|boolean',
                'event_address' => 'required_with:event_name',
                'event_city' => 'required_with:event_name',
                'event_state' => 'required_with:event_name',
                'event_zip' => 'required_with:event_name',
                'event_latitude' => 'required_with:event_name',
            ],[
                'event_start_date.required_with' => 'Event start date is required when the event is provided.',
                'event_end_date.required_with' => 'Event end date is required when the event is provided.',
                'event_end_date.required_if' => 'Event end date is required unless it is a one-day event.',

                'event_address.required_with' => 'Event Address is required unless it is a one-day event.',
                'event_state.required_with' => 'Event State is required unless it is a one-day event.',
                'event_zip.required_with' => 'Event Zip code is required unless it is a one-day event.',
                'event_latitude.required_with' => 'Pleace select address from Google Autocomplete.',
            ]);
        }else{
            $input = $this->validate([
                'event_name' => 'nullable',
                'event_start_date' => 'required_with:event_name',
                'one_day_event' => 'nullable|boolean',
                'event_address' => 'required_with:event_name',
                'event_city' => 'required_with:event_name',
                'event_state' => 'required_with:event_name',
                'event_zip' => 'required_with:event_name',
                'event_latitude' => 'required_with:event_name',
            ],[
                'event_start_date.required_with' => 'Event start date is required when the event is provided.',
                'event_end_date.required_with' => 'Event end date is required when the event is provided.',
                'event_end_date.required_if' => 'Event end date is required unless it is a one-day event.',

                'event_address.required_with' => 'Event Address is required unless it is a one-day event.',
                'event_state.required_with' => 'Event State is required unless it is a one-day event.',
                'event_zip.required_with' => 'Event Zip code is required unless it is a one-day event.',
                'event_latitude.required_with' => 'Pleace select address from Google Autocomplete.',
            ]);
        }

        if($this->serving_area1_state){
            $serving1state = State::where('id',$this->serving_area1_state)->first();
            $serving1statename = $serving1state->name;
        }else{
            $serving1statename = null;
        }
        $this->serving_area1_array = array(
            'business_profile_id' =>$this->business_id,
            'location_name' => $this->serving_area1_street,
            'address' => $this->serving_area1_street,
            'city' => $this->serving_area1_city,
            'state' => $serving1statename,
            'zip_code' => $this->serving_area1_zip,
            'location_type' => 'Not Headquarters',
            'state_id' => $this->serving_area1_state,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_fax_number' => $this->faxnumber,
            'participating_type' => 'Participating',
            'latitude' => $this->serving_area1_latitude,
            'longitude' =>$this->serving_area1_longitude,
        );

        if($this->serving_area2_state){
            $serving2state = State::where('id',$this->serving_area2_state)->first();
            $serving2statename = $serving2state->name;
        }else{
            $serving2statename = null;
        }
        $this->serving_area2_array = array(
            'business_profile_id' =>$this->business_id,
            'location_name' => $this->serving_area2_street,
            'address' => $this->serving_area2_street,
            'city' => $this->serving_area2_city,
            'state' => $serving2statename,
            'zip_code' => $this->serving_area2_zip,
            'location_type' => 'Not Headquarters',
            'state_id' => $this->serving_area2_state,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_fax_number' => $this->faxnumber,
            'participating_type' => 'Participating',
            'latitude' => $this->serving_area2_latitude,
            'longitude' =>$this->serving_area2_longitude,
        );

        if($this->serving_area3_state){
            $serving3state = State::where('id',$this->serving_area3_state)->first();
            $serving3statename = $serving3state->name;
        }else{
            $serving3statename = null;
        }
        $this->serving_area3_array = array(
            'business_profile_id' =>$this->business_id,
            'location_name' => $this->serving_area3_street,
            'address' => $this->serving_area3_street,
            'city' => $this->serving_area3_city,
            'state' => $serving3statename,
            'zip_code' => $this->serving_area3_zip,
            'location_type' => 'Not Headquarters',
            'state_id' => $this->serving_area3_state,
            'business_email' => $this->business_email,
            'business_phone' => $this->business_phone,
            'business_fax_number' => $this->faxnumber,
            'participating_type' => 'Participating',
            'latitude' => $this->serving_area3_latitude,
            'longitude' =>$this->serving_area3_longitude,
        );


        if($this->is_loyalty == false){
            $business_category_id = $this->businessProfileArray['business_category_id'];
            $this->categoryData = BusinessCategory::find($business_category_id);
            $text = str_replace('[Merchant Name]', $this->businessProfileArray['business_name'], $this->categoryData->terms_conditions);
            $text2 = strip_tags($text);
            $this->about_program =  str_replace('&nbsp;', '', $text2);
            $terms = TermsAndCondition::where('id',2)->first();
            $this->terms_condition =  $terms->description;        
            $this->items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
            if($this->event_name){
                if($this->advertise_event == true){
                    $this->deal_step1 = false;
                    $this->deal_event_step = false;
                    $this->deal_step2 = false;
                    $this->deal_step3 = true;
                    $this->emit('offAdvertiseModel');
                }else{
                    if($this->click_no_advertise_event == true){
                        $this->deal_step1 = false;
                        $this->deal_event_step = false;
                        $this->deal_step2 = false;
                        $this->deal_step3 = true;
                        $this->emit('offAdvertiseModel');
                    }else{
                        $this->emit('OpenAdvertiseModel');
                    }
                }
            }else{
                $this->deal_step1 = false;
                $this->deal_event_step = false;
                $this->deal_step2 = false;
                $this->deal_step3 = true;
                $this->emit('offAdvertiseModel');
            }
        }else{
            if($this->serving_area1_street){
                $this->create_serving1_deal_location = BusinessLocation::firstOrCreate($this->serving_area1_array);
            }
            if($this->serving_area2_street){
                $this->create_serving2_deal_location = BusinessLocation::firstOrCreate($this->serving_area2_array);
            }
            if($this->serving_area3_street){
                $this->create_serving3_deal_location = BusinessLocation::firstOrCreate($this->serving_area3_array);
            }

            $this->locations = BusinessLocation::where('business_profile_id',$this->business_id)->where('status',1)->where('participating_type','Participating')->get();
            $this->emit('enableloyaltydatepicker');
            if($this->event_name){
                if($this->advertise_event == true){
                    $this->loyalty_step = false;
                    $this->loyalty_step1 = false;
                    $this->deal_event_step = false;
                    $this->loyalty_step2 = true;
                    $this->emit('offAdvertiseModel');
                }else{
                    if($this->click_no_advertise_event == true){
                        $this->loyalty_step = false;
                        $this->loyalty_step1 = false;
                        $this->deal_event_step = false;
                        $this->loyalty_step2 = true;
                        $this->emit('offAdvertiseModel');
                    }else{
                        $this->emit('OpenAdvertiseModel');
                    }
                }
            }else{
                $this->loyalty_step = false;
                    $this->loyalty_step1 = false;
                    $this->deal_event_step = false;
                    $this->loyalty_step2 = true;
                $this->emit('offAdvertiseModel');
            }
        }
    }

    public function YesAdvertiseModel(){
        $this->advertise_event = true;
        $this->emit('offAdvertiseModel');
    }

    public function NoAdvertiseModel(){
        $this->advertise_event = false;
        $this->click_no_advertise_event = true;
        $this->emit('offAdvertiseModel');

    }

    public function UpdatedAdvertiseEvent(){
        // dd('dddd');
        $this->emit('enableeventdatepicker');
    }


    public function render()
    {
        return view('livewire.frontend.merchant.business-registration');
    }
}
