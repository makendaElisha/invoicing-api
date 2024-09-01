<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'client_type',
        'organization_name',
        'client_name',
        'client_last_name',
        'business_type',
        'service_rendered',
        'company_registration',
        'reference_prefix',
        'address_id',
        'cell_number',
        'telephone_number',
        'vat_number',
        'email',
        'website_url',
        'notes',
        'updated_at',
    ];
}
