<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantDisplayBoard extends Model
{
    use HasFactory;
    protected $fillable = ['display_board_id ', 'description', 'change_by', 'business_id', 'location_id', 'start_date', 'end_date', 'add_message_date', 'display_board_id2', 'description2', 'start_date2', 'end_date2', 'add_message_date2','status'];
    protected $appends = ['board_one_title', 'board_two_title'];

    public function boardone(){
        return $this->belongsTo(DisplayBoard::class,'display_board_id','id');
    }

    public function boardtwo(){
        return $this->belongsTo(DisplayBoard::class,'display_board_id2','id');
    }

    public function days(){
        return $this->hasMany(DisplayDay::class);
    }

    // public function boardtwo(){
    //     return $this->belongsTo(DisplayBoard::class,'display_board_id2','id');
    // }

    public function business(){
        return $this->belongsTo(BusinessProfile::class,'business_id','id');
    }

    public function location(){
        return $this->belongsTo(BusinessLocation::class,'location_id','id');
    }

    public function getBoardOneTitleAttribute(){
        if($this->display_board_id != null){
            $boardOne = DisplayBoard::where('id', $this->display_board_id)->first();
            if($boardOne){
                $title = $boardOne->title;
                return $title;
            }else{
                return null;
            }
        }
    }

    public function getBoardTwoTitleAttribute(){
        if($this->display_board_id2 != null){
            $boardTwo = DisplayBoard::where('id', $this->display_board_id2)->first();
            if($boardTwo){
                $title = $boardTwo->title;
                return $title;
            }else{
                return null;
            }
        }
    }
}
