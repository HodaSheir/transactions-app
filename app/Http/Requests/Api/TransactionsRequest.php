<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'amount' => 'required',
            'customer_id' => 'required',
            'due_on' => 'required|date',
            'vat' => 'required|numeric',
            'is_vat_inclusive' => 'required|boolean',
        ];
    }
}
