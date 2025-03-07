<?php

namespace App\Http\Livewire\Frontend\TravelTourism\HotelResort;

use App\Http\Livewire\Traits\AlertMessage;
use App\Models\ProviderMessageBoard;
use App\Models\MessageBoard as messageType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MessageBoard extends Component
{
    use AlertMessage;
    public $user,$message_board,$type=[];
    public $message_board_id, $add_message_date, $start_date, $end_date,$message, $status, $message_board_id2, $add_message_date2, $start_date2,$end_date2, $message2, $dateCalender;
    public $add_date1 = 0;
    public $add_date2 = 0;
    public function mount(){
        $this->user = Auth::user();
        $this->message_board = ProviderMessageBoard::where('travel_tourism_id',$this->user->travel_tourism_id)->first();
        if($this->message_board){
            $this->message_board = $this->message_board;
            $this->fill($this->message_board);
        }
        else{
            $this->message_board = new ProviderMessageBoard;
        }
        //dd($this->message_board);
        $this->type = messageType::where('travel_tourism_type','for_hotel')->where('status',1)->get();
        $this->dateCalender = 'disabled';

    }

    public function addHotelMessageBoard(){
      

        $this->validate(
            [
                'message_board_id' => ['nullable'],
                'add_message_date' => ['nullable'],
                'start_date' => ['required_unless:add_message_date,false,null'],
                'end_date' => ['nullable','date','after:start_date'],
            ],
            [
                'message_board_id.required' => "Please select a Message Type",
                'start_date.required_unless' => "The Start Date field is required when add date to message is true.",
                'end_date.after' => "The End Date must be a date after Start Date.",
            ]
        );
        if($this->message_board_id != null){
            $this->validate(
                [
                    'message' => ['required'],
                    'status' => ['required'],
                ],
                [
                    'message.required' => "The Message field is required.",
                    'status.required' => "The Status field is required.",
                ]
            );

            $this->message_board->travel_tourism_id = $this->user->travel_tourism_id;
            $this->message_board->message_board_id = $this->message_board_id;
            $this->message_board->message = $this->message;
            if($this->add_message_date == true){
                $this->message_board->add_message_date = $this->add_message_date;
                $this->message_board->start_date = $this->start_date;
                if($this->end_date != null){
                    $this->message_board->end_date = $this->end_date;
                }

            }
            else{
                $this->message_board->add_message_date = 0;
                $this->message_board->start_date = null;
                $this->message_board->end_date = null;
            }
            $this->message_board->status = $this->status;
            $this->message_board->provider_type = 'for_hotel';
            $this->message_board->save();

        }else{
            if($this->message_board->travel_tourism_id != null){
                $this->message_board->message_board_id = null;
                $this->message_board->message = null;
                $this->message_board->add_message_date = false;
                $this->message_board->start_date = null;
                $this->message_board->end_date = null;
                $this->message_board->provider_type = 'for_hotel';
                $this->message_board->save();
            }
            //dd($this->message_board);
        }
        if($this->message_board_id2 != null){
            $this->validate(
                [
                    'message_board_id2' => ['nullable'],
                    'add_message_date2' => ['nullable'],
                    'start_date2' => ['required_unless:add_message_date2,false,null'],
                    'end_date2' => ['nullable','date','after:start_date2'],
                    'message2' => ['required'],
                ],
                [
                    'message_board_id2.required' => "Please select a Message Type",
                    'start_date2.required_unless' => "The Start Date field is required when add date to message is true.",
                    'end_date2.after' => "The End Date must be a date after Start Date.",
                    'message2.required' => "The Message field is required.",
                ]
            );
           
            $this->message_board->travel_tourism_id = $this->user->travel_tourism_id;
            $this->message_board->message_board_id2 = $this->message_board_id2;
            $this->message_board->message2 = $this->message2;
            if($this->add_message_date2 == true){
                $this->message_board->add_message_date2 = $this->add_message_date2;
                $this->message_board->start_date2 = $this->start_date2;
                if($this->end_date2 != null){
                    $this->message_board->end_date2 = $this->end_date2;
                }

            }
            else{
                $this->message_board->add_message_date2 = 0;
                $this->message_board->start_date2 = null;
                $this->message_board->end_date2 = null;
            }
            $this->message_board->status = $this->status;
            $this->message_board->provider_type = 'for_hotel';
            $this->message_board->save();
         
        }
        else{
            if($this->message_board->travel_tourism_id != null){
                $this->message_board->message_board_id2 = null;
                $this->message_board->message2 = null;
                $this->message_board->add_message_date2 = false;
                $this->message_board->start_date2 = null;
                $this->message_board->end_date2 = null;
                $this->message_board->provider_type = 'for_hotel';
                $this->message_board->save();
            }
        }
        if($this->message_board->travel_tourism_id != null){
            $this->message_board->save();
            $msgAction = 'Message board has been updated successfully';
            $this->showToastr("success", $msgAction);
        }
        return redirect()->route('frontend.hotel_resort.message_board');
    }

    public function previewMessageBoard(){
        if($this->status == true){
         if($this->message_board_id != null){
             $type = messageType::find($this->message_board_id);
             $title = $type->title;
             $message = $this->message;
             if($this->add_message_date == true){
                 $start_date = date_format(date_create($this->start_date),'m-d-Y');
             }
             else{
                 $start_date = '';
             }
             if($this->end_date != ''){
                 
                 $end_date = date_format(date_create($this->end_date),'m-d-Y');
             }
             else{
                 $end_date = '';
             }
         }
         else{
             $title = '';
             $message = '';
             $start_date = '';
             $end_date = '';
         }
         if($this->message_board_id2 != null){
             $type2 = messageType::find($this->message_board_id2);
             $title2 = $type2->title;
             $message2 = $this->message2;
             if($this->add_message_date2 == true){
                 $start_date2 = date_format(date_create($this->start_date2),'m-d-Y');
             }
             else{
                 $start_date2 = '';
             }
             if($this->end_date2 != ''){
                 
                 $end_date2 = date_format(date_create($this->end_date2),'m-d-Y');
             }
             else{
                 $end_date2 = '';
             }
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
             'start_date' => $start_date,
             'end_date' => $end_date,
             'message_type2' => $title2,
             'message2' => $message2,
             'start_date2' => $start_date2,
             'end_date2' => $end_date2,
 
         ]);
        }
        else{
         $this->showInfoModal('To preview, Display Message Boards must be turned on.');
        }
     }
 
     public function hideInfoModal(){
         $this->emit('closeInfo');
     }
 
     public function showInfoModal($text)
     {
         $this->emit('infoModal', [
             'text'  => $text,
         ]);
     }

     public function clearMessage(){
        $this->message_board_id = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->message = '';
        $this->add_message_date = false;
        $this->emit('clear_message');
    }

    public function clearMessage2(){
        $this->message_board_id2 = null;
        $this->start_date2 = null;
        $this->end_date2 = null;
        $this->message2 = '';
        $this->add_message_date2 = false;
        $this->emit('clear_message2');
    }

    public function addtoDate1(){
      if( $this->add_message_date  == true){
        $this->add_date1 = true;
      }
      else{
        $this->add_date1 = false;
      }
     
    }
    public function addtoDate2(){
        if( $this->add_message_date2  == true){
          $this->add_date2 = true;
        }
        else{
          $this->add_date2 = false;
        }
       
      }
 
    public function render()
    {
        return view('livewire.frontend.travel-tourism.hotel-resort.message-board');
    }
}
