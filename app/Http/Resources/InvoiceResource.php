<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'invoice_number' => $this->invoice_number,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->total,
            'discount' => $this->discount,
            'client_id' => $this->client_id,
            'invoiced_on' => $this->invoiced_on,
            'due_date' => $this->due_date,
            'created_by' => $this->created_by,
            'show_shipping' => $this->show_shipping,
            'billingto_id' => $this->billingto_id,
            'invoice_reference' => $this->invoice_reference,
            'notes' => $this->notes,
            'payment_status' => $this->payment_status,
            'recurring' => $this->recurring,
            'show_on_pdf' => $this->show_on_pdf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
