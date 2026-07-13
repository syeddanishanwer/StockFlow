<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'price',
        'quantity',
        'status',
        'category_id',
        'supplier_id',            
    ];

    // Relationship: Product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: Product belongs to a supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relationship: Product can be in many sales
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}