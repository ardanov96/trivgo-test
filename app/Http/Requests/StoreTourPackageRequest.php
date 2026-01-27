<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourPackageRequest extends FormRequest
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
        return [
            'name'          => 'required|string|max:255',
            'destination'       => 'required|string|max:255',
            'price'             => 'required|numeric|min:1', 
            'duration_days'     => 'required|integer|min:1',
            'description'       => 'nullable|string',
            'max_participants'  => 'required|integer|min:1',
            'image_url'         => 'nullable|url',
            'is_active'         => 'boolean',
        ];
    }
}
