<?php

namespace App\Http\Requests\Api\Webhook\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state' => 'required|string',
            'orderCode' => 'required|integer',
        ];
    }
}
