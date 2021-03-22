<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;

class DataController extends Controller
{
    public function coins()
    {
    	$coins = Data::where('name','=','Bitcoin')->orderBy('year', 'ASC')->get();
    	return response()->json($coins);
    }
}
