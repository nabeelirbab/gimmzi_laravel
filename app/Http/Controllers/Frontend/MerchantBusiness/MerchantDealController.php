<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Models\Deal;
use App\Models\SuggestedDescription;
use Spatie\MediaLibrary\Models\Media;
use App\Models\MerchantLocation;
use App\Models\BusinessLocation;
use App\Models\BusinessProfile;
use App\Models\DealLocation;
use Illuminate\Support\Facades\Log;
use App\Models\ItemOrService;
use App\Models\State;
use Illuminate\Support\Facades\Auth;


class MerchantDealController extends Controller
{

    public function createDealStep1()
    {
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();

        if ($deal != '') {
            $photos = Media::where(['model_id' => $deal->id, 'collection_name' => 'dealPhotos'])->get();
            return view('frontend.merchant_owner.create-deal.step1', compact('deal', 'photos'));
        } else {
            return view('frontend.merchant_owner.create-deal.step1', ['deal' => NULL, 'photos' => NULL]);
        }
    }

    public function saveDealStep1(Request $request)
    {
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
                'start_on.after'=> 'The Start Date should not be before today',
                'end_on.after' => 'The End Date can not be less than 30 days from start date'
            ];
            $this->validate($request, $rules, $customMessages);
            $deal = new Deal;
            $deal->merchant_id = Auth::user()->id;
            $deal->business_id = Auth::user()->business_id;
            $deal->start_Date = $request->start_on;
            if ($request->end_on != '') {
                $deal->end_Date = $request->end_on;
            }
            $deal->save();
        } else {
            $today = date('Y-m-d');
            $afterdate = date('Y-m-d', strtotime('-1 days', strtotime($today)));
            $rules = [
                'start_on' => 'required|after:'.$afterdate,
                'end_on' => 'nullable|after:start_on +30 day'
            ];
            $customMessages = [
                'start_on.required' => 'The Start Date field is required',
                'start_on.after'=> 'The Start Date should not be before today',
                'end_on.after' => 'The End Date can not be less than 30 days from start date'
            ];
            $this->validate($request, $rules, $customMessages);
            $olddeal = Deal::find($request->id);
            if ($request->start_on != '')
                $olddeal->start_Date = $request->start_on;
            if ($request->end_on != '') {
                $olddeal->end_Date = $request->end_on;
            }
            $olddeal->save();
        }

        return redirect()->route('frontend.business_owner.createDeal.step2');
    }

    public function createDealStep2()
    {
        dd(1334);
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
        if ($deal) {
            $photos = Media::where(['model_id' => $deal->id, 'collection_name' => 'dealPhotos'])->get();

            // $maindealimage = Media::where(['model_id' => $deal->id, 'collection_name' => 'mainDealPhoto'])->first();
            $maindealimage = $deal->main_image;
        } else {
            $maindealimage = NULL;
        }
        if ($deal != '') {
            return view('frontend.merchant_owner.create-deal.step2', compact('deal', 'photos', 'maindealimage'));
        } else {
            return view('frontend.merchant_owner.create-deal.step2', ['deal' => NULL, 'photos', 'maindealimage']);
        }
    }

    public function saveDealStep2(Request $request)
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
            //dd($request->main_image_id);
            $merchant_id = Auth::user()->id;
            $olddeal =  Deal::where('merchant_id', $merchant_id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($request->TotalFiles > 0) {
                if ($request->hasFile('deal_image')) {
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
                    $merchant_id = Auth::user()->id;
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
        }
    }

    public function checkDealImage(Request $request)
    {
        if ($request->ajax()) {
            $merchant_id = Auth::user()->id;
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

    public function createDealStep3()
    {
        //dd( Auth::user()->merchantBusiness);
        $business_category_id = Auth::user()->merchantBusiness->business_category_id;
        $items = ItemOrService::where('status', 1)->where('business_category_id', $business_category_id)->orderBy('id', 'desc')->get();
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
        $photos = Media::where(['model_id' => $deal->id, 'collection_name' => 'dealPhotos'])->get();
        
        // dd($business_category_id);
        $categoryData = BusinessCategory::find($business_category_id);
        return view('frontend.merchant_owner.create-deal.step3', compact('items', 'deal', 'photos', 'categoryData'));
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


        $itemService = new ItemOrService;
        $itemService->item_name = $request->item_name;
        $itemService->item_value = $request->value;
        $itemService->business_category_id = Auth::user()->merchantBusiness->business_category_id;
        if ($request->note != '') {
            $itemService->note = $request->note;
        }
        $itemService->save();
        if ($itemService) {
            return response()->json(['success' => 1]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function getItem(Request $request)
    {
        if ($request->ajax()) {
            $item_id = $request->item_id;
            $item = ItemOrService::find($item_id);
            if ($item) {
                return response()->json(['success' => 1, 'data' => $item]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    public function saveDealStep3(Request $request)
    {

        //dd($request->item_id);
        $rules = [
            'item_id' => 'required',
            'description' => 'required',
            'original_price' => 'required|numeric',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'bogo_type' => 'required'
        ];
        $customMessages = [
            'item_id.required' => 'The Item or service field is required',
            'description.required' => 'The Description field is required',
            'original_price.required' => 'The Original Price field is required',
            'discount_type.required' => 'The Discount Type field is required',
            'discount_amount.required' => 'The Discount Amount field is required',
            'bogo_type.required' => 'The Bogo Type field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        if ($request->id) {
            $olddeal = Deal::find($request->id);
            if ($request->bogo_type != '') {
                if ($request->bogo_type == 'bogo_yes')
                    $olddeal->is_bogo = true;
                else
                    $olddeal->is_bogo = false;
            }

            if ($request->item_id != '') {
                $olddeal->item_id = $request->item_id;
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
            // dd($request->terms_conditions);
            $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
            if ($deal) {
                $deal->item_id = $request->item_id;
                if ($request->bogo_type == 'bogo_yes')
                    $deal->is_bogo = true;
                else
                    $deal->is_bogo = false;
                $deal->sales_amount = $request->original_price;
                $deal->discount_type = $request->discount_type;
                $deal->discount_amount = $request->discount_amount;
                $deal->point = $request->point;
                $deal->terms_conditions = $request->terms_conditions;
                $deal->save();
            }
        }
        return redirect()->route('frontend.business_owner.createDeal.step4');
    }

    public function createDealStep4()
    {
        $merchant_business = Auth::user()->merchantBusiness;
        $getBusinesslocation = BusinessLocation::where('business_profile_id', $merchant_business->id)->where('location_type', 'Headquarters')->first();
        $business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->get();
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
        $deallocation = DealLocation::with('location')->where('deal_id', $deal->id)->get();
        $photos = Media::where(['model_id' => $deal->id, 'collection_name' => 'dealPhotos'])->get();
        $stateList = State::all();

        $profile = BusinessProfile::find(Auth::user()->business_id);

        return view('frontend.merchant_owner.create-deal.step4', compact('deal', 'photos', 'profile', 'getBusinesslocation', 'stateList', 'deallocation', 'business_locations'));
    }



    public function yesDealRedeem(Request $request)
    {
        if ($request->ajax()) {

            // $location = BusinessLocation::find($request->location_id);
            $deallocation = DealLocation::where('deal_id', $request->deal_id)->first();
            $deal = Deal::find($request->deal_id);
            // return response()->json(["status" => $deal ]);
            if ($deallocation) {
                // $deallocation = new DealLocation();
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $request->location_id;
                $deallocation->participating_type = 'Participating';
                $deallocation->status = 1;
                $deallocation->save();
                $deal->available_location = 'this_location';
                $deal->save();
                $getdeallocation = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deallocation) {
                    return response()->json(["status" => 1, "data" => $getdeallocation]);
                } else {
                    return response()->json(["status" => 0]);
                }
            } else {
                $deallocation = new DealLocation();
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $request->location_id;
                $deallocation->participating_type = 'Participating';
                $deallocation->status = 1;
                $deallocation->save();
                $deal->available_location = 'this_location';
                $deal->save();
                $deal = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deallocation) {
                    return response()->json(["status" => 1, "data" => $deal]);
                } else {
                    return response()->json(["status" => 0]);
                }
            }
        }
    }

    public function noDealRedeem(Request $request)
    {
        if ($request->ajax()) {
            $location = BusinessLocation::find($request->location_id);
            if ($location) {
                return response()->json(["status" => 1, "data" => $location]);
            } else {
                return response()->json(["status" => 0]);
            }
        }
    }

    public function yesNonParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {
            // $deallocation = DealLocation::where('deal_id', $request->deal_id)->first();
            $deal = Deal::find($request->deal_id);
            // $location = BusinessLocation::find($request->location_id);

            if ($deal) {
                $deallocation = new DealLocation();
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $request->location_id;
                $deallocation->participating_type = 'Non-participating';
                $deallocation->status = 1;
                $deallocation->save();
                $deal->available_location = 'no_deal_location';
                $deal->save();
                $getdeallocation = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deallocation) {
                    return response()->json(["status" => 1, "data" => $getdeallocation]);
                } else {
                    return response()->json(["status" => 0]);
                }
            } else {
                return response()->json(["status" => 0]);
            }
        }
    }

    public function noNonParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {

            $location = BusinessLocation::find($request->location_id);
            $deallocation = DealLocation::where('deal_id', $request->deal_id)->first();
            $deal = Deal::find($request->deal_id);
            if ($deallocation) {
                // $deallocation = new DealLocation();
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $request->location_id;
                $deallocation->participating_type = 'Participating';
                $deallocation->status = 0;
                $deallocation->save();
                $deal->available_location = 'no_deal_location';
                $deal->save();
                $getdeallocation = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deallocation) {
                    return response()->json(["status" => 1, "data" => $getdeallocation]);
                } else {
                    return response()->json(["status" => 0]);
                }
            } else {
                $deallocation = new DealLocation();
                $deallocation->deal_id = $request->deal_id;
                $deallocation->location_id = $request->location_id;
                $deallocation->participating_type = 'Participating';
                $deallocation->status = 0;
                $deallocation->save();
                $deal->available_location = 'no_deal_location';
                $deal->save();
                $deal = DealLocation::with('location')->where('deal_id', $request->deal_id)->first();
                if ($deallocation) {
                    return response()->json(["status" => 1, "data" => $deal]);
                } else {
                    return response()->json(["status" => 0]);
                }
            }
        }
    }

    public function addMoreParticipatingLocation(Request $request)
    {
        if ($request->ajax()) {

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
                                        if ($request->check_location == 'yes_participate') {
                                            $locationdata = array(
                                                'business_profile_id' => Auth::user()->business_id,
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
                                            $merchant_location = new MerchantLocation;
                                            $merchant_location->user_id = Auth::user()->id;
                                            $merchant_location->location_id  = $location->id;
                                            $merchant_location->status = true;
                                            $merchant_location->is_main = false;
                                            $merchant_location->save();
                                            if ($location) {
                                                $business_locations = BusinessLocation::with('states')->where('business_profile_id', Auth::user()->business_id)->where('participating_type', 'Participating')->where('status', 1)->get();
                                                if (count($business_locations) < Auth::user()->merchantBusiness->number_of_location) {
                                                    $button = 'not_disabled';
                                                } else {
                                                    $button = 'disabled';
                                                }
                                                return response()->json(["status" => 10, "message" => 'Participating Location saved', 'data' => $business_locations, 'button' => $button]);
                                            } else {
                                                return response()->json(["status" => 11, "message" => 'Something Wrong']);
                                            }
                                        } else if($request->check_location == 'yes_non_participate'){
                                            $existNonparticipating = BusinessLocation::where('business_profile_id',Auth::user()->business_id)->where('participating_type', 'Non-participating')->where('status', 1)->first();
                                            if($existNonparticipating){
                                                return response()->json(["status" => 12, "message" => 'Already non-participating exists']);
                                            }else{
                                                $locationdata = array(
                                                    'business_profile_id' => Auth::user()->business_id,
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
                                                return response()->json(["status" => 13, "message" => 'Non-participating location saved','data' => $location]);
                                            }
                                        }else{

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
    public function saveDealStep4(Request $request)
    {
        $profile = BusinessProfile::find(Auth::user()->business_id);
        $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
        // $deallocation = DealLocation::where('deal_id',$deal->id)->count();
        // if($deallocation == 0){
        //     return redirect()->route('frontend.business_owner.createDeal.step4')->with('error','Please select at least one participating location');
        // }
        // else{
            
            if (($profile->business_type == 'Online Only') || ($profile->business_type == 'Mobile Business')) {

                if (($request->voucher_number == '') || ($request->voucher_unlimited == '')) {
                    $rules = [
                        'voucher_number' => 'required|gt:14',
                    ];
                    $customMessages = [
                        'voucher_number.required' => 'Please enter number of voucher or check the unlimited checkbox',
                        'voucher_number.gt' => 'Voucher number must be greater than 14'
                    ];
                } else {
                }
            } else {
    
                if ($request->voucher_number == '') {
                    if ($request->voucher_unlimited == '') {
                        $rules = [
    
                            'voucher_number' => 'required|gt:14',
                            'participating_location_ids' => 'required'
                        ];
                        $customMessages = [
    
                            'voucher_number.required' => 'Please enter number of voucher or check the unlimited checkbox',
                            'voucher_number.gt' => 'Voucher number must be greater than 14',
                            'participating_location_ids.*.required' => 'Please select participating location'
                        ];
                    } else {
                        $rules = [
                            'participating_location_ids' => 'required'
                        ];
                        $customMessages = [
                            'participating_location_ids.*.required' => 'Please select participating location'
                        ];
                    }
                } else {
                    $rules = [
                        'voucher_number' => 'gt:14',
                        'participating_location_ids' => 'required',
                    ];
                    $customMessages = [
                        'voucher_number.gt' => 'Voucher number must be greater than 14',
                        'participating_location_ids.*.required' => 'Please select participating location',
                    ];
                }
            }
    
            $this->validate($request, $rules, $customMessages);
            // if(count($request->participating_location_ids) > 0){
    
            // }
            if ($request->id) {
                $olddeal = Deal::find($request->id);
                if ($request->voucher_number != '') {
                    $olddeal->voucher_number = $request->voucher_number;
                }
                if ($request->voucher_unlimited == 'on') {
                    $olddeal->voucher_unlimited = true;
                }
                $olddeal->is_complete = true;
                $olddeal->save();
            } else {
                $deal = Deal::where('merchant_id', Auth::user()->id)->where('is_complete', 0)->orderBy('id', 'desc')->first();
                if ($deal) {
                    if ($request->voucher_number != '') {
                        $deal->voucher_number = $request->voucher_number;
                    }
                    if ($request->voucher_unlimited == 'on') {
                        $deal->voucher_unlimited = true;
                    }
                    $deal->is_complete = true;
                    $deal->save();
                    if (is_array($request->participating_location_ids)) {
                        for ($i = 0; $i < count($request->participating_location_ids); $i++) {
                            $deal_location = new DealLocation();
                            $deal_location->deal_id = $deal->id;
                            $deal_location->location_id = $request->participating_location_ids[$i];
                            $deal_location->participating_type = 'Participating';
                            $deal_location->status = 1;
                            $deal_location->save();
                        }
                    }
                    $deal_location_count = DealLocation::where('deal_id', $deal->id)->count();
                    if ($deal_location_count > 0) {
                        $total_location = $profile->number_of_location - $deal_location_count;
                        $profile->number_of_location = $total_location;
                        $profile->save();
                    }
                }
            }
    
            return redirect()->route('frontend.business_owner.createDeal.congratulation');
       // }
        
    }
    public function createDealCongratulation()
    {
        return view('frontend.merchant_owner.create-deal.congratulation');
    }
}
