<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'sub_category_id',
        'child_category_id',
        'a',
        'b',
        'c',
        'd',
        'e',
        'answer',
        'feedback',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }

    public function child_category()
    {
        return $this->belongsTo('App\Models\ChildCategory');
    }
}
