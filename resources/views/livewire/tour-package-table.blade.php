<div>
    <div class="mb-4 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Search packages or destinations..." 
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            />
        </div>

        <div class="w-full md:w-48">
            <select 
                wire:model.live="filterStatus"
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            >
                <option value="">All Status</option>
                <option value="1">Active Only</option>
                <option value="0">Inactive Only</option>
            </select>
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b">
                    <th class="p-3">Name</th>
                    <th class="p-3">Destination</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $package)
                <tr class="border-b hover:bg-gray-50" wire:key="package-{{ $package->id }}">
                    <td class="p-3">{{ $package->name }}</td>
                    <td class="p-3">{{ $package->destination }}</td>
                    <td class="p-3">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                    <td class="p-3">
                        @livewire('tour-package-toggle', ['package' => $package], key('toggle-'.$package->id))
                    </td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('tour-packages.edit', $package->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        
                        <button onclick="openModal('deleteModal-{{ $package->id }}')" class="text-red-600 hover:text-red-900 font-medium">
                            Delete
                        </button>
                    </td>
                </tr>

                <div id="deleteModal-{{ $package->id }}" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800">Delete Tour Package</h3>
                        <p class="mt-3 text-gray-600">Are you sure you want to delete <strong>{{ $package->name }}</strong>?</p>
                        <div class="mt-6 flex justify-end space-x-3">
                            <button onclick="closeModal('deleteModal-{{ $package->id }}')" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</button>
                            <form action="{{ route('tour-packages.destroy', $package->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">No packages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $packages->links() }} {{-- Navigasi Pagination --}}
        </div>
    </div>
</div>