<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
    	'retailer', 'product', 'purchase_rate',
    ];
}
