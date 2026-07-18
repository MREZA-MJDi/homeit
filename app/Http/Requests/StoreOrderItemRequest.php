<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [

            'order_id' => [
                'required',
                'exists:orders,id',
            ],

            'service_id' => [
                'required',
                'exists:services,id',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

        ];
    }
}
