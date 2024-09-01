<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $invoiceId = $this->route('invoice');

        return [
            'invoice_number' => [
                'required',
                'string',
                Rule::unique('invoices')->ignore($invoiceId),
            ],
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'client_id' => 'required|exists:clients,id',
            'invoiced_on' => 'required|date',
            'due_date' => 'required|date',
            'created_by' => 'required|exists:users,id',
            'show_shipping' => 'boolean',
            'billingto_id' => 'nullable|exists:addresses,id',
            'invoice_reference' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_status' => 'required|string',
            'recurring' => 'boolean',
            'show_on_pdf' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'invoice_number.required' => 'The invoice number is required.',
            'invoice_number.unique' => 'The invoice number must be unique.'
        ];
    }
}
