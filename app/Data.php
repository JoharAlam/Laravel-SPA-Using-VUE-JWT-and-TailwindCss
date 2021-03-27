<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
    	'year', 'name', 'price', 'yearly_sale',
    ];
}
