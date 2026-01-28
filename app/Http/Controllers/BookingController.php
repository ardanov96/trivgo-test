<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBookingRequest; 
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking; 
use App\Models\TourPackage;
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

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

    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        $package = TourPackage::findOrFail($validated['tour_package_id']);
        $validated['total_price'] = $package->price * $validated['number_of_participants'];
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    public function edit(Booking $booking)
    {
        $packages = TourPackage::where('is_active', true)->get();
        return view('bookings.edit', compact('booking', 'packages'));
    }

    public function update(UpdateBookingRequest $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validated();

        // Hitung ulang total harga jika paket atau jumlah peserta berubah
        $package = TourPackage::find($validated['tour_package_id']);
        $validated['total_price'] = $package->price * $validated['number_of_participants'];

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete(); 
        return redirect()->route('bookings.index')->with('success', 'Booking deleted!');
    }
}
