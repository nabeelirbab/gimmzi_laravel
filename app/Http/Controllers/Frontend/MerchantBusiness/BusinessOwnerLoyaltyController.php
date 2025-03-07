<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\ConsumerLoyaltyReward;
use App\Models\GiftManage;
use App\Models\ItemOrService;
use App\Models\LoyaltyProgramItem;
use App\Models\MerchantLoyaltyProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GiftItemValue;
use App\Models\BusinessLocation;
use App\Models\LoyaltyRewardLocation;
use App\Models\MerchantLocation;
use Illuminate\Support\Facades\Validator;
use DateTime;


class BusinessOwnerLoyaltyController extends Controller
{

    public function loyaltyRewardProgram()
    {
        $today = date('Y-m-d');

        if (MerchantLoyaltyProgram::where('end_on', '<', $today)->where('business_profile_id', Auth::user()->business_id)->where('status', 1)->count() > 0) {
            $endprogram = MerchantLoyaltyProgram::where('end_on', '<', $today)->where('business_profile_id', Auth::user()->business_id)->where('status', 1)->get();
            foreach ($endprogram as $data) {
                $program = MerchantLoyaltyProgram::find($data->id);
                $program->status = false;
                $program->save();
            }
        }
        $loyalty = MerchantLoyaltyProgram::where('end_on', '>', $today)->where('business_profile_id', Auth::user()->business_id)->orWhere('end_on', '=', null)->where('status', 1)->get();
        $category_id = Auth::user()->merchantBusiness->business_category_id;
        $giftids = GiftManage::where('merchant_id', Auth::user()->id)->get()->pluck('item_id');
        // dd($giftids);
        $item = ItemOrService::where('business_category_id', $category_id)
            ->whereNotIn('id', $giftids)->whereIn('added_by', array(1, Auth::user()->id))->get();
        $gift = GiftManage::orderBy('id', 'desc')->where('merchant_id', Auth::user()->id)->where('status', 1)->get();
        $business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->get();
        $consumerLoyalty = ConsumerLoyaltyReward::where('status', 1)->get();

        $merchant_location = MerchantLocation::with('businessLocation.states', 'merchantUser')->where('user_id', Auth::user()->id)->get();

        return view('frontend.merchant_owner.loyalty-program.reward-program', compact('loyalty', 'item', 'consumerLoyalty', 'gift', 'business_locations', 'merchant_location'));
    }

