<?php

namespace App\Http\Controllers\Frontend\MerchantBusiness;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Admin\Business\BusinessEdit;
use App\Models\BusinessLocation;
use App\Models\DisplayBoard;
use App\Models\MerchantDisplayBoard;
use App\Models\MerchantLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantMessageBoardController extends Controller
{
    public function messageBoard(){
        $participating_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('participating_type','Participating')->where('status', 1)->get();
        $merchant_location = MerchantLocation::where('user_id', '!=', Auth::user()->id)->where('status', 1)->get();
        $user_merchant_location = MerchantLocation::with('businessLocation.states','merchantUser')->where('user_id', Auth::user()->id)->get();
        
        $display_board = DisplayBoard::get();
        $main_location = MerchantLocation::with('merchantUser')->where('user_id', Auth::user()->id)->where('is_main', 1)->first();
        $user_message_board = MerchantDisplayBoard::where('business_id', Auth::user()->business_id)->first();
        return view('frontend.merchant_owner.message-board.message_board', compact('participating_locations', 'merchant_location', 'user_merchant_location', 'display_board', 'user_message_board', 'main_location'));
    }

    public function merchantLocation(Request $request){
        if($request->ajax()){
            $user_message_board = MerchantDisplayBoard::with('boardone', 'boardtwo', 'location.states')->where('business_id', Auth::user()->business_id)->where('location_id', $request->location_id)->first();
            //   return response()->json(["success" => $user_message_board]);
            if($user_message_board){ 
                return response()->json(["success" => 1, 'userboard' => $user_message_board]);
            }
            else{
                $location = BusinessLocation::with('states')->find($request->location_id);
                return response()->json(["success" => 0, 'data' => $location, ]);
            }  
            
        }
    }

    public function storeMerchantMessageBorad(Request $request){
        // dd($request->all());
        $location = BusinessLocation::find($request->location_id);
        if($request->display_status != ''){
            
            if($request->display_board != ''){
            
                    $this->validate($request,[
                        'description' => 'required',
                    
                    ],[
                        'description.required' => 'The Message field is required.',
                    
                    ]);
                
            }
            if($request->display_board2 != ''){
                    $this->validate($request,[
                        'description2' => 'required',
                    
                    ],[
                        'description2.required' => 'The Message field is required.',
                        
                    ]);
                
            }
            if($request->description != ''){
                    $this->validate($request,[
                        'display_board' => 'required',
                        
                    ],[
                        'display_board.required' => 'Please select a Message type',
                
                    ]);
                
            }
            if($request->description2 != ''){
                    $this->validate($request,[
                        'display_board2' => 'required',
                        
                    ],[
                        'display_board2.required' => 'Please select a Message type',
                        
                    ]);
            }
        }
        else{
            $this->validate($request,[
                'display_status' => 'required',
            
            ],[
                'display_status.required' => 'Select Display message board status',
                
            ]);
        }
      
      $merchantDisplay = MerchantDisplayBoard::where('location_id', $request->participating_location)->first();
    //   dd($merchantDisplay);
      if($merchantDisplay){
        if($merchantDisplay->description2 == ''){
            if($merchantDisplay->description == ''){
                //dd($request->description);
                if($request->description == ''){
                    if($request->description2 == ''){
                        return redirect()->route('frontend.business_owner.merchant_message_board'); 
                    }

                }
                
            }
        }
        $merchantDisplay->display_board_id = $request->display_board;
        $merchantDisplay->description = $request->description;
        $merchantDisplay->display_board_id2 = $request->display_board2;
        $merchantDisplay->description2 = $request->description2;
        $merchantDisplay->status = $request->display_status;
        $merchantDisplay->save();
      }else{
        $newDisplay = new MerchantDisplayBoard();
        $newDisplay->location_id = $request->participating_location;
        $newDisplay->business_id = Auth::user()->business_id;
        $newDisplay->display_board_id = $request->display_board;
        $newDisplay->start_date = $request->start_date;
        $newDisplay->end_date = $request->end_date;
        $newDisplay->description = $request->description;
        $newDisplay->status = $request->display_status;
        if($request->add_date == 'on'){
            $newDisplay->add_message_date = 1;
        }
        else{
            $newDisplay->add_message_date = 0;
        }
        $newDisplay->display_board_id2 = $request->display_board2;
        $newDisplay->start_date2 = $request->start_date2;
        $newDisplay->end_date2 = $request->end_date2;
        $newDisplay->description2 = $request->description2;
        if($request->add_date2 == 'on'){
            $newDisplay->add_message_date2 = 1;
        }
        else{
            $newDisplay->add_message_date2 = 0;
        }
        $newDisplay->save();
      }
      return redirect()->route('frontend.business_owner.merchant_message_board')->with('success','Message board has been updated successfully');
    }
}
