<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
    	'retailer_name', 'product', 'purchase_rate', 'quantity', 'payment', 'category', 'purchase_date',
    ];
}
