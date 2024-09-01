<?php

use App\Models\BusinessSetting;
use App\Models\Invoice;
use Carbon\Carbon;

if (!function_exists('generateInvoiceNumber')) {
    /**
     * Generate a unique invoice number.
     *
     * @return string
     */
    function generateInvoiceNumber($invoiceDate)
    {
        // Copy & paste has it was, will need a new logic to check company

        $company = BusinessSetting::first();
        if ($company->business_name == 'JMB Electrical (pty)LTD'){
            $lastInvoice = Invoice::orderBy('id', 'desc')->first();
            $startNumber = $lastInvoice ? (int) $lastInvoice->invoice_number : 10346;
            return $startNumber + 1;
        }else{
            $refCount = Invoice::get()->count() + 1;
            $companyPrefix = strtoupper($company->reference_prefix ?? '');
            $monthInvoiced = Carbon::parse($invoiceDate)->format('m');
            $yearInvoiced = Carbon::parse($invoiceDate)->format('y');
            $refPrefix = 'INV'.$companyPrefix.$monthInvoiced.$yearInvoiced;
            return sprintf($refPrefix .'%04d', $refCount);
        }
    }
}
