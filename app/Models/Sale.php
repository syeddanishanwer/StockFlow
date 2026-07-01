<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
        protected $fillable=[
        'quantity',
        'unit_price',
        'total_price',        
        ];
}
