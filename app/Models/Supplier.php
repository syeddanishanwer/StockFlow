<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'phone',
        'address',           
        'status',
    ];

    // Relationship: A supplier can have many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}