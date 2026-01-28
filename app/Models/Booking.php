<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;

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
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class)->withDefault([
            'name' => 'N/A' // Nama default jika data paket tidak ditemukan
        ]);
    }
    
    
}
