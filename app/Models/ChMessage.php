<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChMessage extends Model
{
    public function reciver(){
        return $this->belongsTo(User::class, 'to_id');
    }
}
