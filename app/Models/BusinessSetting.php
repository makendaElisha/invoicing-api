<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'branding_id',
        'business_name',
        'description',
        'industry',
        'contact_person_name',
        'contact_person_role',
        'reference_prefix',
        'company_registration',
        'rendering_service',
        'vat_number',
        'cell_number',
        'telephone_number',
        'email',
        'website_url',
        'notes',
        'banking_details_id',
        'custom_fields'
    ];
}
