<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TroubleTicket extends Model
{
    use HasFactory;
    protected $table='trouble_tickets';
    protected $fillable = ['user_id','subject','issue','is_mail_sent','is_closed','closed_on'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
