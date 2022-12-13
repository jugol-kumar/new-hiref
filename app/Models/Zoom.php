<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'owner_id',
        'start_time',
        'zoom_url',
        'user_id',
        'meeting_title',
        'course_id',
        'link_by',
        'type',
        'agenda',
        'photo'
    ];
}
