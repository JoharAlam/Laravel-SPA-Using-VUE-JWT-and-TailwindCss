<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $fillable = [
    	'retailer_name', 'total', 'paid', 'receive_able', 'pay_able',
    ];
}
