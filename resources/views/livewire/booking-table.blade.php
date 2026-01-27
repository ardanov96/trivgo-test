<div>
    <div class="mb-4 flex flex-col md:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search customer..." class="flex-1 rounded-md border-gray-300 shadow-sm" />
        
        <select wire:model.live="filterStatus" class="w-full md:w-48 rounded-md border-gray-300 shadow-sm">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
        </select>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">Customer</th>
                    <th class="p-3">Package</th>
                    <th class="p-3">Pax</th>
                    <th class="p-3">Total Price</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        <div class="font-bold">{{ $booking->customer_name }}</div>
                        <div class="text-xs text-gray-500">{{ $booking->customer_email }}</div>
                    </td>
                    <td class="p-3">{{ $booking->tourPackage->name }}</td>
                    <td class="p-3">{{ $booking->number_of_people }}</td>
                    <td class="p-3 font-semibold text-indigo-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-full text-xs font-bold uppercase 
                            {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-700' : 
                               ($booking->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ $booking->status }}
                        </span>
                    </td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('bookings.edit', $booking->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Delete this booking?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-3 text-center text-gray-500">No bookings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</div>