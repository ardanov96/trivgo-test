<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTourPackageRequest;
use App\Http\Requests\UpdateTourPackageRequest;
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

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

    public function update(UpdateTourPackageRequest $request, TourPackage $tour_package): RedirectResponse
    {
        // Validasi sudah ditangani oleh UpdateTourPackageRequest
        $tour_package->update($request->validated());

        return redirect()->route('tour-packages.index')
            ->with('success', 'Package updated successfully!');
    }

    public function destroy(TourPackage $tour_package)
    {
        $tour_package->delete();

        return redirect()->route('tour-packages.index')->with('success', 'Package deleted successfully!');
    }
}
