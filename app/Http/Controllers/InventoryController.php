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

class InventoryController extends Controller
{
    public function sale()
    {
    	$sale = Sale::get();
        return response()->json($sale);
    }

    public function getCustomerById(Request $request)
    {
    	$customer = Customer::find($request->customer_id);
    	return response()->json($customer);
    }

    public function customers()
    {
    	$customers = Customer::all();
    	return response()->json($customers);
    }

    public function customersDetail()
    {
    	$customers = Customer::get();
        return response()->json($customers);
    }

    public function updateCustomer(Request $request)
    {
    	$request->validate([
            'id' => ['required'],
    		'customer_name' => ['required'],
    	]);

    	$customer = Customer::find($request->id);

    	if($request->received != '')
    	{
    		$request->validate([
	            'received' => ['required'],
	        ]);

	    	$customer->received = $customer->received + $request->received;
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
    	}

    	if($request->paid != '')
    	{
    		$request->validate([
	            'paid' => ['required'],
	        ]);

	    	$customer->total = $customer->total + $request->paid;
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
    	}

    	return response()->json($customer);
    }

    public function purchase()
    {
    	$purchase = Purchase::get();
        return response()->json($purchase);
    }

    public function getRetailerById(Request $request)
    {
    	$retailer = Retailer::find($request->retailer_id);
    	return response()->json($retailer);
    }

    public function retailers()
    {
    	$retailers = Retailer::all();
    	return response()->json($retailers);
    }

    public function retailersDetail()
    {
    	$retailers = Retailer::get();
        return response()->json($retailers);
    }

    public function updateRetailer(Request $request)
    {
    	$request->validate([
            'id' => ['required'],
    		'retailer_name' => ['required'],
    	]);

    	$retailer = Retailer::find($request->id);

    	if($request->received != '')
    	{
    		$request->validate([
	            'received' => ['required'],
	        ]);

	    	$retailer->total = $retailer->total + $request->received;
	    	$retailer->save();

	    	if($retailer->total >= $retailer->paid)
	    	{
	    		$retailer->pay_able = $retailer->total - $retailer->paid;
	    		$retailer->receive_able = 0;
	    		$retailer->save();
	    	}
	    	else
	    	{
		    	$retailer->receive_able = $retailer->paid - $retailer->total;
		    	$retailer->pay_able = 0;
		    	$retailer->save();
	    	}
    	}

    	if($request->paid != '')
    	{
    		$request->validate([
	            'paid' => ['required'],
	        ]);

	    	$retailer->paid = $retailer->paid + $request->paid;
	    	$retailer->save();

	    	if($retailer->total >= $retailer->paid)
	    	{
	    		$retailer->pay_able = $retailer->total - $retailer->paid;
	    		$retailer->receive_able = 0;
	    		$retailer->save();
	    	}
	    	else
	    	{
		    	$retailer->receive_able = $retailer->paid - $retailer->total;
		    	$retailer->pay_able = 0;
		    	$retailer->save();
	    	}
    	}

    	return response()->json($retailer);
    }

    public function stocks()
    {
    	$stocks = Stock::all();
    	return response()->json($stocks);
    }

    public function products()
    {
    	$products = Product::get();
    	return response()->json($products);
    }

     public function showProduct(Request $request)
    {
    	$product = Product::find($request->productid);
    	return response()->json($product);
    }

    public function editProduct(Request $request)
    {
    	$product = Product::find($request->productid);
    	return response()->json($product);
    }

    public function updateProduct(Request $request)
    {
    	$product = Product::find($request->id);

    	if($request->latest_price != null)
    	{
    		$product->latest_price = $request->latest_price;
    	}

    	if($request->quality != null)
    	{
    		$product->quality = $request->quality;
    	}

    	if($request->file('picture') != null)
    	{
    		$request->validate(['picture' => 'required|mimes:jpeg,jpg,png',]);
    		$path =$request->file('picture')->storeAs('products', $request->file('picture')->getClientOriginalName());
    		echo $path;
    		$product->image = $path;
    	}

    	if($request->description != null)
    	{
    		$product->description = $request->description;
    	}
    	
    	$product->save();
    	return response()->json($product);
    }

