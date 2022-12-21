<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageInfo extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function recruiter(){
        return $this->belongsTo(Recruiter::class, 'recruiter_id');
    }

    public function seeker(){
        return $this->belongsTo(SeekerProfile::class, 'seeker_id');
    }


}
