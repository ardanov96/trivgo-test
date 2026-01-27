<?php

namespace App\Livewire;

use App\Models\TourPackage;
use Livewire\Component;
use Livewire\WithPagination;

class TourPackageTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = ''; 

    // Reset pagination saat filter atau search berubah
    public function updatingSearch() { $this->resetPage(); }
    public function updatingFilterStatus() { $this->resetPage(); }

    public function render()
    {
        // Query Dasar
        $query = TourPackage::query();

        // Logika Filter Status
        if ($this->filterStatus !== '') {
            $query->where('is_active', $this->filterStatus);
        }

        // Logika Search
        if ($this->search !== '') {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('destination', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.tour-package-table', [
            'packages' => $query->latest()->paginate(10),
        ]);
    }
}
