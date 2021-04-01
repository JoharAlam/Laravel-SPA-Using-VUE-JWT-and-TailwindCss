<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    	'customer_name', 'total', 'received', 'receive_able', 'pay_able',
    ];
}
