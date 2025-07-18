<?php

namespace App\Http\Requests\Api\Order\Situation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|uuid|exists:orders',
            'responsable_id' => 'sometimes|nullable|uuid|exists:users,id',
            'description' => 'sometimes|nullable|string',
            
        ];
    }
}
