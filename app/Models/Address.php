<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line1',
        'address_line2',
        'postal_code',
        'city',
        'province',
        'country'
    ];

    public function businessSettings()
    {
        return $this->hasOne(BusinessSetting::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
