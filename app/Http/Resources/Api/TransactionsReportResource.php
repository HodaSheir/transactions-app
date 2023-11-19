<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'month' => $this->month,
            'year' => $this->year,
            'paid' => $this->paid,
            'outstanding' => $this->outstanding,
            'overdue' => $this->overdue,
        ];
    }
}
