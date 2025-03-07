<?php

namespace App\Http\Controllers\Frontend\PropertyManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MessageBoard;
use App\Models\Provider;
use App\Models\PropertyUnderProviderUser;
use App\Models\ProviderBuilding;
use App\Models\BuildingUnit;
use App\Models\Point;
use  Hash,Session;
use App\Models\ConsumerUnit;
use App\Models\MerchantMessageBoard;
use App\Models\ProviderMessageBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageboardController extends Controller
{
    public function messageBoard()
    {
        $user = Auth::user();
        $propertyDetails = PropertyUnderProviderUser::where('provider_user_id',$user->id)->with('provider')->get();
        $messageboard = MessageBoard::where('travel_tourism_type',null)->get();
        if(session::get('provider_id') != ''){
            $propertyid = session::get('provider_id');
            $providers = PropertyUnderProviderUser::with('provider','provideruser','title')->where('provider_id',$propertyid)->where('title_id','!=',4)->whereHas('provideruser',function($q){
                $q->where('active',1);})->get();
            $provider_messages = ProviderMessageBoard::where('provider_id',$propertyid)->first();
        }
        else{
            $propertyid = $propertyDetails->first()->provider_id;
            $providers = PropertyUnderProviderUser::with('provider','provideruser','title')->where('provider_id',$propertyid)->where('title_id','!=',4)->whereHas('provideruser',function($q){
                $q->where('active',1);})->get();
            $provider_messages = ProviderMessageBoard::where('provider_id',$propertyid)->first();
        }
        return view('frontend.property-manager.message_board', compact('messageboard','provider_messages','propertyDetails','propertyid','providers','user'));
    }


    public function viewMessageaBoard(Request $request)
    {

        if ($request->ajax()) {
            $messageboard = MessageBoard::find($request->messageBoardid);

            $providerMessage = ProviderMessageBoard::where('message_board_id', $request->messageBoardid)->where('provider_id', Auth::user()->id)->first();
            if ($messageboard) {
                // $viewMessage = MessageBoard::with('message_boards')->where('id', $request->id)->where('is_main', 1)->first();
                return response()->json(['success' => 1, 'data' => $messageboard, 'providerMessage' => $providerMessage,]);
            }
        } else {
            return response()->json(['success' => 0]);
        }
    }



    public function getMessageBoard(Request $request)
    {
        if($request->ajax()) {
            $provider_messages = ProviderMessageBoard::with('property')->where('provider_id',$request->propertyid)->first();
            if($provider_messages){
                return response()->json(["status" => 1 , "data" => $provider_messages]);
            }
            else{
                $provider = Provider::find($request->propertyid);
                return response()->json(["status" => 0 , "data" => $provider]);
            }
            
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function storeMessageBorad(Request $request){
        $providerid = Auth::user()->id;
        $provider = Provider::find($request->property_id);
        Session::put('provider_name', $provider->name);
        Session::put('provider_id', $request->property_id);
        //dd($request->display_board);
        if($request->display_board != ''){
            // if($request->add_date == 'on'){
            //     if($request->end_date != ''){
            //         $this->validate($request,[
            //             'start_date' => 'required',
            //             'end_date'  =>'after:'.$request->start_date
            //         ],[
            //             'start_date.required' => 'The Start date field is required.',
            //             'end_date.after' => 'The End date should be after start date',
            //         ]);
            //     }
            //     else{
            //         $this->validate($request,[
            //             'start_date' => 'required',
            //         ],[
            //             'start_date.required' => 'The Start date field is required.',
            //         ]);
            //     }
                
            // }
            // if($request->add_date2 == 'on'){
            //     if($request->end_date2 != ''){
            //         $this->validate($request,[
            //             'start_date2' => 'required',
            //             'end_date2'  =>'after:'.$request->start_date2
            //         ],[
            //             'start_date2.required' => 'The Start date field is required.',
            //             'end_date2.after' => 'The End date should be after start date',
            //         ]);
            //     }
            //     else{
            //         $this->validate($request,[
            //             'start_date2' => 'required',
            //         ],[
            //             'start_date2.required' => 'The Start date field is required.',
            //         ]);
            //     }
                
            // }
            if($request->message_board_id != ''){
                    $this->validate($request,[
                        'message' => 'required',
                        'show_for' => 'required'
                    ],[
                        'message.required' => 'The Message field is required.',
                        'show_for.required' => 'Please select any of these two'
                    ]);
                
            }
            if($request->message_board_id2 != ''){
                    $this->validate($request,[
                        'message2' => 'required',
                        'show_for2' => 'required'
                    ],[
                        'message2.required' => 'The Message field is required.',
                        'show_for2.required' => 'Please select any of these two'
                    ]);
                
            }
            if($request->message != ''){
                    $this->validate($request,[
                        'message_board_id' => 'required',
                        'show_for' => 'required'
                    ],[
                        'message_board_id.required' => 'Please select a Message type',
                        'show_for.required' => 'Please select any of these two'
                    ]);
                
            }
            if($request->message2 != ''){
                    $this->validate($request,[
                        'message_board_id2' => 'required',
                        'show_for2' => 'required'
                    ],[
                        'message_board_id2.required' => 'Please select a Message type',
                        'show_for2.required' => 'Please select any of these one'
                    ]);
            }
            if($request->show_for != ''){
                $this->validate($request,[
                    'message_board_id' => 'required',
                    'message' => 'required'
                ],[
                    'message_board_id.required' => 'Please select a Message type',
                    'message.required' => 'The Message field is required'
                ]);
                
            }
            if($request->show_for2 != ''){
                $this->validate($request,[
                    'message_board_id2' => 'required',
                    'message2' => 'required'
                ],[
                    'message_board_id2.required' => 'Please select a Message type',
                    'message2.required' => 'The Message field is required'
                ]);
                
            }
        }
        else{
            $this->validate($request,[
                'display_board' => 'required',
            
            ],[
                'display_board.required' => 'Select Display message board status',
                
            ]);
        }

        $provider_messages = ProviderMessageBoard::where('provider_id',$request->property_id)->first();
        if($provider_messages){
            if($provider_messages->message2 == ''){
                if($provider_messages->message == ''){
                    if($request->message == ''){
                        if($request->message2 == ''){
                            return redirect()->route('frontend.message-board'); 
                        }
                    }
                    
                }
            }
            $provider_messages->message_board_id = $request->message_board_id;
            $provider_messages->status = $request->display_board;
            // $provider_messages->start_date = $request->start_date;
            // $provider_messages->end_date = $request->end_date;
            $provider_messages->message = $request->message;
            // if($request->add_date == 'on'){
            //     $provider_messages->add_message_date = 1;
            // }
            // else{
            //     $provider_messages->add_message_date = 0;
            // }
            if($provider_messages->message_board_id != ''){
          
                if($request->show_for == 'tenant'){
                    $provider_messages->tenant_only = 1;
                    $provider_messages->make_public = 0;
                }
                elseif($request->show_for == 'public'){
                    $provider_messages->make_public = 1;
                    $provider_messages->tenant_only = 0;
                }
                else{
                    $provider_messages->tenant_only = 0;
                    $provider_messages->make_public = 0;
                }
            }
            else{
                $provider_messages->tenant_only = 0;
                $provider_messages->make_public = 0;
            }
            $provider_messages->message_board_id2 = $request->message_board_id2;
            // $provider_messages->start_date2 = $request->start_date2;
            // $provider_messages->end_date2 = $request->end_date2;
            // if($request->add_date2 == 'on'){
            //     $provider_messages->add_message_date2 = 1;
            // }
            // else{
            //     $provider_messages->add_message_date2 = 0;
            // }
            if($provider_messages->message_board_id2 != ''){
                if($request->show_for2 == 'tenant'){
                    $provider_messages->tenant_only2 = 1;
                    $provider_messages->make_public2 = 0;
                    
                }
                elseif($request->show_for2 == 'public'){
                    $provider_messages->make_public2 = 1;
                    $provider_messages->tenant_only2 = 0;
                }
                else{
                    $provider_messages->tenant_only2 = 0;
                    $provider_messages->make_public2 = 0;
                }
            }
            else{
                $provider_messages->tenant_only2 = 0;
                $provider_messages->make_public2 = 0;
            }
            $provider_messages->message2 = $request->message2;
            $provider_messages->save();
        }
        else{
            $provider_board = new ProviderMessageBoard;
            $provider_board->provider_id = $request->property_id;
            $provider_board->message_board_id = $request->message_board_id;
            // $provider_board->start_date = $request->start_date;
            // $provider_board->end_date = $request->end_date;
            $provider_board->message = $request->message;
            $provider_board->status = $request->display_board;
            // if($request->add_date == 'on'){
            //     $provider_board->add_message_date = 1;
            // }
            // else{
            //     $provider_board->add_message_date = 0;
            // }
            if($request->message_board_id != ''){
                if($request->show_for == 'tenant'){
                    $provider_board->tenant_only = 1;
                    $provider_board->make_public = 0;
                }
                elseif($request->show_for == 'public'){
                    $provider_board->make_public = 1;
                    $provider_board->tenant_only = 0;
                }
                else{
                    $provider_board->tenant_only = 0;
                    $provider_board->make_public = 0;
                }
            }
            else{
                $provider_board->tenant_only = 0;
                $provider_board->make_public = 0;
            }
            $provider_board->message_board_id2 = $request->message_board_id2;
            // if($request->add_date2 == 'on'){
            //     $provider_board->add_message_date2 = 1;
            // }
            // else{
            //     $provider_board->add_message_date2 = 0;
            // }
            if($request->message_board_id2 != ''){
                if($request->show_for2 == 'tenant'){
                    $provider_board->tenant_only2 = 1;
                    $provider_board->make_public2 = 0;
                }
                elseif($request->show_for2 == 'public'){
                    $provider_board->tenant_only2 = 0;
                    $provider_board->make_public2 = 1;
                }
                else{
                    $provider_board->tenant_only2 = 0;
                    $provider_board->make_public2 = 0;
                }
            }
            else{
                $provider_board->tenant_only2 = 0;
                $provider_board->make_public2 = 0;
            }
            // $provider_board->start_date2 = $request->start_date2;
            // $provider_board->end_date2 = $request->end_date2;
            $provider_board->message2 = $request->message2;
            $provider_board->save();
        }
        Session::forget('provider_name');
        Session::forget('provider_id');
        return redirect()->route('frontend.message-board')->with('success','Message board has been updated successfully'); 
       
    }




}
