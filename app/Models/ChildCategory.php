<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory');
    }
}
