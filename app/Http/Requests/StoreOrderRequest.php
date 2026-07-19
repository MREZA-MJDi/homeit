<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [

            'address_id' => [
                'required',
                'exists:addresses,id',
            ],

            'requested_at' => [
                'required',
                'date',
                'after:now',
            ],

            'customer_note' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ];
    }
}
