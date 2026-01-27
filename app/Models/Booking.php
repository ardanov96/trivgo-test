<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Relasi ke TourPackage (Setiap booking memiliki satu paket tur)
     */
    public function tourPackage(): BelongsTo
    {
        return $this->belongsTo(TourPackage::class);
    }
}
