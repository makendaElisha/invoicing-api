<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, Auditable;

    protected $fillable = [
        'invoice_number',
        'subtotal',
        'tax',
        'total',
        'discount',
        'client_id',
        'invoiced_on',
        'due_date',
        'created_by',
        'updated_by',
        'show_shipping',
        'billingto_id',
        'invoice_reference',
        'notes',
        'payment_status',
        'recurring',
        'show_on_pdf'
    ];
}
