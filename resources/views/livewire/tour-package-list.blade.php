<div>
    <div class="mb-10 flex justify-center">
        <div class="relative w-full max-w-xl">
            <input wire:model.live="search" type="text" 
                class="w-full pl-12 pr-4 py-3 rounded-full border-none shadow-lg focus:ring-2 focus:ring-blue-500" 
                placeholder="Mau liburan ke mana? (Cari destinasi atau nama paket...)">
            <div class="absolute left-4 top-3.5 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($packages as $package)
            <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300">
                <div class="relative h-56 bg-gray-200">
                    <img src="{{ $package->image_url ?? 'https://placehold.co/600x400?text='.$package->destination }}" 
                         alt="{{ $package->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-sm font-bold text-blue-600">
                        {{ $package->duration_days }} Hari
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <svg class="h-4 w-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ $package->destination }}
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $package->description }}</p>
                    
                    <div class="flex items-center justify-between mt-auto">
                        <div>
                            <span class="text-xs text-gray-400 block">Mulai dari</span>
                            <span class="text-xl font-extrabold text-blue-600">IDR {{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                            Detail Paket
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-500 text-lg">Maaf, paket tour yang Anda cari tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-12">
        {{ $packages->links() }}
    </div>
</div>