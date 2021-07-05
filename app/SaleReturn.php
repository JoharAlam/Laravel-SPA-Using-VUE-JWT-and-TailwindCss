<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    protected $fillable = [
    	'customer_name', 'product', 'category', 'quantity', 'amount', 'status', 'sale_id', 'retailer_id', 'customer_id',
    ];
}
