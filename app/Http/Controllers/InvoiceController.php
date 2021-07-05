<?php

namespace App\Http\Controllers;

use App\Sale;
use App\SerialKey;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
	public function saveInvoice(Request $request)
	{
        $serial = '';
        $serialKey = SerialKey::first();

        if($serialKey == null)
        {
            $serial = 1;
            $serialKey = new SerialKey();
            $serialKey->key = $serial;
        }
        else
        {
            $serial = $serialKey->key + 1;
            $serialKey->key = $serial;
        }

        $pdf = PDF::loadView(
            'invoice',[
                'customer' => $request->customer, 
                'product' => $request->product, 
                'retailer' => $request->product_retailer, 
                'selling_rate' => $request->selling_rate, 
                'quantity' => $request->quantity, 
                'payment' => $request->payment,
                'serial' => $serial
            ]);

        // Store pdf file in public/storage/invoices folder
        Storage::put('invoices/Invoice-IMS-'.$serial.'.pdf', $pdf->output());

        // To Display PDF file
        $pdf->stream('Invoice-IMS-'.$serial.'.pdf', array('Attachment' => 0));

        $serialKey->save();

        $sale = Sale::find($request->sale_id);
        $sale->invoice = 'invoices/Invoice-IMS-'.$serial.'.pdf';
        $sale->save();
	}
}
