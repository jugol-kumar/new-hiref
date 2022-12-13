<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 */
class District extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function upozilas(){
        return $this->hasMany(Upazila::class);
    }

}
