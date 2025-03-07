<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneratedReport extends Model
{
    use HasFactory;
    protected $fillable = ['is_request_end', 'property_id','travel_tourism_id','type_id','request_as','from_date','to_date','send_on','business_id','generated_by'];

    public function consumer(){
        return $this->belongsTo(User::class,'generated_by','id');
    }

    public function reporttype(){
        return $this->belongsTo(ReportType::class,'type_id','id');
    }
}
