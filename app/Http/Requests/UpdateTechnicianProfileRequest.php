<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnicianProfileRequest extends FormRequest
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

            'avatar' => ['nullable','image','max:2048'],

            'bio' => ['nullable','string','max:1000'],

            'national_code' => [

                'nullable',

                'string',

                'size:10',

                Rule::unique('technician_profiles')
                    ->ignore($this->technician_profile),

            ],

            'iban' => [

                'nullable',

                'string',

                'max:34',

                Rule::unique('technician_profiles')
                    ->ignore($this->technician_profile),

            ],

            'is_available' => ['boolean'],

            'vacation_until' => ['nullable','date'],
        ];
    }
}
