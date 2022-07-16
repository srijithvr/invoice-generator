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
                            <h1 class="display-one"><a href="{{url('invoice')}}">Invoice Generator</a></h1>
                        <p>Fill and submit this form to create an invoice</p>

                        <hr>
                        <form action="{{url('invoice/update/' . $invoice->id)}}" method="POST" class="invoice_form">
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





                            <div class="row"  style="padding: 10px 0 10px 0;">
                                <div class="col-sm-2">
                                    <label for="title">Name</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Quantity</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Unit Price</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Tax</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Total without tax</label>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Total with tax</label>
                                </div>
                            </div>

                @forelse($invoiceItems as $invoiceItem)

                            <div class="row"  style="padding: 10px 0 10px 0;">
                                <div class="col-sm-2">
                                    {{ ucfirst($invoiceItem->name) }}
                                </div>
                                <div class="col-sm-2">
                                    {{ $invoiceItem->quantity }}
                                </div>
                                <div class="col-sm-2">
                                    {{ $invoiceItem->unit_price }}
                                </div>
                                <div class="col-sm-2">
                                    {{ $invoiceItem->tax }}
                                </div>
                                <div class="col-sm-2">
                                    {{ $invoiceItem->total_without_tax }}
                                </div>
                                <div class="col-sm-2">
                                    {{ $invoiceItem->total_with_tax }}
                                </div>
                            </div>
                        @empty
                            <p class="text-warning">No Invoice items available</p>
                        @endforelse


                            <div class="row mt-2" style="padding-top: 10px;">
                                <div class=" col-sm-10 text-right">
                                    <b>Sub Total Without Tax</b>
                                </div>
                                <div class=" col-sm-2 text-left">
                                    {{ $invoice->sub_total_without_tax }}
                                </div>
                                <div class=" col-sm-10 text-right">
                                    <b>Discount</b>
                                </div>
                                <div class=" col-sm-2 text-left">
                                    <select name="discount_type" id="discount_type" class="form-control" >
                                      <option value="percentage">Percentage</option>
                                      <option value="amount">Amount</option>
                                    </select>
                                    <br>
                                    <input type="text" id="discount_value" class="form-control" name="discount_value" placeholder="Discount" required>
                                </div>
                                <div class=" col-sm-10 text-right">
                                    <b>Sub Total With Tax</b>
                                </div>
                                <div class=" col-sm-2 text-left">
                                    {{ $invoice->sub_total_with_tax }}
                                </div>
                                <div class=" col-sm-10 text-right">
                                    
                                </div>
                                <div class=" col-sm-2 text-left">
                                    <div class="control-group col-12 text-center">
                                        <button id="btn-submit" class="btn btn-primary">
                                            Apply Discount
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </form>
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
