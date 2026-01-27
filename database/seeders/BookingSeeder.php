<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID tour package yang sudah ada
        $tourPackageIds = DB::table('tour_packages')->pluck('id')->toArray();

        if (empty($tourPackageIds)) {
            $this->command->warn('Seeder bookings dibatalkan: tour_packages kosong.');
            return;
        }

        $statuses = ['pending', 'confirmed', 'cancelled'];

        $names = [
            'Budi Santoso', 'Andi Wijaya', 'Siti Aminah', 'Dewi Lestari',
            'Rizky Pratama', 'Agus Setiawan', 'Putri Maharani',
            'Fajar Nugroho', 'Rina Wulandari', 'Hendra Saputra'
        ];

        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $tourPackageId = $tourPackageIds[array_rand($tourPackageIds)];
            $participants = rand(1, 8);

            // Ambil harga paket untuk hitung total
            $price = DB::table('tour_packages')
                ->where('id', $tourPackageId)
                ->value('price');

            $data[] = [
                'tour_package_id' => $tourPackageId,
                'customer_name' => $names[array_rand($names)],
                'customer_email' => 'customer' . $i . '@mail.com',
                'customer_phone' => '08' . rand(1111111111, 9999999999),
                'booking_date' => Carbon::now()->subDays(rand(0, 30)),
                'number_of_participants' => $participants,
                'total_price' => $price * $participants,
                'status' => $statuses[array_rand($statuses)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('bookings')->insert($data);
    }
}
