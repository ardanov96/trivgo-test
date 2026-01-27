<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tour Package') }}: {{ $tour_package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('tour-packages.update', $tour_package->id) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- PENTING: Untuk Update --}}
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Package Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $tour_package->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="destination" :value="__('Destination')" />
                            <x-text-input id="destination" name="destination" type="text" class="mt-1 block w-full" :value="old('destination', $tour_package->destination)" required />
                            <x-input-error :messages="$errors->get('destination')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price (IDR)')" />
                            <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price', $tour_package->price)" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="duration_days" :value="__('Duration (Days)')" />
                            <x-text-input id="duration_days" name="duration_days" type="number" class="mt-1 block w-full" :value="old('duration_days', $tour_package->duration_days)" required />
                            <x-input-error :messages="$errors->get('duration_days')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="max_participants" :value="__('Max Participants')" />
                            <x-text-input id="max_participants" name="max_participants" type="number" class="mt-1 block w-full" :value="old('max_participants', $tour_package->max_participants)" required />
                            <x-input-error :messages="$errors->get('max_participants')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="is_active" :value="__('Status Active')" />
                            <select name="is_active" id="is_active" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="1" {{ $tour_package->is_active ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$tour_package->is_active ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $tour_package->description) }}</textarea>
                    </div>

                    <div class="mt-4 text-right">
                        <x-secondary-button type="button" onclick="history.back()" class="mr-2">Cancel</x-secondary-button>
                        <x-primary-button>Update Package</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>