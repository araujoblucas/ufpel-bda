<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'owner_id',
        'is_active',
        'quantity',
        'quantity_available',
        'other_information',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at',
    ];
}
