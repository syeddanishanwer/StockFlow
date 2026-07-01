<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
         protected $fillable = [
        'sale_date',
        'total_amount',        
    ];
}

