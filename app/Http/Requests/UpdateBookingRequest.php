<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'tour_package_id'        => 'required|exists:tour_packages,id',
            'customer_name'          => 'required|string|max:255',
            'customer_email'         => 'required|email',
            'customer_phone'         => 'required|string|max:20',
            'number_of_participants' => 'required|integer|min:1',
            'booking_date'           => 'required|date',
        ];

        // Jika sedang Create (POST), tambahkan validasi tanggal minimal hari ini
        if ($this->isMethod('post')) {
            $rules['booking_date'] .= '|after_or_equal:today';
        }

        // Jika sedang Update (PUT/PATCH), tambahkan validasi status
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        }

        return $rules;  
    }
}
