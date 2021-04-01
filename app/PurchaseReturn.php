<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    protected $fillable = [
    	'retailer_name', 'product', 'category', 'quantity', 'amount', 'status', 'purchase_id', 'retailer_id',
    ];
}
