<?php

namespace App\Livewire;

use App\Models\TourPackage;
use Livewire\Component;
use Livewire\WithPagination;

class TourPackageList extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    // Reset halaman jika search berubah
    public function updatingSearch() { $this->resetPage(); }

    public function toggleStatus($id)
    {
        $package = TourPackage::find($id);
        $package->is_active = !$package->is_active;
        $package->save();
    }

    public function deletePackage($id)
    {
        TourPackage::destroy($id);
        session()->flash('success', 'Package deleted successfully.');
    }

    public function render()
    {
        $packages = \App\Models\TourPackage::query()
            ->where('is_active', true)
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('destination', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(9); 

        return view('livewire.tour-package-list', [
            'packages' => $packages
        ]);
    }
}