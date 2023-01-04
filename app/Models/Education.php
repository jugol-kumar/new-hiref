<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, $id)
 */
class Education extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function eduLabel(){
        return $this->belongsTo(EducationLabel::class, 'education_label_id');
    }


}
