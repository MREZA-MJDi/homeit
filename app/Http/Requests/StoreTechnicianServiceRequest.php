<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTechnicianServiceRequest extends FormRequest
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

            'service_id' => [
                'required',
                'exists:services,id'
            ],

            'custom_price' => [
                'nullable',
                'integer',
                'min:0'
            ],

            'estimated_duration' => [
                'nullable',
                'integer',
                'min:10'
            ],

            'experience_years' => [
                'nullable',
                'integer',
                'between:0,60'
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'is_active' => [
                'boolean'
            ],

        ];
    }
}
