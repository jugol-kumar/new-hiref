<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static updateOrCreate(array $array)
 * @method static where(string $string, int|string|null $id)
 */
class SeekerProfile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $dates = [
        'end_date',
        'start_date',
        'uni_end_date',
        'uni_start_date'
    ];


    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_id');
    }

    public function education_level(){
        return $this->belongsTo(EducationLabel::class, 'education_label_id');
    }

    public function educaiton(){
        return $this->belongsTo(Education::class, 'education_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }


}
