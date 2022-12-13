<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mocktest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'total_q',
        'duration',
        // 'categories',
        'user_id',
        'status',
    ];

    protected $casts = [
        // 'categories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sub_categories()
    {
        return $this->belongsToMany('App\Models\SubCategory')->withPivot('question')->withTimestamps();
    }
}
