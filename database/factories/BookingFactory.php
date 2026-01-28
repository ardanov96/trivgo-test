<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\TourPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
   protected $model = Booking::class;

    public function definition(): array
    {
        $package = TourPackage::factory()->create();

        return [
            'tour_package_id' => $package->id,
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->safeEmail,
            'customer_phone' => $this->faker->phoneNumber,
            'booking_date' => now()->addDays(5),
            'number_of_participants' => 2,
            'total_price' => $package->price * 2,
            'status' => 'pending',
        ];
    }
}
