<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; 
use App\Models\TourPackage;

class BookingController extends Controller
{
    public function index()
    {
        return view('bookings.index');
    }

    public function create() {
        $packages = TourPackage::where('is_active', true)->get();
        return view('bookings.create', compact('packages'));
    }

    public function store(Request $request) {
        $package = TourPackage::findOrFail($request->tour_package_id);
        
        $validated = $request->validate([
            'tour_package_id'        => 'required|exists:tour_packages,id',
            'customer_name'          => 'required|string|max:255',
            'customer_email'         => 'required|email',
            'customer_phone'         => 'required|string|max:20',
            'number_of_participants' => 'required|integer|min:1', 
            'booking_date'           => 'required|date|after_or_equal:today',
        ]);

        // Ambil data paket untuk menghitung harga
        $package = TourPackage::findOrFail($request->tour_package_id);

        // Hitung total harga otomatis menggunakan field yang benar
        $validated['total_price'] = $package->price * $request->number_of_participants;
        $validated['status'] = 'pending';

        Booking::create($validated);
        return redirect()->route('bookings.index')->with('success', 'Booking created!');
    }

    public function edit(Booking $booking)
    {
        $packages = TourPackage::where('is_active', true)->get();
        return view('bookings.edit', compact('booking', 'packages'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'tour_package_id'        => 'required|exists:tour_packages,id',
            'customer_name'          => 'required|string|max:255',
            'customer_email'         => 'required|email',
            'customer_phone'         => 'required|string|max:20',
            'number_of_participants' => 'required|integer|min:1', 
            'booking_date'           => 'required|date|after_or_equal:today',
            'status'                 => 'required|in:pending,confirmed,cancelled',
        ]);

        $package = TourPackage::findOrFail($request->tour_package_id);
        $validated['total_price'] = $package->price * $request->number_of_participants;

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete(); 
        return redirect()->route('bookings.index')->with('success', 'Booking deleted!');
    }
}
