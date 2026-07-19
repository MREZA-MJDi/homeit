<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [

            'assigned_technician_id' => [
                'nullable',
                'exists:users,id',
            ],

            'status' => [
                'sometimes',
                'string',
                'max:50',
            ],

            'payment_status' => [
                'sometimes',
                'string',
                'max:50',
            ],

            'cancel_reason' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'customer_note' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ];
    }
}
