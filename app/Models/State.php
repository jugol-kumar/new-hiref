<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $int)
 */
class State extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function cities(){
        return $this->hasMany(City::class, 'state_id');
    }




}
