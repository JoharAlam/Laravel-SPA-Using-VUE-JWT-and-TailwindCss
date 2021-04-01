<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Purchase;
use App\Product;
use App\Stock;
use App\YearlySale;
use App\MonthlySale;
use App\SaleReturn;
use App\PurchaseReturn;
use App\Customer;
use App\Retailer;
Use \Carbon\Carbon;
use Illuminate\Http\Request;

class ProductReturnController extends Controller
{
    public function retrnedSalesDetail()
    {
    	$saleReturn = SaleReturn::get();
        return response()->json($saleReturn);
    }

    public function retrnedPurchaseDetail()
    {
    	$purchaseReturn = PurchaseReturn::get();
        return response()->json($purchaseReturn);
    }

    public function payBack(Request $request)
    {
    	$sale = Sale::find($request->id);

    	if($request->type == 'customer')
    	{
	    	$customer = Customer::where('customer_name', $request->name)->first();

	    	if($customer->total < $customer->received)
	    	{
	    		$amount = $customer->received - $customer->total;
	    		if($amount >= $request->pay_able)
	    		{
			    	$customer->pay_able = $customer->pay_able - $request->pay_able;
			    	$customer->total = $customer->total + $request->pay_able;
			    	$customer->save();
			    	echo 'Customer payable and received is updated';
			    }
		    }
		    else
		    {
		    	echo 'Customer payable and received is not updated';
		    }
		}

		if($request->type == 'retailer')
    	{
	    	$retailer = Retailer::where('retailer_name', $request->name)->first();

	    	if($retailer->total < $retailer->paid)
	    	{
	    		$amount = $retailer->paid - $retailer->total;
	    		if($amount >= $request->receive_able)
	    		{
			    	$retailer->receive_able = $retailer->receive_able - $request->receive_able;
			    	$retailer->total = $retailer->total + $request->receive_able;
			    	$retailer->save();
			    	echo 'Retailer receive able and paid is updated';
			    }
		    }
		    else
		    {
		    	echo 'Retailer receive able and paid is not updated';
		    }
		}
    }

    public function storeSalesReturn(Request $request)
    {
    	$request->validate ([
			'id' => ['required'],
			'name' => ['required'],
			'product' => ['required'],
			'returned' => ['required'],
    	]);

    	$sale = Sale::find($request->id);
    	$customer = Customer::where('customer_name', $sale->customer_name)->first();
    	$stock = Stock::where('retailer_id', $sale->retailer_id)->where('product', $sale->product)->first();
    	$yearly_sale = yearlySale::where('retailer_id', $sale->retailer_id)->where('product', $sale->product)->first();
    	$monthly_sale = MonthlySale::where('retailer_id', $sale->retailer_id)->where('product', $sale->product)->first();
    	$quantity = $sale->quantity - $request->returned;

    	if($request->returned != 0 && $request->returned <= $sale->quantity)
    	{
	    	$saleReturn = new SaleReturn();
	    	$saleReturn->customer_name = $sale->customer_name;
	    	$saleReturn->product = $sale->product;
	    	$saleReturn->category = $sale->category;
	    	$saleReturn->quantity = $request->returned;
	    	$saleReturn->amount = $sale->selling_rate * $request->returned;
	    	$saleReturn->customer_id = $customer->id;
	    	$saleReturn->retailer_id = $sale->retailer_id;
	    	$saleReturn->save();

	    	$monthly_sale->quantity_sold = $monthly_sale->quantity_sold - $request->returned;
	    	$monthly_sale->monthly_sale = $monthly_sale->monthly_sale - $sale->selling_rate * $request->returned;
	    	$monthly_sale->save();

	    	$yearly_sale->quantity_sold = $yearly_sale->quantity_sold - $request->returned;
	    	$yearly_sale->yearly_sale = $yearly_sale->yearly_sale - $sale->selling_rate * $request->returned;
	    	$yearly_sale->save();

	    	$customer->total = $customer->total - $sale->selling_rate * $request->returned;
	    	$customer->save();

	    	if($customer->total >= $customer->received)
	    	{
		    	$customer->receive_able = $customer->total - $customer->received;
		    	$customer->pay_able = 0;
		    	$customer->save();
	    	}
	    	else
	    	{
	    		$customer->pay_able = $customer->received - $customer->total;
	    		$customer->receive_able = 0;
	    		$customer->save();
	    	}

	    	if($quantity > 0)
	    	{
		    	$sale->quantity = $quantity;
		    	$sale->payment = $sale->payment - $sale->selling_rate * $request->returned;
		    	$sale->save();

	    		$saleReturn->sale_id = $sale->id;
	    		$saleReturn->save();
		    }
		    else
		    {
	    		$saleReturn->sale_id = '';
	    		$saleReturn->save();

		    	$sale->delete();
		    }
	        return response()->json(['pay_able'=> $saleReturn->amount, 'return_id' => $saleReturn->id, 'quantity'=> '']);
	    }
	    else
	    {
	    	return response()->json(['quantity'=> '[ "Please enter correct return quantity." ]']);
	    }
    }

