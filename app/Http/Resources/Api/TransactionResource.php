<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'vat' => $this->vat,
            'status' => $this->status,
            'due_on' => $this->due_on,
            'added_by' => $this->addedBy->name,
            'customer' => $this->customer->name,
            'payment' => $this->payments,
        ];
    }
}
