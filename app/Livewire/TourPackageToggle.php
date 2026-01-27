<?php

namespace App\Livewire;

use App\Models\TourPackage;
use Livewire\Component;

class TourPackageToggle extends Component
{
    public TourPackage $package;
    public bool $isActive;

    public function mount(TourPackage $package)
    {
        $this->package = $package;
        $this->isActive = (bool) $package->is_active;
    }

    public function toggleStatus()
    {
        $this->isActive = !$this->isActive;
        $this->package->update(['is_active' => $this->isActive]);
        
        session()->flash('message', 'Status updated successfully.');
    }

    public function render()
    {
        return view('livewire.tour-package-toggle');
    }
}
