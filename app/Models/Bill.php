<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'sale_date',
        'total_amount',
        'user_id',        
    ];

    // Relationship: Bill belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: A bill can have many sales
    public function sales()
    {
        return $this->hasMany(Sale::class, 'sale_id');
    }
}