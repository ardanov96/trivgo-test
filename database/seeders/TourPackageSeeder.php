<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TourPackageSeeder extends Seeder
{
    public function run(): void
    {
        $destinations = [
            'Bali', 'Yogyakarta', 'Lombok', 'Labuan Bajo', 'Bandung',
            'Malang', 'Bromo', 'Raja Ampat', 'Manado', 'Bukittinggi'
        ];

        $packages = [
            'Adventure Trip',
            'Family Holiday',
            'Romantic Escape',
            'Cultural Tour',
            'Nature Explorer',
            'Backpacker Package',
            'Luxury Getaway'
        ];

        $data = [];

        for ($i = 1; $i <= 50; $i++) {
            $destination = $destinations[array_rand($destinations)];
            $packageName = $packages[array_rand($packages)];

            $data[] = [
                'name' => $packageName . ' ' . $destination . ' #' . $i,
                'destination' => $destination,
                'price' => rand(1500000, 15000000),
                'duration_days' => rand(2, 10),
                'description' => 'Paket wisata ' . strtolower($packageName) . ' ke ' . $destination .
                    ' dengan itinerary menarik dan fasilitas lengkap.',
                'max_participants' => rand(5, 40),
                'image_url' => 'https://picsum.photos/seed/tour' . $i . '/600/400',
                'is_active' => rand(0, 1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('tour_packages')->insert($data);
    }
}
