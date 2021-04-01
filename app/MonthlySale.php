<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlySale extends Model
{
    protected $fillable = [
    	'product', 'category', 'quantity_sold', 'year', 'month', 'monthly_sale', 'first_sale', 'last_sale', 'retailer_id',
    ];
}
