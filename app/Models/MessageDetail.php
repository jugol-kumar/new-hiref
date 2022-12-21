<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDetail extends Model
{
    use HasFactory;
    protected $table = 'message_details';

    protected $guarded = ['id'];



    public function recruter(){
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    public function seeker(){
        return $this->belongsTo(User::class, 'seeker_id');
    }


}
