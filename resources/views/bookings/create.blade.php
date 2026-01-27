<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="tour_package_id" :value="__('Select Package')" />
                            <select name="tour_package_id" id="tour_package_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Choose Package --</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('tour_package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tour_package_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="customer_name" :value="__('Customer Name')" />
                            <x-text-input id="customer_name" name="customer_name" type="text" class="mt-1 block w-full" :value="old('customer_name')" required />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="customer_email" :value="__('Customer Email')" />
                            <x-text-input id="customer_email" name="customer_email" type="email" class="mt-1 block w-full" :value="old('customer_email')" required />
                            <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="customer_phone" :value="__('Customer Phone')" />
                            <x-text-input id="customer_phone" name="customer_phone" type="text" class="mt-1 block w-full" :value="old('customer_phone')" required />
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="number_of_participants" :value="__('Number of Participants')" />
                            <x-text-input id="number_of_participants" name="number_of_participants" type="number" class="mt-1 block w-full" :value="old('number_of_participants')" min="1" required />
                            <x-input-error :messages="$errors->get('number_of_participants')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="booking_date" :value="__('Travel Date')" />
                            <x-text-input id="booking_date" name="booking_date" type="date" class="mt-1 block w-full" :value="old('booking_date')" required />
                            <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button type="button" onclick="history.back()" class="mr-3">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Confirm Booking') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>