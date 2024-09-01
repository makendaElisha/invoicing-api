<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
        'description',
        'price',
        'unit_name',
        'created_at',
        'updated_at'
    ];
}
