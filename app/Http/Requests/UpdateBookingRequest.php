<?php

namespace App\Http\Requests;

use App\Models\TourPackage;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
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
                    if ($package && $package->price <= 0) {
                        $fail('The selected tour package has an invalid price.');
                    }
                },
            ],
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email:rfc,dns',
            'customer_phone' => [
                'required',
                'string',
                'regex:/^(?:\+62|62|0)8[1-9][0-9]{7,10}$/'
            ],
            'number_of_participants' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $package = TourPackage::find($this->tour_package_id);
                    if ($package && $value > $package->max_participants) {
                        $fail("Participants exceed the package limit of {$package->max_participants} people.");
                    }
                },
            ],
            'booking_date' => 'required|date', // Dilepas 'after_or_equal' agar data lama tetap valid saat diedit
            'status'       => 'required|in:pending,confirmed,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_phone.regex' => 'Use a valid Indonesian phone number (e.g., 0812...).',
            'status.in'            => 'Status must be pending, confirmed, or cancelled.',
        ];
    }
}