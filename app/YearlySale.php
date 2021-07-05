<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearlySale extends Model
{
    protected $fillable = [
    	'product', 'category', 'quantity_sold', 'year', 'yearly_sale', 'first_sale', 'last_sale', 'retailer_id',
    ];
}
