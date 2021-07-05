<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;
use App\Sale;
use App\Purchase;
use App\MonthlySale;
use App\YearlySale;
use App\Stock;
Use \Carbon\Carbon;

class DataController extends Controller
{
    public function sale()
    {
    	$purchase = Purchase::get();
    	return response()->json($purchase);
    }

    public function yearlySale()
    {
        $date = Carbon::now();

        $yearly_sale = YearlySale::where('year', '=', $date->year)->get();
        return response()->json($yearly_sale);
    }

    public function monthlySale()
    {
        $date = Carbon::now();
        $dateObj   = Carbon::createFromFormat('!m', $date->month);
        $month = $dateObj->format('F');

        $monthly_sale = MonthlySale::where('month', '=', $month)->where('year', '=', $date->year)->get();
        return response()->json($monthly_sale);
    }

    public function stock()
    {
        $stock = Stock::get();
        return response()->json($stock);
    }

    public function monthly()
    {
        $monthly = MonthlySale::get();
        return response()->json($monthly);
    }

    public function yearly()
    {
        $yearly = YearlySale::get();
        return response()->json($yearly);
    }
}
