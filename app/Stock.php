<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
    	'product', 'category', 'total', 'available', 'returned', 'price', 'earned', 'profit', 'loss', 'status', 'retailer_id', 'first_purchase', 'purchase_updated',
    ];
}
