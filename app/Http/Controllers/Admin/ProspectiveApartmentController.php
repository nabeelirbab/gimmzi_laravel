<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotifyUserMail;
use App\Models\ProspectiveAppartmentList;
use Illuminate\Http\Request;
use App\Models\PropertyNote;
use App\Models\ProspectiveApartmentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class ProspectiveApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.prospective-apartment.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(ProspectiveAppartmentList $prospective_apartment)
    {

        $getprovider = ProspectiveAppartmentList::with('propertyNote', 'prospectiveApartmentUser')->find($prospective_apartment->id);
        $stateList = State::get();
        // dd($getprovider);
        return view('admin.prospective-apartment.view', compact('prospective_apartment', 'getprovider', 'stateList'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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



    public function addPropertyNote(Request $request)
    {
        if ($request->ajax()) {
            if (($request->zip_code != '') && ($request->state_id != '') && ($request->city_name != '')) {
                if ($request->contact_email != '') {
                    $validator  =   Validator::make($request->all(), [
                        "contact_email"  =>  [
                            'email',
                            Rule::unique('prospective_appartment_lists')->ignore($request->prospective_id),
                        ],
                    ]);
                    if ($validator->fails()) {
                        return response()->json(["status" => 5, "validation_errors" => $validator->errors()->first()]);
                    } else 
                        if ($request->contact_phone != '') {
                        $validator  =   Validator::make($request->all(), [
                            "contact_phone"  =>  [
                                'numeric',
                                Rule::unique('prospective_appartment_lists')->ignore($request->prospective_id),
                            ],
                        ]);
                        if ($validator->fails()) {
                            return response()->json(["status" => 6, "validation_errors" => $validator->errors()->first()]);
                        } else {
                            $prospective = ProspectiveAppartmentList::find($request->prospective_id);
                            $prospective->zip_code = $request->zip_code;
                            $prospective->state_id = $request->state_id;
                            $prospective->city = $request->city_name;
                            $prospective->apartment_name = $request->apartment_name;
                            $prospective->contact_name = $request->contact_name;
                            $prospective->contact_email = $request->contact_email;
                            $prospective->contact_phone = $request->contact_phone;
                            $prospective->save();
                        }
                    }
                } else {
                    $prospective = ProspectiveAppartmentList::find($request->prospective_id);
                    $prospective->zip_code = $request->zip_code;
                    $prospective->state_id = $request->state_id;
                    $prospective->city = $request->city_name;
                    $prospective->apartment_name = $request->apartment_name;
                    $prospective->contact_name = $request->contact_name;
                    $prospective->contact_email = $request->contact_email;
                    $prospective->contact_phone = $request->contact_phone;
                    $prospective->save();
                }
            }
            if ($request->action != '') {
                if ($request->note != '') {
                    if ($request->action == 'Added to Network') {
                        // return response()->json(['status'=> $request->notify_user]);
                        if ($request->notify_user == 'false') {

                            return response()->json(['status' => 1]);
                        } else {
                            //return response()->json(['status'=> Auth::user()->id]);
                            $property_note = new PropertyNote;
                            $property_note->note = $request->note;
                            $property_note->prospective_id = $request->prospective_id;
                            $property_note->action_taken = $request->action;
                            $property_note->notify_user = true;
                            $property_note->user_id = Auth::user()->id;
                            $property_note->save();
                            $prospective = ProspectiveAppartmentList::find($request->prospective_id);
                            // return response()->json(['status'=>$prospective]);
                            $prospective->status = 0;
                            $prospective->save();
                            $prospectiveuserid = ProspectiveApartmentUser::where('prospective_apartment_id', $request->prospective_id)->pluck('user_id')->toArray();
                            if ($prospectiveuserid) {
                                $userid = User::whereIn('id', $prospectiveuserid)->get();
                                if (count($userid) > 0) {
                                    foreach ($userid as $user) {
                                        $details = [
                                            'name' => $user->full_name,
                                            'apartment' => $prospective->apartment_name,
                                        ];
                                        Mail::to($user->email)->queue(new NotifyUserMail($details));
                                    }
                                }
                            }

                            return response()->json(['status' => 4]);
                        }
                    } elseif ($request->action == 'Unlist Provider') {

                        $property_note = new PropertyNote;
                        $property_note->note = $request->note;
                        $property_note->prospective_id = $request->prospective_id;
                        $property_note->action_taken = $request->action;
                        if ($request->notify_user == 'false') {
                            $property_note->notify_user = false;
                        } else {
                            $property_note->notify_user = true;
                        }
                        $property_note->user_id = Auth::user()->id;
                        $property_note->save();
                        $prospective = ProspectiveAppartmentList::find($request->prospective_id);
                        $prospective->status = 0;
                        $prospective->save();
                        return response()->json(['status' => 4]);
                    } elseif ($request->action == 'Relist') {

                        $property_note = new PropertyNote;
                        $property_note->note = $request->note;
                        $property_note->prospective_id = $request->prospective_id;
                        $property_note->action_taken = $request->action;
                        if ($request->notify_user == 'false') {
                            $property_note->notify_user = false;
                        } else {
                            $property_note->notify_user = true;
                        }
                        $property_note->user_id = Auth::user()->id;
                        $property_note->save();
                        $prospective = ProspectiveAppartmentList::find($request->prospective_id);
                        $prospective->status = 1;
                        $prospective->save();
                        return response()->json(['status' => 4]);
                    } else {
                        $property_note = new PropertyNote;
                        $property_note->note = $request->note;
                        $property_note->prospective_id = $request->prospective_id;
                        $property_note->action_taken = $request->action;
                        if ($request->notify_user == 'false') {
                            $property_note->notify_user = false;
                        } else {
                            $property_note->notify_user = true;
                        }
                        $property_note->user_id = Auth::user()->id;
                        $property_note->save();
                        return response()->json(['status' => 4]);
                    }
                } else {
                    return response()->json(['status' => 3]);
                }
            } else {
                return response()->json(['status' => 2]);
            }
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function viewPropertyNote(Request $request)
    {
        if ($request->ajax()) {
            $note = PropertyNote::find($request->note_id);
            if ($note) {
                return response()->json(['status' => 1, 'data' => $note]);
            }
        } else {
            return response()->json(['status' => 0]);
        }
    }

    // public function addPropertyContact(Request $request)
    // {

    //     if ($request->ajax()) {
    //         if ($request->contact_type != '') {
    //             if ($request->contact_type == 'name') {
    //                 if ($request->name != '') {
    //                     $prospective = ProspectiveAppartmentList::find($request->apartment_id);
    //                     $prospective->contact_name = $request->name;
    //                     $prospective->save();
    //                     return response()->json(['status' => 1]);
    //                 } else {
    //                     return response()->json(['status' => 0]);
    //                 }
    //             } else if ($request->contact_type == 'email') {
    //                 if ($request->email != '') {
    //                     $validator  =   Validator::make($request->all(), [
    //                         "email"  =>  "email"
    //                     ]);
    //                     if ($validator->fails()) {
    //                         return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
    //                     } else {
    //                         $prospective = ProspectiveAppartmentList::find($request->apartment_id);
    //                         $prospective->contact_email = $request->email;
    //                         $prospective->save();
    //                         return response()->json(['status' => 1]);
    //                     }
    //                 } else {
    //                     return response()->json(['status' => 0]);
    //                 }
    //             } else if ($request->contact_type == 'phone') {
    //                 if ($request->phone != '') {
    //                     $validator  =   Validator::make($request->all(), [
    //                         "phone"  =>  "numeric|digits:10"
    //                     ]);
    //                     if ($validator->fails()) {
    //                         return response()->json(["status" => 2, "validation_errors" => $validator->errors()->first()]);
    //                     } else {
    //                         $prospective = ProspectiveAppartmentList::find($request->apartment_id);
    //                         $prospective->contact_phone = $request->phone;
    //                         $prospective->save();
    //                         return response()->json(['status' => 1]);
    //                     }
    //                 } else {
    //                     return response()->json(['status' => 0]);
    //                 }
    //             } else {
    //                 return response()->json(['status' => 0]);
    //             }
    //         } else {
    //             return response()->json(['status' => 0]);
    //         }
    //     }
    // }
}
