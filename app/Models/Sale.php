<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'quantity',
        'unit_price',
        'total_price',
        'sale_id',
        'product_id',        
    ];

    // Relationship: Sale belongs to a bill
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'sale_id');
    }

    // Relationship: Sale belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}