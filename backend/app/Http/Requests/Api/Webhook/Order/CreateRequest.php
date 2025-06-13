<?php

namespace App\Http\Requests\Api\Webhook\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'state' => ['required', 'string', Rule::in(['create'])],
            'orderCode' => 'required|integer|unique:orders,code',
        ];
    }
}