    public function loyaltyRewardStore(Request $request)
    {
        // dd($request->no_end_date);

        if ($request->no_end_date != null) {
            $rules = [
                'purchase_goal' => 'required',
                'start_on' => 'required',
                'location_ids' => 'required|array',
                'location_ids.*' => 'required',

            ];
            $customMessages = [
                'purchase_goal.required' => 'Please select any Purchase Goal',
                'start_on.required' => 'The Start Date field is required',
                'location_ids.required' => 'The participating location field is required',
            ];
            if ($request->purchase_goal == "free") {
                $rules = [
                    'free_item' => 'required',
                    'have_to_buy' => 'required|numeric',
                    'start_on' => 'required',

                ];
                $customMessages = [
                    'free_item.required' => 'The Program Item field is required',
                    'have_to_buy.required' => 'The Number of Items field is required',
                    'have_to_buy.numeric' => 'The Number of Items must be number',
                    'start_on.required' => 'The Start Date field is required',

                ];
            } else {
                if ($request->purchase_goal == "deal_discount") {
                    $rules = [
                        'discount_item' => 'required',
                        'spend_amount' => 'required|numeric',
                        'discount_amount' => 'required|numeric',
                        'when_order' => 'required',
                        'start_on' => 'required',


                    ];
                    $customMessages = [
                        'discount_item.required' => 'The Program Item field is required',
                        'spend_amount.required' => 'The Dollar Amount field is required',
                        'spend_amount.numeric' => 'The Dollar Amount must be number',
                        'discount_amount.required' => 'The Discount Amount field is required',
                        'discount_amount.numeric' => 'The Discount Amount must be number',
                        'when_order.required' => 'Please select When Order',
                        'start_on.required' => 'The Start Date field is required',
                        'end_on.required' => 'The End Date field is required',

                    ];
                }
            }
        } else {
            $rules = [
                'purchase_goal' => 'required',
                'start_on' => 'required',
                'location_ids' => 'required',

            ];
            $customMessages = [
                'purchase_goal.required' => 'The Purchase Goal field is required',
                'start_on.required' => 'The Start Date field is required',
                'location_ids.required' => 'The participating location field is required',
            ];
            if ($request->purchase_goal == "free") {
                $rules = [
                    'free_item' => 'required',
                    'have_to_buy' => 'required|numeric',
                    'start_on' => 'required',
                    'end_on'  => 'required',

                ];
                $customMessages = [
                    'free_item.required' => 'The Program Item field is required',
                    'have_to_buy.required' => 'The Number of Items field is required',
                    'have_to_buy.numeric' => 'The Number of Items must be number',
                    'start_on.required' => 'The Start Date field is required',
                    'end_on.required' => 'The End Date field is required',
                ];
            } else {
                if ($request->purchase_goal == "deal_discount") {
                    $rules = [
                        'discount_item' => 'required',
                        'spend_amount' => 'required|numeric',
                        'discount_amount' => 'required|numeric',
                        'when_order' => 'required',
                        'start_on' => 'required',
                        'end_on'  => 'required',

                    ];
                    $customMessages = [
                        'discount_item.required' => 'The Program Item field is required',
                        'spend_amount.required' => 'The Dollar Amount field is required',
                        'spend_amount.numeric' => 'The Dollar Amount must be number',
                        'discount_amount.required' => 'The Discount Amount field is required',
                        'discount_amount.numeric' => 'The Discount Amount must be number',
                        'when_order.required' => 'Please select When Order',
                        'start_on.required' => 'The Start Date field is required',
                        'end_on.required' => 'The End Date field is required',

                    ];
                }
            }
        }


        $this->validate($request, $rules, $customMessages);

        $startdate = date_create($request->start_on);
        $startDate = date_format($startdate, 'Y-m-d');

        $loyaltyProgram = new MerchantLoyaltyProgram();
        $loyaltyProgram->merchant_id = Auth::user()->id;
        $loyaltyProgram->business_profile_id = Auth::user()->business_id;
        $loyaltyProgram->purchase_goal = $request->purchase_goal;
        $loyaltyProgram->start_on = $startDate;
        if ($request->end_on != '') {
            $enddate = date_create($request->end_on);
            $endDate = date_format($enddate, 'Y-m-d');
            $loyaltyProgram->end_on = $endDate;
        }
        $loyaltyProgram->have_to_buy = $request->have_to_buy;
        $loyaltyProgram->free_item_no = $request->free_item_get;
        $loyaltyProgram->spend_amount = $request->spend_amount;
        $loyaltyProgram->discount_amount = $request->discount_amount;
        $loyaltyProgram->when_order = $request->when_order;
        $loyaltyProgram->save();
        //number suffix
        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
        if ((($loyaltyProgram->free_item_no) % 100) >= 11 && (($loyaltyProgram->free_item_no) % 100) <= 13)
            $abbreviation = $loyaltyProgram->free_item_no . 'th';
        else
            $abbreviation = $loyaltyProgram->free_item_no . $ends[$loyaltyProgram->free_item_no % 10];

        $blnkArr = array();
        if (is_array($request->free_item)) {
            // dd(is_array($request->free_item));
            if (count($request->free_item) > 0) {
                for ($i = 0; $i < count($request->free_item); $i++) {
                    $item = new LoyaltyProgramItem();
                    $item->loyalty_program_id = $loyaltyProgram->id;
                    $item->item_id = $request->free_item[$i];
                    $item->save();
                    $itemNameList = ItemOrService::find($request->free_item[$i]);
                    $itemName =  $itemNameList->item_name;
                    array_push($blnkArr, $itemName);
                    // dd($itemName);
                }
            }
        } elseif (is_array($request->discount_item)) {
            if (count($request->discount_item) > 0) {
                for ($i = 0; $i < count($request->discount_item); $i++) {
                    $item = new LoyaltyProgramItem();
                    $item->loyalty_program_id = $loyaltyProgram->id;
                    $item->item_id = $request->discount_item[$i];
                    $item->save();
                    $itemNameList = ItemOrService::find($request->discount_item[$i]);
                    $itemName =  $itemNameList->item_name;
                    array_push($blnkArr, $itemName);
                }
            }
        }
        if (is_array($request->location_ids)) {
            for ($j = 0; $j < count($request->location_ids); $j++) {
                $reward_location = new LoyaltyRewardLocation;
                $reward_location->loyalty_program_id = $loyaltyProgram->id;
                $reward_location->location_id = $request->location_ids[$j];
                $reward_location->status = 1;
                if ($loyaltyProgram->end_on != null) {
                    $reward_location->end_date = $loyaltyProgram->end_on;
                }
                $reward_location->save();
            }
        }


        if ($request->purchase_goal == "free") {
            $progameName = "Purchase" . " " . $request->have_to_buy . " " . implode(",", $blnkArr) . " " . "And Get" . " " . $abbreviation . " " . "For Free";
            $loyaltyProgram->program_name = $progameName;
            $loyaltyProgram->save();
        }
        if ($request->purchase_goal == "deal_discount") {
            $progameName = "Purchase" . " " . $request->spend_amount . " " . "Or More Worth Of" . " " . implode(",", $blnkArr) . " " . "And Receive A" . " " . $request->discount_amount . " " . "Discount on" . " " . $request->when_order . " " . "Order";
            $loyaltyProgram->program_name = $progameName;
            $loyaltyProgram->save();
        }


        // $item = $request->free_item;
        // dd($item);
        // foreach (explode(',', $item) as $data) {
        //     if ($request->free_item != "") {
        //         $item = new LoyaltyProgramItem();
        //         $item->loyalty_program_id = $loyaltyProgram->id;
        //         $item->item_name = $data;
        //         $item->save();
        //     }
        // }
        // } elseif ($request->discount_item) {
        //     $items = $request->discount_item;
        //     // dd($items);
        //     foreach (explode(',', $items) as $data) {
        //         if ($request->discount_item != "") {
        //             $item = new LoyaltyProgramItem();
        //             $item->loyalty_program_id = $loyaltyProgram->id;
        //             $item->item_name = $data;
        //             $item->save();
        //         }
        //     }
        // }

        return redirect()->route('frontend.merchant_owner.loyalty.congratulation')->with('success', 'Merchant Loyalty Program successfully published.');
    }