    public function storeSale(Request $request)
    {
    	$request->validate([
            'customer' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'product_retailer' => ['required', 'string', 'max:255'],
            'selling_rate' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
            'payment' => ['required', 'string', 'max:255'],
        ]);

    	$date = Carbon::now();
    	$dateObj   = Carbon::createFromFormat('!m', $date->month);
		$month = $dateObj->format('F');
		// return $date->toArray();

		$retailer = Retailer::where('retailer_name', $request->product_retailer)->first();
		$oldPurchase = Purchase::where('retailer_name', $request->product_retailer)->where('product', $request->product)->first();
		$stock = Stock::where('retailer_id', $retailer->id)->where('product', $request->product)->first();
		if($stock == '')
	    {
	    	return response()->json(['noStock' => '']);
	    }
		$yearly_sale = YearlySale::where('year', $date->year)->where('product', $request->product)->where('retailer_id', $oldPurchase->id)->first();
		$monthly_sale = MonthlySale::where('month', $month)->where('product', $request->product)->where('retailer_id', $oldPurchase->id)->first();
		$customer = Customer::where('customer_name', $request->customer)->first();
	    $total = $request->selling_rate * $request->quantity;


		if(!empty($stock))
		{
			if($stock->available != 0)
			{
				if($stock->available >= $request->quantity)
				{
					$sale = new Sale();
					$sale->customer_name = $request->customer;
					$sale->product = $request->product;
					$sale->category = $oldPurchase->category;
					$sale->selling_rate = $request->selling_rate;
					$sale->quantity = $request->quantity;
					$sale->payment = $request->payment;
					$sale->retailer_id = $oldPurchase->id;
					$sale->sale_date = $date->day.'-'.$month.'-'.$date->year;
					$sale->save();

					$stock->available = $stock->available - $request->quantity;
					$stock->earned = $stock->earned + $request->payment;
					$stock->save();

					if(empty($customer))
				    {
				    	$customer = new Customer();
				    	$customer->customer_name = $request->customer;
				    	$customer->total = $total;
				    	$customer->received = $request->payment;
				    	$customer->save();
				    	// echo 'New Customer Saved';
				    }
				    else
				    {
				    	$customer->total = $customer->total + $total;
				    	$customer->received = $customer->received + $request->payment;
				    	$customer->save();
				    	// echo 'Existing Customer Updated';
				    }
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

					if($stock->available == 0)
					{
						if($stock->earned < $stock->price)
						{
							$stock->profit = 0;
							$stock->loss = $stock->price - $stock->earned;
							$stock->status = 'Loss';
							$stock->save();
						}
						elseif($stock->earned > $stock->price)
						{
							$stock->profit = $stock->earned - $stock->price;
							$stock->loss = 0;
							$stock->status = 'Profit';
							$stock->save();
						}
						else
						{
							$stock->profit = 0;
							$stock->loss = 0;
							$stock->status = 'Break-even';
							$stock->save();
						}
					}
					else
					{
						// echo 'Product is still in stock for sale';
					}

					if(empty($yearly_sale))
					{
						$yearly_sale = new YearlySale;
						$yearly_sale->product = $request->product;
						$yearly_sale->category = $oldPurchase->category;
						$yearly_sale->quantity_sold = $request->quantity;
						$yearly_sale->year = $date->year;
						$yearly_sale->yearly_sale = $request->payment;
						$yearly_sale->first_sale = $date->day.'-'.$month.'-'.$date->year;
						$yearly_sale->last_sale = $date->day.'-'.$month.'-'.$date->year;
						$yearly_sale->retailer_id = $oldPurchase->id;
						$yearly_sale->save();
						// echo 'New yearly sale sale of product is saved';
					}
					else
					{
						$yearly_sale->quantity_sold = $yearly_sale->quantity_sold + $request->quantity;
						$yearly_sale->yearly_sale = $request->quantity * $request->selling_rate + $yearly_sale->yearly_sale;
						$yearly_sale->last_sale = $date->day.'-'.$month.'-'.$date->year;
						$yearly_sale->save();
						// echo 'Existing yearly sale of product is updated';
					}

					if(empty($monthly_sale))
					{
						$monthly_sale = new MonthlySale;
						$monthly_sale->product = $request->product;
						$monthly_sale->category = $oldPurchase->category;
						$monthly_sale->quantity_sold = $request->quantity;
						$monthly_sale->year = $date->year;
						$monthly_sale->month = $month;
						$monthly_sale->monthly_sale = $request->payment;
						$monthly_sale->first_sale = $date->day.'-'.$month.'-'.$date->year;
						$monthly_sale->last_sale = $date->day.'-'.$month.'-'.$date->year;
						$monthly_sale->retailer_id = $oldPurchase->id;
						$monthly_sale->save();
						// echo 'New monthly sale of product is saved';
					}
					else
					{
						$monthly_sale->quantity_sold = $monthly_sale->quantity_sold + $request->quantity;
						$monthly_sale->monthly_sale = $request->quantity * $request->selling_rate + $monthly_sale->monthly_sale;
						$monthly_sale->last_sale = $date->day.'-'.$month.'-'.$date->year;
						$monthly_sale->save();
						// echo 'Existing monthly sale of product is updated';
					}
					return response()->json(['success' => 'done', 'sale_id' => $sale->id]);
				}
				else
				{
					return response()->json(['limitStock' => $stock->available]);
				}	
			}
			else
			{
				return response()->json(['zeroStock' => $stock->available]);
			}
		}
		else
		{
			return response()->json(['noStock' => '']);
		}
    }

