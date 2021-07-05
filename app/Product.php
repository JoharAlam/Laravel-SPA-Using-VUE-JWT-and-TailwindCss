<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'product', 'category', 'description', 'quality', 'latest_price', 'image', 'retailer_id',
    ];
}
