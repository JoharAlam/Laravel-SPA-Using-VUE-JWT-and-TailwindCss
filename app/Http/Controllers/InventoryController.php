<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Purchase;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class InventoryController extends Controller
{
    public function sale()
    {
    	$sale = Sale::get();
        return response()->json($sale);
    }

    public function purchase()
    {
    	$purchase = Purchase::get();
        return response()->json($purchase);
    }
}