    public function storePurchase(Request $request)
    {
    	$request->validate([
            'retailer' => ['required', 'string', 'max:255'],
            'product' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'purchase_rate' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
            'payment' => ['required', 'string', 'max:255'],
        ]);

    	$date = Carbon::now();
    	$dateObj   = Carbon::createFromFormat('!m', $date->month);
		$month = $dateObj->format('F');

    	$purchase = new Purchase();
    	$purchase->retailer_name = $request->retailer;
    	$purchase->product = $request->product;
    	$purchase->purchase_rate = $request->purchase_rate;
    	$purchase->quantity = $request->quantity;
    	$purchase->payment = $request->payment;
    	$purchase->category = $request->category;
    	$purchase->purchase_date = $date->day.'-'.$month.'-'.$date->year;
    	$purchase->save();

    	$oldPurchase = Purchase::where('category', $request->category)->where('product', $request->product)->where('retailer_name', $request->retailer)->first();
    	$product = Product::where('category', $request->category)->where('product', $request->product)->first();
    	if(empty($product))
    	{
    		$product = new Product();
	    	$product->product = $request->product;
	    	$product->category = $request->category;
	    	$product->latest_price = $request->purchase_rate;
	    	$product->retailer_id = $purchase->id;
	    	$product->save();
	    	echo 'product saved successfully';
	    }
	    else
	    {
	    	$product->latest_price = $request->purchase_rate;
	    	$product->save();
	    	echo 'Existing product is updated';
	    }

	    $stock = Stock::where('category', $request->category)->where('product', $request->product)->where('retailer_id', $oldPurchase->id)->first();
	    $retailer = Retailer::find($oldPurchase->id);
	    $total = $request->purchase_rate * $request->quantity;

	    if(empty($retailer))
	    {
	    	$retailer = new Retailer();
	    	$retailer->retailer_name = $request->retailer;
	    	$retailer->total = $total;
	    	$retailer->paid = $request->payment;
	    	$retailer->pay_able = 0;
	    	$retailer->receive_able = 0;
	    	$retailer->save();

	    	echo 'New Retailer Saved';
	    }
	    else
	    {
	    	$retailer->total = $retailer->total + $total;
	    	$retailer->paid = $retailer->paid + $request->payment;
	    	$retailer->save();

	    	echo 'Existing Retailer Updated';
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

	    if(empty($stock))
	    {
	    	$stock = new Stock();
	    	$stock->product = $request->product;
	    	$stock->category = $request->category;
	    	$stock->available = $request->quantity;
	    	$stock->total = $request->quantity;
	    	$stock->price = $request->payment;
	    	$stock->retailer_id = $oldPurchase->id;
    		$stock->first_purchase = $date->day.'-'.$month.'-'.$date->year;
    		$stock->purchase_updated = $date->day.'-'.$month.'-'.$date->year;
	    	$stock->save();
	    	echo 'New Stock is created';
	    }
	    else
	    {
	    	$stock->available = $stock->available + $request->quantity;
	    	$stock->total = $stock->total + $request->quantity;
	    	$stock->price = $stock->price + $request->payment;
    		$stock->purchase_updated = $date->day.'-'.$month.'-'.$date->year;
	    	$stock->save(); 
	    	echo 'Existing stock is updated';
	    }
    }
}
