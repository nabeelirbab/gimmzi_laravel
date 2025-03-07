<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class DisplayBoard extends Model
{
    use HasFactory;
    protected $fillable = ['title ', 'status'];
    protected $appends = ['active_board','active_days','active_description'];

    public function days()
    {
        return $this->hasMany(DisplayDay::class);
        
    }

    public function merchantBoard()
    {
        return $this->hasMany(MerchantDisplayBoard::class, 'display_board_id');
        
    }

    public function merchantBoardtwo()
    {
        return $this->hasMany(MerchantDisplayBoard::class, 'display_board_id2');
    }

    public function getActiveBoardAttribute(){
        $businessid = Auth::user()->business_id;
        $merchantBoard = MerchantDisplayBoard::where('display_board_id',$this->id)->where('business_id',$businessid)->first();
        if($merchantBoard){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function getActiveDaysAttribute(){
        $businessid = Auth::user()->business_id;
        $merchantBoard = MerchantDisplayBoard::where('display_board_id',$this->id)->where('business_id',$businessid)->first();
        if($merchantBoard){
            $merchantBoardDays = DisplayDay::where('display_board_id',$this->id)->where('merchant_board_id',$merchantBoard->id)->pluck('days')->toArray();
            if(count($merchantBoardDays) > 0){
                return $merchantBoardDays;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
        
    }

    public function getActiveDescriptionAttribute(){
        $businessid = Auth::user()->business_id;
        $merchantdata = MerchantDisplayBoard::where('display_board_id',$this->id)->where('business_id',$businessid)->first();
        if($merchantdata){
            return $merchantdata->description;
        }
        else{
            return '';
        }
    }

}
