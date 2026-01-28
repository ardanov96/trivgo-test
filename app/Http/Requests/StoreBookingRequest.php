<?php

namespace App\Http\Requests;

use App\Models\TourPackage;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_package_id' => [
                'required',
                'exists:tour_packages,id',
                function ($attribute, $value, $fail) {
                    $package = TourPackage::find($value);
                    if ($package) {
                        // Kriteria: Tour package price must be > 0
                        if ($package->price <= 0) {
                            $fail('The selected tour package is not available (invalid price).');
                        }
                        // Kriteria: Duration days must be >= 1
                        if ($package->duration_days < 1) {
                            $fail('The selected tour package is not available (invalid duration).');
                        }
                    }
                },
            ],
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email:rfc,dns', // Kriteria: Email format validation
            'customer_phone' => [
                'required',
                'string',
                'regex:/^(?:\+62|62|0)8[1-9][0-9]{7,10}$/' // Kriteria: Phone number (Indonesia format)
            ],
            'number_of_participants' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $package = TourPackage::find($this->tour_package_id);
                    // Kriteria: Booking participants cannot exceed max_participants
                    if ($package && $value > $package->max_participants) {
                        $fail("The number of participants exceeds the maximum allowed for this package ({$package->max_participants} people).");
                    }
                },
            ],
            'booking_date' => 'required|date|after_or_equal:today', // Kriteria: Cannot be in the past
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'customer_phone.regex' => 'The phone number format is invalid. Please use a valid Indonesian number (e.g., 0812...).',
            'booking_date.after_or_equal' => 'The booking date cannot be in the past.',
        ];
    }
}