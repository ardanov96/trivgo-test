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
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $package)
                <tr class="border-b hover:bg-gray-50" wire:key="package-row-{{ $package->id }}">
                    <td class="p-3">{{ $package->name }}</td>
                    <td class="p-3">{{ $package->destination }}</td>
                    <td class="p-3 font-semibold">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                    <td class="p-3 text-center">
                        @livewire('tour-package-toggle', ['package' => $package], key('toggle-'.$package->id))
                    </td>
                    <td class="p-3 flex justify-end space-x-3">
                        <a href="{{ route('tour-packages.edit', $package->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        <button type="button" onclick="openModal('deleteModal-{{ $package->id }}')" class="text-red-600 hover:text-red-900 font-medium">
                            Delete
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">No packages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @foreach ($packages as $package)
            <div id="deleteModal-{{ $package->id }}" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    {{-- Overlay Hitam --}}
                    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="closeModal('deleteModal-{{ $package->id }}')"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    {{-- Konten Modal --}}
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-medium text-gray-900">Delete Tour Package</h3>
                            <p class="mt-2 text-sm text-gray-500">Are you sure you want to delete <strong>{{ $package->name }}</strong>? This action cannot be undone.</p>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-x-reverse space-x-3">
                            <form action="{{ route('tour-packages.destroy', $package->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                    Yes, Delete
                                </button>
                            </form>
                            <button type="button" onclick="closeModal('deleteModal-{{ $package->id }}')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $packages->links() }} {{-- Navigasi Pagination --}}
        </div>
    </div>
</div>