    public function updateSalesReturn(Request $request)
    {
    	$request->validate ([
			'id' => ['required'],
			'name' => ['required'],
			'product' => ['required'],
			'status' => ['required'],
    	]);

    	$saleReturn = SaleReturn::find($request->id);
    	$retailer = Retailer::find($saleReturn->retailer_id);
    	$stock = Stock::where('retailer_id', $saleReturn->retailer_id)->where('product', $saleReturn->product)->first();
    	$purchase = Purchase::where('retailer_name', $retailer->retailer_name)->where('product', $saleReturn->product)->first();
    	$quantity = $purchase->quantity - $saleReturn->quantity;
    	$receive_able = $purchase->purchase_rate * $saleReturn->quantity;
    	$amount = $purchase->purchase_rate * $saleReturn->quantity;

    	if($saleReturn->status != $request->status)
    	{
	    	if($saleReturn->status != 'Returned to Retailer')
	    	{
	    		$saleReturn->status = $request->status;
	    		$saleReturn->save();
		    	
		    	$retailer->total = $retailer->total - $amount;
		    	$retailer->save();

		    	$stock->returned = $stock->returned + $saleReturn->quantity;
		    	$stock->price = $stock->price - $purchase->purchase_rate;
		    	if($stock->earned >= $saleReturn->amount)
		    	{
		    		$stock->earned = $stock->earned - $saleReturn->amount;
		    	}
		    	$stock->save();
		    }
		    else
		    {
				return response()->json(['status' => $saleReturn->status]);
		    }

		    if($retailer->total <= $retailer->paid)
	    	{
	    		$retailer->receive_able =  $retailer->paid - $retailer->total;
	    		$retailer->pay_able = 0;
	    		$retailer->save();
	    	}
	    	else
	    	{
	    		$retailer->pay_able = $retailer->total - $retailer->paid;
	    		$retailer->receive_able = 0;
	    		$retailer->save();
	    	}

	    	if($quantity <= 0)
		    {
		    	$purchase->delete();
		    }
	    	return response()->json(['receive_able'=> $receive_able, 'retailer_name' => $retailer->retailer_name, 'status' => '']);
		}
		else
		{
			return response()->json(['status' => $saleReturn->status]);
		}
    }

    public function storePurchaseReturn(Request $request)
    {
    	$request->validate ([
			'id' => ['required'],
			'name' => ['required'],
			'product' => ['required'],
			'returned' => ['required'],
    	]);

    	$purchase = Purchase::find($request->id);
    	$retailer = Retailer::where('retailer_name', $purchase->retailer_name)->first();

    	if($request->returned != 0 && $request->returned <= $purchase->quantity)
    	{
	    	$purchaseReturn = new PurchaseReturn();
	    	$purchaseReturn->retailer_name = $purchase->retailer_name;
	    	$purchaseReturn->product = $purchase->product;
	    	$purchaseReturn->category = $purchase->category;
	    	$purchaseReturn->quantity = $request->returned;
	    	$purchaseReturn->amount = $purchase->purchase_rate * $request->returned;
	    	$purchaseReturn->purchase_id = $purchase->id;
	    	$purchaseReturn->retailer_id = $retailer->id;
	    	$purchaseReturn->save();

	        return response()->json(['quantity'=> '']);
	    }
	    else
	    {
	    	return response()->json(['quantity'=> '[ "Please enter correct return quantity." ]']);
	    }
    }

    public function updatePurchaseReturn(Request $request)
    {
    	$request->validate ([
			'id' => ['required'],
			'name' => ['required'],
			'product' => ['required'],
			'status' => ['required'],
    	]);

    	$purchaseReturn = PurchaseReturn::find($request->id);
    	$retailer = Retailer::find($purchaseReturn->retailer_id);
    	$stock = Stock::where('retailer_id', $purchaseReturn->retailer_id)->where('product', $purchaseReturn->product)->first();
    	$purchase = Purchase::where('retailer_name', $retailer->retailer_name)->where('product', $purchaseReturn->product)->first();
    	$quantity = $purchase->quantity - $purchaseReturn->quantity;

    	if($purchaseReturn->status != $request->status)
    	{
	    	if($purchaseReturn->status != 'Returned to Retailer')
	    	{
	    		$purchaseReturn->status = $request->status;
	    		$purchaseReturn->save();

		    	$retailer->total = $retailer->total - $purchaseReturn->amount;
		    	$retailer->save();

		    	$stock->available = $stock->available - $purchaseReturn->quantity;
		    	$stock->returned = $stock->returned + $purchaseReturn->quantity;
		    	$stock->price = $stock->price - $purchase->purchase_rate;
		    	$stock->save();
		    }
		    else
		    {
		    	return response()->json(['status' => $purchaseReturn->status]);
		    }

		    if($retailer->total <= $retailer->paid)
	    	{
	    		$retailer->receive_able =  $retailer->paid - $retailer->total;
	    		$retailer->pay_able = 0;
	    		$retailer->save();
	    	}
	    	else
	    	{
	    		$retailer->pay_able = $retailer->total - $retailer->paid;
	    		$retailer->receive_able = 0;
	    		$retailer->save();
	    	}
	    	return response()->json(['receive_able'=> $purchaseReturn->amount, 'return_id' => $purchaseReturn->id, 'status' => '']);
		}
		else
		{
			return response()->json(['status' => $purchaseReturn->status]);
		}
    }
}
