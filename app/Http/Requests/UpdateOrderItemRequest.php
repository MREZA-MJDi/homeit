<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [

            'quantity' => [
                'sometimes',
                'integer',
                'min:1',
            ],

            'technician_note' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ];
    }
}
