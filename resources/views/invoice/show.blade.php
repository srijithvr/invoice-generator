<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice Generator</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <style>
            body {
                font-family: 'Nunito';
            }
        </style>



    </head>

    <body>
        


        <div class="container">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                            <h1 class="display-one">Invoice Generator</h1>
                        <p>Fill and submit this form to create an invoice</p>

                        <hr>
                            @csrf
                            <div class="row" style="padding-top:10px;">
                                <div class="col-sm-12">
                                    <h4 class="display-one">Invoice Details</h4>
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 0 10px 0;">
                                <div class="col-sm-4">
                                    <label for="title">Invoice Title</label>
                                    <br>
                                    {{ ucfirst($invoice->title) }}
                                </div>
                                <div class="col-sm-4">
                                    <label for="body">From Address</label>
                                    <br>
                                    {{ ucfirst($invoice->from_address) }}

                                </div>
                                <div class="col-sm-4">
                                    <label for="body">To Address</label>
                                    <br>
                                    {{ ucfirst($invoice->to_address) }}
                                </div>
                            </div>

                            <div class="row" style="padding-top:10px;">
                                <div class="col-sm-12">
                                    <h4 class="display-one">Invoice Items</h4>
                                </div>
                            </div>

                            <table cellpadding="10" width="100%">
                                <tr>
                                    <td><label for="title">Name</label></td>
                                    <td><label for="title">Quantity</label></td>
                                    <td><label for="title">Unit Price</label></td>
                                    <td><label for="title">Tax</label></td>
                                    <td><label for="title">Total without tax</label></td>
                                    <td><label for="title">Total with tax</label></td>
                                </tr>


                                @forelse($invoiceItems as $invoiceItem)
                                    <tr>
                                        <td>{{ ucfirst($invoiceItem->name) }}</td>
                                        <td>{{ $invoiceItem->quantity }}</td>
                                        <td>{{ $invoiceItem->unit_price }}</td>
                                        <td>{{ $invoiceItem->tax }}</td>
                                        <td>{{ $invoiceItem->total_without_tax }}</td>
                                        <td>{{ $invoiceItem->total_with_tax }}</td>
                                    </tr>
                                @empty
                                    <p class="text-warning">No Invoice items available</p>
                                @endforelse
                                <tr>
                                    <td colspan="6">
                                                                <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; padding: 0px 10px 0 0;">
                                        <b>Sub Total Without Tax</b>
                                    </td>
                                    <td style="text-align: left; padding-top: 0px;">
                                        : {{ $invoice->sub_total_without_tax }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; padding: 20px 10px 0 0;">
                                        <b>Sub Total With Tax</b>
                                    </td>
                                    <td style="text-align: left; padding-top: 20px;">
                                       : {{ $invoice->sub_total_with_tax }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; padding: 20px 10px 0 0;">
                                        <b>Discount</b>
                                    </td>
                                    <td style="text-align: left; padding-top: 20px;">
                                       : {{ $invoice->discount_amount }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="text-align: right; padding: 20px 10px 0 0;">
                                        <b>Grand Total</b>
                                    </td>
                                    <td style="text-align: left; padding-top: 20px;">
                                        : <b>{{ $invoice->grand_total }}</b>
                                    </td>
                                </tr>
                            </table>



                            

                            <div class="row mt-2" style="padding-top: 10px;">
                                

                                <div class=" col-sm-10 text-right">
                                    
                                </div>
                                <div class=" col-sm-12 text-left">
                                    <div class="control-group col-12 text-center">
                                        <button id="btn-submit" class="btn btn-primary" onclick="window.print();">
                                            Generate Invoice
                                        </button>
                                    </div>
                                </div>

                            </div>

                    </div>

                </div>
            </div>
        </div>



    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
      integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        var cnt = 0;
        $("#add_invoice_item").click(function(){
            $("#invoice_item").clone().attr("id", "invoice_item"+cnt)
            .insertAfter("#invoice_item");
            $("#invoice_item"+cnt).find("#add_invoice_item").text('Remove X')
                                  .addClass('remove_invoice_item')
                                  .attr("onclick", "removeInvoiceItem('invoice_item"+cnt+"')");
            $("#invoice_item"+cnt).find("input[type=text], textarea").val("");
            cnt++;

        });
        function removeInvoiceItem(element) {
            $('#'+element).remove();
        }
    </script>
</html>
