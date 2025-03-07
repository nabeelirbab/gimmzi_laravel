<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GimmziSendReport extends Model
{
    use HasFactory;
    protected $fillable = ['report_id', 'send_to_user','report_doc','user_email','report_send_date','is_send'];

}
