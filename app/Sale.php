<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
    	'customer_name', 'product', 'selling_rate', 'quantity', 'payment', 'category', 'retailer_id', 'sale_date',
    ];
}
