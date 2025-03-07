<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyNote extends Model
{
    use HasFactory;
    protected $fillable = ['note','prospective_id','action_taken','user_id','notify_user'];

    public function prospectiveApartment()
    {
        return $this->belongsTo(ProspectiveAppartmentList::class, 'prospective_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