    public function loyaltyEndProgram(Request $request)
    {
        if ($request->ajax()) {
            $endProgram = MerchantLoyaltyProgram::where('id',  $request->end_Id)->first();
            $today = date('Y-m-d');
            $endProgram->end_on = $today;
            $endProgram->save();
            //return redirect()->route('frontend.business_owner.loyal_reward_program')->withInput(['tab'=>'nav-profile-tab1']);
            return response()->json(['success' => 1, 'data' => $today]);
        } else {
            return response()->json(['success' => 0]);
        }
    }


    public function loyaltyRestartProgram(Request $request)
    {
        if ($request->ajax()) {
            $restartProgram = MerchantLoyaltyProgram::where('id',  $request->restart_Id)->first();
            $today = date('Y-m-d');
            $restartProgram->start_on = $today;
            if ($restartProgram->start_on == $today) {
                $restartProgram->end_on = NULL;
                $restartProgram->save();
            }
            $restartProgram->save();
            return response()->json(['success' => 1, 'data' => $today]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function createLoyaltyCongratulation()
    {
        $loyaltyProgram = MerchantLoyaltyProgram::orderBy('id', 'desc')->first();
        $today = Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        return view('frontend.merchant_owner.loyalty-program.congratulation', compact('loyaltyProgram', 'today', 'tomorrow'));
    }

    public function storeGift(Request $request)
    {
        if ($request->ajax()) {
            $giftManage = new GiftManage();
            if ($request->item_gift_id == 'add_new') {
                $giftManage->gift_name = $request->gift_item_name;
                $giftManage->business_category_id = Auth::user()->merchantBusiness->business_category_id;
                if ($request->note != '') {
                    $giftManage->note = $request->note;
                }
                $giftManage->merchant_id = Auth::user()->id;
                $giftManage->save();
                if ($request->value != '') {
                    $giftvalue = new GiftItemValue;
                    $giftvalue->gift_id = $giftManage->id;
                    $giftvalue->price = $request->value;
                    $giftvalue->merchant_id = Auth::user()->id;
                    $giftvalue->save();
                }
                $addItemGift = new ItemOrService();
                $addItemGift->item_name =  $giftManage->gift_name;
                $addItemGift->business_category_id = Auth::user()->merchantBusiness->business_category_id;
                if ($request->note != '') {
                    $addItemGift->note = $request->note;
                }
                $addItemGift->is_checked = 1;
                $addItemGift->added_by = Auth::user()->id;
                $addItemGift->merchant_id = Auth::user()->id;
                $addItemGift->save();
                if ($request->value != '') {
                    $itemvalue = new GiftItemValue;
                    $itemvalue->item_id = $addItemGift->id;
                    $itemvalue->price = $request->value;
                    $itemvalue->merchant_id = Auth::user()->id;
                    $itemvalue->save();
                }
                if ($addItemGift) {
                    $giftManage->item_id = $addItemGift->id;
                    $giftManage->save();
                }
            } else {
                $getItem = ItemOrService::find($request->item_gift_id);
                if ($getItem) {
                    $getItem->is_checked = 1;
                    $getItem->save();
                    $giftManage->gift_name = $getItem->item_name;
                    $giftManage->gift_value = $request->value;
                    $giftManage->item_id = $request->item_gift_id;
                    $giftManage->business_category_id = Auth::user()->merchantBusiness->business_category_id;
                    if ($request->note != '') {
                        $giftManage->note = $request->note;
                    }
                    $giftManage->merchant_id = Auth::user()->id;
                    $giftManage->save();
                    if ($request->value != '') {
                        $giftvalue = new GiftItemValue;
                        $giftvalue->gift_id = $giftManage->id;
                        $giftvalue->price = $request->value;
                        $giftvalue->merchant_id = Auth::user()->id;
                        $giftvalue->save();
                    }
                }
            }
            if ($giftManage) {
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function ajaxViewGift(Request $request)
    {
        if ($request->ajax()) {
            $viewValue = GiftItemValue::where('gift_id', $request->value)->where('merchant_id', Auth::user()->id)->first();
            return response()->json(['success' => 1, 'data' => $viewValue]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function ajaxremoveGift(Request $request)
    {
        if ($request->ajax()) {
            $removeGift = GiftManage::find($request->gift_remove);
            if ($removeGift) {
                $removeGift->status = 0;
                $removeGift->save();
            }
            return response()->json(['success' => 1, 'data' => $removeGift]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function ajaxreaddGift(Request $request)
    {
        if ($request->ajax()) {
            $readdGift = GiftManage::find($request->gift_readd);
            if ($readdGift) {
                $readdGift->status = 1;
                $readdGift->save();
            }
            return response()->json(['success' => 1, 'data' => $readdGift]);
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function ajaxEditGift(Request $request, $id)
    {
        if ($request->ajax()) {
            $editGift = GiftManage::find($request->gift_edit);
            if ($editGift) {
                return response()->json(['success' => 1, 'data' => $editGift]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }
    public function ajaxUpdateGift(Request $request, $id)
    {
        if ($request->ajax()) {
            $gift = GiftManage::find($id);
            // return response()->json(['data' => $itemService ]);
            $gift->gift_name = $request->gift_name;
            $gift->business_category_id = Auth::user()->merchantBusiness->business_category_id;
            if ($request->note != '') {
                $gift->note = $request->note;
            }
            $gift->save();
            if ($request->value) {
                $is_value = GiftItemValue::where('merchant_id', auth()->user()->id)->where('gift_id', $id)->first();
                if ($is_value) {
                    $is_value->price = $request->value;
                    $is_value->save();
                } else {
                    $giftprice = new GiftItemValue;
                    $giftprice->gift_id = $id;
                    $giftprice->price = $request->value;
                    $giftprice->merchant_id = Auth::user()->id;
                    $giftprice->save();
                }
            }
            if ($gift) {
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }

    public function filterGift(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 'Active') {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $activeitems = GiftManage::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('status', 1)->where('merchant_id', Auth::user()->id)->get();
                if (count($activeitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $activeitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            } else if ($request->status == 'Inactive') {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $inactiveitems = GiftManage::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('status', 0)->where('merchant_id', Auth::user()->id)->get();
                if (count($inactiveitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $inactiveitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            } else {
                $category_id = Auth::user()->merchantBusiness->business_category_id;
                $allitems = GiftManage::where('business_category_id', $category_id)->orderBy('id', 'desc')->where('merchant_id', Auth::user()->id)->get();
                if (count($allitems) > 0) {
                    return response()->json(['success' => 1, 'data' => $allitems]);
                } else {
                    return response()->json(['success' => 0]);
                }
            }
        }
    }

    public function addGiftValue(Request $request)
    {
        if ($request->ajax()) {
            $itemprice = new GiftItemValue;
            $itemprice->gift_id = $request->giftid;
            $itemprice->price = $request->price;
            $itemprice->merchant_id = Auth::user()->id;
            $itemprice->save();
            if ($itemprice) {
                return response()->json(['success' => 1]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }

    public function getDateExtend(Request $request)
    {
        if ($request->ajax()) {
            $programs = MerchantLoyaltyProgram::with('loyaltylocations', 'loyaltylocations.locations')->find($request->program_id);
            if ($programs) {
                $locationids = $programs->loyaltylocations->pluck('location_id');
                $otherLocation = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->whereNotIn('id', $locationids)->where('status', 1)->get();

                return response()->json(['success' => 1, 'data' => $programs, 'other_location' => $otherLocation]);
            } else {
                return response()->json(['success' => 0]);
            }
        }
    }
    public function resetExtendDate(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'extend') {
                $program = MerchantLoyaltyProgram::find($request->program_id);
                //  return response()->json(['success' => 1, 'data' => $request->reset_date]);
                if ($program) {

                    $showstartdate = date_format(date_create($program->start_on), 'm/d/Y');
                    $validator  =   Validator::make(
                        $request->all(),
                        [
                            "reset_date"  =>  'required|after:' . $program->start_on,
                        ],
                        [
                            "reset_date.required" => 'The extend date is required',
                            "reset_date.after" => 'The extend date must be a date after ' . $showstartdate,
                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        $enddate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->reset_date)->format('Y-m-d');
                        $reward_location = LoyaltyRewardLocation::where('loyalty_program_id', $request->program_id)->where('end_date', $program->end_on)->get();
                        if (count($reward_location) > 0) {
                            foreach ($reward_location as $location) {
                                $loyaltylocation = LoyaltyRewardLocation::find($location->id);
                                $loyaltylocation->end_date = $enddate;
                                $loyaltylocation->save();
                            }
                            $program->end_on = $enddate;
                            $program->save();
                            return response()->json(['success' => 2, 'data' => $program]);
                        } else {
                            $program->end_on = $enddate;
                            $program->save();
                            return response()->json(['success' => 1, 'data' => $program]);
                        }
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Loyalty program not found']);
                }
            } else {
                $program = MerchantLoyaltyProgram::find($request->program_id);
                if ($program) {
                    $today = date('Y-m-d');
                    $showstartdate = date_format(date_create($program->start_on), 'm/d/Y');
                    // return response()->json(['success' => $request->reset_date]);
                    $validator  =   Validator::make(
                        $request->all(),
                        [
                            "reset_date"  =>  'required|after:' . $program->start_on
                        ],
                        [
                            "reset_date.required" => 'The extend date is required',
                            "reset_date.after" => 'The extend date must be a date after ' . $showstartdate,
                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        $enddate = \Carbon\Carbon::createFromFormat('m/d/Y', $request->reset_date)->format('Y-m-d');
                        $program->end_on = $enddate;
                        $program->save();
                        return response()->json(['success' => 1, 'data' => $program]);
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Loyalty program not found']);
                }
            }
        }
    }

    public function resetEndDate(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'schedule') {
                $program = MerchantLoyaltyProgram::find($request->program_id);
                //return response()->json(['success' => 1, 'data' => $request->end_date]);
                if ($program) {
                    $showstartdate = date_format(date_create($program->start_on), 'm/d/Y');
                    $validator  =   Validator::make(
                        $request->all(),
                        [
                            "end_date"  =>  'required|after:' . $program->start_on
                        ],
                        [
                            "end_date.required" => 'The end date is required',
                            "end_date.after" => 'The end date must be a date after ' . $showstartdate,

                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {

                        $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                        $program->end_on = $enddate;
                        $program->save();
                        $locations = LoyaltyRewardLocation::where('loyalty_program_id', $request->program_id)->where('end_date', null)->get();
                        if (count($locations)) {
                            foreach ($locations as $locationData) {
                                $locationid = $locationData->id;
                                $loyalty_location = LoyaltyRewardLocation::find($locationid);
                                $loyalty_location->end_date = $enddate;
                                $loyalty_location->save();
                            }
                        }

                        return response()->json(['success' => 1, 'data' => $program]);
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Loyalty program not found']);
                }
            } else {
                $program = MerchantLoyaltyProgram::find($request->program_id);
                if ($program) {
                    $today = date('Y-m-d');
                    $resetdate = date('Y-m-d', strtotime($today . ' + 30 days'));
                    //$showresetdate = date('m/d/Y', strtotime($today. ' + 30 days'));
                    $showstartdate = date_format(date_create($program->start_on), 'm/d/Y');
                    if ($resetdate < $program->start_on) {
                        return response()->json(['success' => 2, 'message' => 'End date may be after ' . $showstartdate]);
                    } else {
                        $program->end_on = $resetdate;
                        $program->save();
                        $locations = LoyaltyRewardLocation::where('loyalty_program_id', $request->program_id)->where('end_date', null)->get();
                        if (count($locations)) {
                            foreach ($locations as $locationData) {
                                $locationid = $locationData->id;
                                $loyalty_location = LoyaltyRewardLocation::find($locationid);
                                $loyalty_location->end_date = $resetdate;
                                $loyalty_location->save();
                            }
                        }
                        return response()->json(['success' => 1, 'data' => $program]);
                    }
                } else {
                    return response()->json(['success' => 0, 'message' => 'Loyalty program not found']);
                }
            }
        }
    }

    public function addLocationToProgram(Request $request)
    {
        if ($request->ajax()) {
            if ($request->location_id != '') {
                $today = date('Y-m-d');
                if ($request->program_id != '') {
                    $program = MerchantLoyaltyProgram::find($request->program_id);
                    if ($program) {
                        if ($program->end_on != null) {
                            $enddate = date_create($program->end_on);
                            $todaydate = date_create($today);
                            $diff = date_diff($enddate, $todaydate);
                            $days = $diff->format('%a');
                            if (($program->end_on > $today) && ($days <= 14)) {
                                return response()->json(['success' => 0, 'message' => 'less or equal to 14 days']);
                            } else {
                                $reward_location = new LoyaltyRewardLocation;
                                $reward_location->loyalty_program_id = $request->program_id;
                                $reward_location->location_id = $request->location_id;
                                $reward_location->status = 1;
                                $reward_location->save();
                                if ($reward_location) {
                                    $added_location = LoyaltyRewardLocation::with('locations')->find($reward_location->id);
                                    return response()->json(['success' => 1, 'data' => $added_location]);
                                } else {
                                    return response()->json(['success' => 2]);
                                }
                            }
                        } else {
                            $reward_location = new LoyaltyRewardLocation;
                            $reward_location->loyalty_program_id = $request->program_id;
                            $reward_location->location_id = $request->location_id;
                            $reward_location->status = 1;
                            $reward_location->save();
                            if ($reward_location) {
                                $added_location = LoyaltyRewardLocation::with('locations')->find($reward_location->id);
                                return response()->json(['success' => 1, 'data' => $added_location]);
                            } else {
                                return response()->json(['success' => 2]);
                            }
                        }
                    } else {
                        return response()->json(['success' => 2]);
                    }
                } else {
                    return response()->json(['success' => 2]);
                }
            } else {
                return response()->json(['success' => 3]);
            }
        }
    }
    public function resetLocationEndDate(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'location_schedule') {
                $reward_location = LoyaltyRewardLocation::find($request->reward_location_id);
                if ($reward_location) {
                    $merchant_program = MerchantLoyaltyProgram::find($reward_location->loyalty_program_id);
                    if ($merchant_program) {
                        $showlocationdate = date_format(date_create($reward_location->end_date), 'm/d/Y');
                        if ($merchant_program->end_on != null) {
                            $showenddate = date_format(date_create($merchant_program->end_on), 'm/d/Y');
                            $resetenddate = date('Y-m-d', strtotime($merchant_program->end_on . ' + 1 days'));
                            // return response()->json(['success' => $request->end_date]);
                            $validator  =   Validator::make(
                                $request->all(),
                                [
                                    "end_date"  =>  'required|after:' . $reward_location->end_date . '|before:' . $resetenddate,
                                ],
                                [
                                    "end_date.required" => 'The end date is required',
                                    "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                                    "end_date.before" => 'The end date must be a date on or before ' . $showenddate,
                                ]
                            );
                            if ($validator->fails()) {
                                return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                                $reward_location->end_date = $enddate;
                                $reward_location->save();
                                return response()->json(['success' => 1, 'data' => $reward_location]);
                            }
                        } else {
                            $validator  =   Validator::make(
                                $request->all(),
                                [
                                    "end_date"  =>  'required|after:' . $reward_location->end_date,
                                ],
                                [
                                    "end_date.required" => 'The end date is required',
                                    "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                                ]
                            );
                            if ($validator->fails()) {
                                return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                                $reward_location->end_date = $enddate;
                                $reward_location->save();
                                return response()->json(['success' => 1, 'data' => $reward_location]);
                            }
                        }
                    }
                }
            }
            if ($request->type = 'location_end') {

                $reward_location = LoyaltyRewardLocation::find($request->reward_location_id);

                if ($reward_location) {
                    $merchant_program = MerchantLoyaltyProgram::find($reward_location->loyalty_program_id);
                    $today = date('Y-m-d');
                    $showstartdate = date_format(date_create($merchant_program->start_on), 'm/d/Y');
                    $validator  =   Validator::make(
                        $request->all(),
                        [
                            "end_date"  =>  'required|after:' . $merchant_program->start_on
                        ],
                        [
                            "end_date.required" => 'The end date is required',
                            "end_date.after" => 'The end date must be a date after ' . $showstartdate,
                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                    } else {
                        $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                        $reward_location->end_date = $enddate;
                        $reward_location->save();
                        return response()->json(['success' => 1, 'data' => $reward_location]);
                    }
                }
            }
        }
    }

    public function scheduleLocationEndDate(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'location_schedule') {
                $reward_location = LoyaltyRewardLocation::find($request->reward_location_id);
                if ($reward_location) {
                    $merchant_program = MerchantLoyaltyProgram::find($reward_location->loyalty_program_id);
                    if ($merchant_program) {
                        $showlocationdate = date_format(date_create($reward_location->end_date), 'm/d/Y');
                        if ($merchant_program->end_on != null) {
                            $showenddate = date_format(date_create($merchant_program->end_on), 'm/d/Y');
                            $resetenddate = date('Y-m-d', strtotime($merchant_program->end_on . ' + 1 days'));
                            // return response()->json(['success' => $request->end_date]);
                            $validator  =   Validator::make(
                                $request->all(),
                                [
                                    "end_date"  =>  'required|after:' . $reward_location->end_date . '|before:' . $resetenddate,
                                ],
                                [
                                    "end_date.required" => 'The end date is required',
                                    "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                                    "end_date.before" => 'The end date must be a date on or before ' . $showenddate,
                                ]
                            );
                            if ($validator->fails()) {
                                return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                                $reward_location->end_date = $enddate;
                                $reward_location->save();
                                return response()->json(['success' => 1, 'data' => $reward_location]);
                            }
                        } else {
                            $validator  =   Validator::make(
                                $request->all(),
                                [
                                    "end_date"  =>  'required|after:' . $reward_location->end_date,
                                ],
                                [
                                    "end_date.required" => 'The end date is required',
                                    "end_date.after" => 'The end date must be a date after ' . $showlocationdate,
                                ]
                            );
                            if ($validator->fails()) {
                                return response()->json(["success" => 0, "validation_errors" => $validator->errors()->first()]);
                            } else {
                                $enddate =  \Carbon\Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');
                                $reward_location->end_date = $enddate;
                                $reward_location->save();
                                return response()->json(['success' => 1, 'data' => $reward_location]);
                            }
                        }
                    }
                }
            }
        }
    }

    public function loyaltyMerchantLocation(Request $request)
    {
        if ($request->ajax()) {

            $location = BusinessLocation::with('states')->find($request->location_id);
            // return response()->json(["success" => $location]);
            if ($location) {
                return response()->json(["success" => 1, 'data' => $location]);
            } else {
                return response()->json(["success" => 0]);
            }
        }
    }

    public function getProgramFromLocationid(Request $request)
    {
        if ($request->ajax()) {
            $reward_location = LoyaltyRewardLocation::find($request->location_id);
            if ($reward_location) {
                $merchant_program = MerchantLoyaltyProgram::find($reward_location->loyalty_program_id);
                if ($merchant_program) {
                    $today = date('Y-m-d');
                    if ($merchant_program->end_on != null) {
                        if ($reward_location->end_date != null) {
                            $enddate = date_create($reward_location->end_date);
                            $todaydate = date_create($today);
                            $diff = date_diff($enddate, $todaydate);
                            $locationdays = $diff->format('%a');
                            if ($locationdays > 30) {
                                $locationdate = date_format($enddate, 'm/d/Y');
                                return response()->json(["status" => 1, "data" => $locationdate]);
                            } else {
                                $programenddate = date_create($merchant_program->end_on);
                                $programdate = date_format($programenddate, 'm/d/Y');
                                return response()->json(["status" => 1, "data" => $programdate]);
                            }
                        } else {
                            $programenddate = date_create($merchant_program->end_on);
                            $programdate = date_format($programenddate, 'm/d/Y');
                            return response()->json(["status" => 1, "data" => $programdate]);
                        }
                    } else {
                        $programenddate = date_create($merchant_program->end_on);
                        $programdate = date_format($programenddate, 'm/d/Y');
                        return response()->json(["status" => 2, "data" => $programdate]);
                    }
                    // $enddate = date_create($merchant_program->end_on);
                    // $todaydate = date_create($today);
                    // $diff = date_diff($enddate, $todaydate);
                    // $days = $diff->format('%a');
                    // if (($merchant_program->end_on > $today) && ($days <= 14)){
                    //     return response()->json(["success" => 1]);
                    // }
                    // else{
                    //     return response()->json(["success" => 0]);
                    // }
                } else {
                    return response()->json(["status" => 0]);
                }
            }
        }
    }
}
