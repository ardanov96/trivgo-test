<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use RefreshDatabase; 

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();    
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_display_booking_index_page()
    {
        $response = $this->get(route('bookings.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_show_create_page_with_active_packages()
    {
        $activePackage = TourPackage::factory()->create(['is_active' => true]);
        $inactivePackage = TourPackage::factory()->create(['is_active' => false]);

        $response = $this->get(route('bookings.create'));

        $response->assertStatus(200);
        $response->assertViewHas('packages');
        
        // Memastikan hanya paket aktif yang dikirim ke view
        $packages = $response->original->getData()['packages'];
        $this->assertTrue($packages->contains($activePackage));
        $this->assertFalse($packages->contains($inactivePackage));
    }

    /** @test */
    public function it_can_store_a_new_booking_and_calculates_total_price()
    {
        $package = TourPackage::factory()->create(['price' => 500000]);
        $data = [
            'tour_package_id' => $package->id,
            'number_of_participants' => 3,
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',   
            'customer_phone' => '08123456789',       
            'booking_date' => now()->addDays(7)->format('Y-m-d'),
        ];

        $response = $this->post(route('bookings.store'), $data);

        $response->assertRedirect(route('bookings.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bookings', [
            'tour_package_id' => $package->id,
            'number_of_participants' => 3,
            'total_price' => 1500000,
            'status' => 'pending',
        ]);
    }

    /** @test */
    public function it_recalculates_total_price_on_update()
    {
        $oldPackage = TourPackage::factory()->create(['price' => 100000]);
        $newPackage = TourPackage::factory()->create(['price' => 200000]);
        
        $booking = Booking::factory()->create([
            'tour_package_id' => $oldPackage->id,
            'number_of_participants' => 2,
            'total_price' => 200000
        ]);

        $updateData = [
            'tour_package_id' => $newPackage->id,
            'number_of_participants' => 5,
        ];

        $response = $this->put(route('bookings.update', $booking), $updateData);

        $response->assertRedirect(route('bookings.index'));
        
        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'tour_package_id' => $newPackage->id,
            'number_of_participants' => 5,
            'total_price' => 1000000, // 200.000 * 5
        ]);
    }

    /** @test */
    public function it_can_delete_a_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->delete(route('bookings.destroy', $booking));

        $response->assertRedirect(route('bookings.index'));
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}   