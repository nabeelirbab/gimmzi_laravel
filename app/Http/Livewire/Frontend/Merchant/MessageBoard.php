<?php

namespace App\Http\Livewire\Frontend\Merchant;

use App\Models\BusinessLocation;
use App\Models\DisplayBoard;
use App\Models\MerchantDisplayBoard;
use App\Models\MerchantLocation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessageBoard extends Component
{
    public $merchant_location, $category_id, $items, $itemGet, $item_price, $price_show, $price = [], $business_locations = [];
    public $item_name, $value_one, $value_two, $note, $participating_location_ids = [], $action_value = [], $removeid, $action_type, $status;
    public $merchant_main_location, $location, $participating_locations, $user_message_board, $main_location, $display_board, $selectedboard, $merchantDisplay;
    public $display_board_id, $description, $display_board_id2, $description2, $location_id;

    public function mount()
    {
        $this->category_id = Auth::user()->merchantBusiness->business_category_id;
        $this->merchant_location = MerchantLocation::with('businessLocation.states', 'merchantUser')->where('user_id', Auth::user()->id)->get();

        $this->business_locations = BusinessLocation::where('business_profile_id', Auth::user()->business_id)->where('status', 1)->where('participating_type', 'Participating')->get();
        foreach ($this->merchant_location as $locations) {
            if ($locations->is_main == 1) {
                $this->location = $locations->businessLocation->address . ', ' . $locations->businessLocation->city . ', ' . $locations->businessLocation->states->name . ', ' . $locations->businessLocation->zip_code;
                $this->merchant_main_location = $locations->businessLocation->id;
            }
        }
        $this->main_location = MerchantLocation::with('merchantUser')->where('user_id', Auth::user()->id)->where('is_main', 1)->first();
        $this->display_board = DisplayBoard::get();

        $this->user_message_board = MerchantDisplayBoard::where('business_id', Auth::user()->business_id)->first();
        if ($this->user_message_board) {
            $this->user_message_board = $this->user_message_board;
            $this->fill($this->user_message_board);
        } else {
            $this->user_message_board = new MerchantDisplayBoard;
        }
    }
    public function getLocationDetail()
    {
        if ($this->merchant_main_location != '') {
            // dd($this->merchant_main_location);
            $get_location = BusinessLocation::with('states')->find($this->merchant_main_location);
            if ($get_location) {
                if ($get_location->states) {
                    $this->location = $get_location->address . ', ' . $get_location->city . ', ' . $get_location->states->name . ', ' . $get_location->zip_code;
                } else {
                    $this->location = $get_location->address . ', ' . $get_location->city . ', ' . $get_location->state_name . ', ' . $get_location->zip_code;
                }
            }
        }
    }

    public function changeLocationBoard()
    {
        // $selectedlocation = BusinessLocation::find($this->location_id); 
        $this->selectedboard =  MerchantDisplayBoard::where('location_id', $this->location_id)->first();
        //   dd($this->selectedboard );
        if ($this->selectedboard) {
            $this->status = $this->selectedboard->status;
            $this->display_board_id = $this->selectedboard->display_board_id;
            $this->display_board_id2 = $this->selectedboard->display_board_id2;
            $this->description = $this->selectedboard->description;
            $this->description2 = $this->selectedboard->description2;
        } else {
            $this->status = '';
            $this->display_board_id = '';
            $this->display_board_id2 = '';
            $this->description =  '';
            $this->description2 = '';
        }
        // dd($this->description);
        $this->emit('descriptionUpdated', $this->description);
        $this->emit('description2Updated', $this->description2);
    }

    

    // public function changeMessagetype(){

    //     $this->selectedboard =  MerchantDisplayBoard::where('location_id', $this->location_id)
    //     ->where('display_board_id',$this->display_board_id)->first();
    //     // dd($this->selectedboard);
    //     if ($this->selectedboard) {
    //         $this->description = $this->selectedboard->description;
    //     } else {
    //         $this->description =  null;
    //     }

    //     // dd($this->description);
    // }

    public function clearMessage()
    {
   
        // $this->description = null;
        // $this->emit('clear_message');
        $this->display_board_id = '';
        $this->description = ''; // Clear the Livewire-bound property
        $this->emit('descriptionCleared');
    }


    public function clearMessage2()
    {
        $this->display_board_id2 = '';
        $this->description2 = null;
        $this->emit('clear_message2');
    }

    public function submitMerchantMessageboard()
    {
        if ($this->status != '') {
            if ($this->display_board_id != '') {
                $this->validate([
                    'description' => 'required',

                ], [
                    'description.required' => 'The Message field is required.',

                ]);
            }
            if ($this->display_board_id2 != '') {
                $this->validate([
                    'description2' => 'required',

                ], [
                    'description2.required' => 'The Message field is required.',

                ]);
            }
            if ($this->description != '') {
                $this->validate([
                    'display_board_id' => 'required',

                ], [
                    'display_board_id.required' => 'Please select a Message type',

                ]);
            }
            if ($this->description2 != '') {
                // dd($this->display_board_id2);
                $this->validate([
                    'display_board_id2' => 'required',

                ], [
                    'display_board_id2.required' => 'Please select a Message type',

                ]);
            }
        } else {
            $this->validate([
                'status' => 'required',

            ], [
                'status.required' => 'Select Display message board status',

            ]);
        }
        $this->merchantDisplay = MerchantDisplayBoard::where('location_id', $this->location_id)->first();
        if ($this->merchantDisplay) {
            if ($this->merchantDisplay->description2 == '') {
                if ($this->merchantDisplay->description == '') {
                    //dd($request->description);
                    if ($this->description == '') {
                        if ($this->description2 == '') {
                            // return redirect()->route('frontend.business_owner.merchant_message_board');
                            $this->emit('successModal',['text'=>'Please give a description for message board']);
                        }
                    }
                }
            }
            $this->merchantDisplay->display_board_id = $this->display_board_id;
            $this->merchantDisplay->description = $this->description;
            $this->merchantDisplay->display_board_id2 = $this->display_board_id2;
            $this->merchantDisplay->description2 = $this->description2;
            $this->merchantDisplay->status = $this->status;
            $this->merchantDisplay->save();
        } else {
            $newDisplay = new MerchantDisplayBoard();
            $newDisplay->location_id = $this->location_id;
            $newDisplay->business_id = Auth::user()->business_id;
            $newDisplay->display_board_id = $this->display_board_id;
            $newDisplay->description = $this->description;
            $newDisplay->status = $this->status;
            $newDisplay->display_board_id2 = $this->display_board_id2;
            $newDisplay->description2 = $this->description2;
            $newDisplay->save();
        }
        $this->emit('successModal',['text'=>'Merchant Message Board updated successfully']);
    }


    public function previewMessageBoard(){
        // dd($this->description);
        if($this->status == true){
         if($this->display_board_id != null){
             $msgtype = MerchantDisplayBoard::find($this->display_board_id);
            $board = DisplayBoard::where('id', $this->display_board_id)->first();
            $title = $board->title;
             $message = $this->description;
            
         }
         else{
             $title = '';
             $message = '';
             $start_date = '';
             $end_date = '';
         }
         if($this->display_board_id2 != null){
            $msgtype = MerchantDisplayBoard::find($this->display_board_id2);
            $board = DisplayBoard::where('id', $this->display_board_id2)->first();
            $title2 = $board->title;
             $message2 = $this->description2;
       
         }
         else{
             $title2 = '';
             $message2 = '';
             $start_date2 = '';
             $end_date2 = '';
         }
         
         $this->emit('openPreview',[
             'message_type' => $title,
             'message' => $message,
             'message_type2' => $title2,
             'message2' => $message2,
 
         ]);
        }
        else{
         $this->showInfoModal('To preview, Display Message Boards must be turned on.');
        }
     }
 
     public function showInfoModal($text)
     {
         $this->emit('infoModal', [
             'text'  => $text,
         ]);
     }


    
    public function render()
    {
        return view('livewire.frontend.merchant.message-board');
    }
}
