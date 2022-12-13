<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'instructor_id',
        'transaction_id',
        'payment_method',
        'total_amount',
        'coupon_discount',
        'pay_amount',
        'currency',
        'status',
        'duration',
        'enroll_start',
        'enroll_expire',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
}
