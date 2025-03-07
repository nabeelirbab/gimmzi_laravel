<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderMessageBoard extends Model
{
    use HasFactory;
    protected $fillable = 
    [   'provider_id',
        'message_board_id',
        'start_date', 
        'end_date', 
        'display_board', 
        'message',
        'tenant_only', 
        'make_public',
        'status',
        'message_board_id2',
        'start_date2',
        'end_date2',
        'display_board2',
        'tenant_only2',
        'make_public2',
        'message2',
        'add_message_date2',
        'add_message_date',
        'provider_type',
        'travel_tourism_id'
    ];

    public function messageBoard(){
        return $this->belongsTo(MessageBoard::class, 'message_board_id', 'id');
    }

    public function messageBoardtwo(){
        return $this->belongsTo(MessageBoard::class, 'message_board_id2', 'id');
    }

    public function property(){
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function tavel(){
        return $this->belongsTo(TravelTourism::class, 'travel_tourism_id', 'id');
    }

}
