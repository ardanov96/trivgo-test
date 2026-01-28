<div>
    <div class="mb-4 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Search customer name or phone..." 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            />
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="p-3">Customer</th>
                    <th class="p-3">Package</th>
                    <th class="p-3">Travel Date</th>
                    <th class="p-3">Total Price</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr class="border-b hover:bg-gray-50" wire:key="booking-{{ $booking->id }}">
                    <td class="p-3">
                        <div class="font-bold">{{ $booking->customer_name }}</div>
                        <div class="text-sm text-gray-500">{{ $booking->customer_phone }}</div>
                    </td>
                    <td class="p-3">{{ $booking->tourPackage->name }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                    <td class="p-3 font-semibold text-indigo-600">
                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                    </td>
                    <td class="p-3 text-center text-xs">
                        <span class="px-2 py-1 rounded-full font-semibold uppercase 
                            {{ $booking->status === 'confirmed' ? 'bg-green-100 text-green-700' : 
                            ($booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="p-3 flex justify-end space-x-3">
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        
                        {{-- Trigger Modal --}}
                        <button type="button" onclick="openModal('deleteModal-{{ $booking->id }}')" class="text-red-600 hover:text-red-900 font-medium cursor-pointer">
                            Delete
                        </button>
                    </td>
                </tr>

                {{-- Modal Delete Konfirmasi --}}
                <div id="deleteModal-{{ $booking->id }}" 
                    class="fixed inset-0 z-[9999] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center"
                    style="background-color: rgba(0, 0, 0, 0.5);"> {{-- Fallback warna --}}
                    
                    <div class="bg-white rounded-lg shadow-xl w-full max-w-md p-6 relative z-[10000]">
                        <h3 class="text-lg font-semibold text-gray-800">Delete Booking</h3>
                        <p class="mt-3 text-gray-600">Are you sure you want to delete booking for <strong>{{ $booking->customer_name }}</strong>?</p>
                        
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('deleteModal-{{ $booking->id }}')" 
                                    class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300 text-gray-700 transition">
                                Cancel
                            </button>
                            
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="inline-block">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition shadow-sm">
                                    Yes, Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</div>