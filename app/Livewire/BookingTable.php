<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithPagination;

class BookingTable extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $query = Booking::with('tourPackage');

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->search !== '') {
            $query->where('customer_name', 'like', '%' . $this->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $this->search . '%');
        }

        return view('livewire.booking-table', [
            'bookings' => $query->latest()->paginate(10),
        ]);
    }
}
