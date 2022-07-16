<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all(); 
        return view('invoice.list', [
            'invoices' => $invoices
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoice.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice;
        $invoice->title = $request->input('title');
        $invoice->from_address = $request->input('from_address');
        $invoice->from_address = $request->input('from_address');
        $invoice->to_address = $request->input('to_address');
        $sub_total_without_tax = $sub_total_with_tax = 0; 
        if($invoice->save()){
            $name = $request->input('name');
            for ($i=0; $i < count($name); $i++) { 
                $invoiceItem                    = new InvoiceItem;
                $invoiceItem->invoice_id        = $invoice->id;
                $invoiceItem->name              = $request->input('name')[$i];
                $invoiceItem->quantity          = $request->input('quantity')[$i];
                $invoiceItem->unit_price        = $request->input('unit_price')[$i];
                $invoiceItem->tax               = $request->input('tax')[$i];
                $invoiceItem->total_without_tax = $invoiceItem->quantity * $invoiceItem->unit_price;
                $invoiceItem->total_with_tax    = ($invoiceItem->tax > 0) ? $invoiceItem->total_without_tax + ($invoiceItem->total_without_tax/100 * $invoiceItem->tax) : $invoiceItem->total_without_tax;
                $invoiceItem->save();

                $sub_total_without_tax  += $invoiceItem->total_without_tax;
                $sub_total_with_tax     += $invoiceItem->total_with_tax;
            }
        }
        $invoice->sub_total_without_tax = $sub_total_without_tax;
        $invoice->sub_total_with_tax    = $sub_total_with_tax;
        $invoice->save();

        return redirect('invoice/edit/' . $invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id); 
        return view('invoice.show', [
            'invoice' => $invoice,
            'invoiceItems' => $invoice->invoiceItems,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id); 
        return view('invoice.edit', [
            'invoice' => $invoice,
            'invoiceItems' => $invoice->invoiceItems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if($discount_value = $request->input('discount_value')){
            $invoice->discount_type  = $request->input('discount_type');
            $invoice->discount_value = $discount_value;
            if($invoice->discount_type == 'percentage')
                $discount_amount = ($invoice->sub_total_with_tax/100) * $discount_value;
            else
                $discount_amount = $invoice->sub_total_with_tax - $discount_value;
            $invoice->discount_amount   = $discount_amount;
            $invoice->grand_total       = $invoice->sub_total_with_tax - $discount_amount;
            $invoice->save();
        }
        return redirect('invoice/show/' . $invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
