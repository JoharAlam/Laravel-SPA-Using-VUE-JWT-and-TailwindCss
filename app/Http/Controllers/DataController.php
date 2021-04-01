<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\MonthlySale;

class DataController extends Controller
{
    public function shoes()
    {
    	$shoes = Data::where('name','=','Shoes')->orderBy('year', 'ASC')->get();
    	return response()->json($shoes);
    }

    public function garments()
    {
    	$garments = Data::where('name','=','Garments')->orderBy('year', 'ASC')->get();
    	return response()->json($garments);
    }

    public function monthlySaleShoes()
    {
        $shoes = MonthlySale::where('name','=','Shoes')->where('year', '=', '2021')->get();
        return response()->json($shoes);
    }

    public function monthlySaleGarments()
    {
        $shoes = MonthlySale::where('name','=','Garments')->where('year', '=', '2021')->get();
        return response()->json($shoes);
    }
}
