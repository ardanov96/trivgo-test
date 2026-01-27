<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tour_package_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'booking_date',
        'number_of_participants',
        'total_price',
        'status',
    ];
}
