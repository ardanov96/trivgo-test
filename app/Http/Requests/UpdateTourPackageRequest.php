<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourPackageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => 'required|string|max:255',
            'destination'      => 'required|string|max:255',
            'price'            => 'required|numeric|gt:0', 
            'duration_days'    => 'required|integer|min:1', 
            'max_participants' => 'required|integer|gt:0', 
            'description'      => 'nullable|string',
            'is_active'        => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'price.gt'            => 'Tour package price must be greater than 0.',
            'duration_days.min'   => 'Duration days must be at least 1 day.',
            'max_participants.gt' => 'Maximum participants must be at least 1 person.',
        ];
    }
}