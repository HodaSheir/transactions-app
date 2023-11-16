<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'transaction_id' => 'required|exists:transactions,id',
            'amount' => 'required',
            'paid_on' => 'required|date',
            'details' => 'sometimes|string',
        ];
    }
}
