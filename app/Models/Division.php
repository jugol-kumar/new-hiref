<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class Division extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function districts(){
        return $this->hasMany(District::class);
    }

}
