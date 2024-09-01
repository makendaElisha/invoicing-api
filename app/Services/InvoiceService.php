<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Billingto;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendInvoiceMail;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\Log;

class InvoiceService
{
    public function create($data)
    {
        // Create the invoice
        $invoice = Invoice::create([
            'invoice_number' => $this->generateInvoiceNumber($data->invoiced_on),
            'client_id' => $data->client_id,
            'invoiced_on' => $data->invoiced_on,
            'due_date' => $data->due_date,
            'subtotal' => $data->amountSubTotal,
            'tax' => $data->amountVat,
            'total' => $data->amountTotal,
            'discount' => $data->discount ?? null,
            'show_shipping' => $data->ship_to,
            'billingto_id' => $data->ship_to_id,
            'show_on_pdf' => $data->show_custom_field,
        ]);

        // Create invoice items
        foreach ($data->inputs as $item) {
            InvoiceItem::create([
                'item_name' => $item['item_name'],
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['total_price'],
                'invoice_id' => $invoice->id,
            ]);
        }

        return $invoice;
    }

    protected function generateInvoiceNumber($invoice_date)
    {
        $company = BusinessSetting::first();
        if ($company->business_name == 'JMB Electrical (pty)LTD') {
            $lastInvoice = Invoice::orderBy('id', 'desc')->first();
            $startNumber = $lastInvoice ? (int)$lastInvoice->invoice_number : 10346;
            return $startNumber + 1;
        } else {
            $companyPrefix = strtoupper($company->reference_prefix ?? '');
            $month_invoiced = Carbon::parse($invoice_date)->format('m');
            $year_invoiced = Carbon::parse($invoice_date)->format('y');
            $refPrefix = 'INV'.$companyPrefix.$month_invoiced.$year_invoiced;
            $refCount = Invoice::count() + 1;
            return sprintf($refPrefix .'%04d', $refCount);
        }
    }

    protected function sendInvoiceEmail($invoice)
    {
        // $client = Client::findOrFail($invoice->client_id);
        // try {
        //     Mail::to($client->email)->send(new SendInvoiceMail($invoice->id, $client));
        // } catch (\Exception $e) {
        //     Log::error('Failed to send invoice email: '.$e->getMessage());
        // }
    }
}
