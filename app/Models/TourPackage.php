<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class TourPackage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'destination',
        'price',
        'duration_days',
        'description',
        'max_participants',
        'image_url',
        'is_active',
    ];
}
