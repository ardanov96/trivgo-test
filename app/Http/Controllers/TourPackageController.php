<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTourPackageRequest;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::all();
        return view('tour-packages.index', compact('packages'));
    }

    public function create()
    {
        return view('tour-packages.create');
    }

    public function store(StoreTourPackageRequest $request)
    {
        TourPackage::create($request->validated());

        return redirect()->route('tour-packages.index')
            ->with('success', 'Paket tour berhasil ditambahkan!');
    }

    public function edit(TourPackage $tour_package)
    {
        return view('tour-packages.edit', compact('tour_package'));
    }

    public function update(Request $request, TourPackage $tour_package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'duration_days' => 'required|integer|min:1',
            'max_participants' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $tour_package->update($validated);

        return redirect()->route('tour-packages.index')->with('success', 'Package updated successfully!');
    }

    public function destroy(TourPackage $tour_package)
    {
        $tour_package->delete();

        return redirect()->route('tour-packages.index')->with('success', 'Package deleted successfully!');
    }
}
