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
            .invoiceList td{
                padding: 5px;
                border-bottom: 1px #ccc solid;
            }
        </style>



    </head>

    <body>
        


        <div class="container">
            <div class="row">
                <div class="col-12 pt-2">
                    <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                            <h1 class="display-one"><a href="{{url('invoice')}}">Invoice Generator</a></h1>

                        <div class="row mt-2" style="padding-top: 10px;">
                            <div class="control-group col-sm-10 ">
                                <h3>Invoice list</h3>   
                            </div>

                            <div class="control-group col-2 text-center">
                                <a href="invoice/create" class="btn btn-primary">
                                    Create Invoice
                                </a>
                            </div>
                        </div>
                        <hr>
                            @csrf
                            

                            <table class="invoiceList" cellpadding="10" cellspacing="10" width="100%">
                                <tr>
                                    <td><label for="title">Title</label></td>
                                    <td><label for="title">Subtotal without tax</label></td>
                                    <td><label for="title">Subtotal with tax</label></td>
                                    <td><label for="title">Discount Amount</label></td>
                                    <td><label for="title">Grand Total</label></td>
                                    <td>Actions</td>
                                </tr>


                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td>{{ ucfirst($invoice->title) }}</td>
                                        <td>{{ $invoice->sub_total_without_tax }}</td>
                                        <td>{{ $invoice->sub_total_with_tax }}</td>
                                        <td>{{ $invoice->discount_amount }}</td>
                                        <td>{{ $invoice->grand_total }}</td>
                                        <td><a href="invoice/show/{{ $invoice->id }}">Details</a></td>
                                    </tr>
                                @empty
                                    <p class="text-warning">No Invoice items available</p>
                                @endforelse

                            </table>



                            


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
