<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(int $id)
 */
class EducationLabel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function educations(){
        return $this->hasMany(Education::class);
    }


}
