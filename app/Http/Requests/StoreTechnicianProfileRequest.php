<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTechnicianProfileRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['nullable', 'image', 'max:2048'],

            'bio' => ['nullable', 'string', 'max:1000'],

            'national_code' => [
                'nullable',
                'string',
                'size:10',
                'unique:technician_profiles,national_code'
            ],

            'iban' => [
                'nullable',
                'string',
                'max:34',
                'unique:technician_profiles,iban'
            ],

            'is_available' => ['boolean'],

            'vacation_until' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }
}
