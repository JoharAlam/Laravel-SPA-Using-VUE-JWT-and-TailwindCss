<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlySale extends Model
{
    protected $fillable = [
    	'name', 'year', 'month', 'sale',
    ];
}
