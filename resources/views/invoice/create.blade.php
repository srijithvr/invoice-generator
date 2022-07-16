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
                        <form action="store" method="POST" class="invoice_form">
                            @csrf
                            <div class="row" style="padding-top:10px;">
                                <div class="col-sm-12">
                                    <h4 class="display-one">Invoice Details</h4>
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 0 10px 0;">
                                <div class="col-sm-4">
                                    <label for="title">Invoice Title</label>
                                    <input type="text" id="title" class="form-control" name="title"
                                           placeholder="Invoice Title" required>
                                </div>
                                <div class="col-sm-4">
                                    <label for="body">From Address</label>
                                    <textarea id="body" class="form-control" name="from_address" placeholder="From Address" rows="" required></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <label for="body">To Address</label>
                                    <textarea id="body" class="form-control" name="to_address" placeholder="To Address" rows="" required></textarea>
                                </div>
                            </div>

                            <div class="row" style="padding-top:10px;">
                                <div class="col-sm-12">
                                    <h4 class="display-one">Invoice Items</h4>
                                </div>
                            </div>


                            <div class="row" id="invoice_item" style="padding: 10px 0 10px 0;">
                                <div class="col-sm-3">
                                    <label for="title">Name</label>
                                    <input type="text" id="name" class="form-control" name="name[]"
                                           placeholder="Name" required>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Quantity</label>
                                    <input type="text" id="quantity" class="form-control" name="quantity[]"
                                           placeholder="Quantity" required>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Unit Price</label>
                                    <input type="text" id="unit_price" class="form-control" name="unit_price[]"
                                           placeholder="Unit Price" required>
                                </div>
                                <div class="col-sm-2">
                                    <label for="body">Tax</label>
                                    <select name="tax[]" id="tax" class="form-control" required>
                                      <option value="0">0%</option>
                                      <option value="1">1%</option>
                                      <option value="5">5%</option>
                                      <option value="10">10%</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <a href="javascript:;" class="btn btn-outline-primary btn-sm" id="add_invoice_item">Add Item +</a>
                                </div>
                            </div>


                            <div class="row mt-2" style="padding-top: 10px;">
                                <div class="control-group col-12 text-center">
                                    <button id="btn-submit" class="btn btn-primary">
                                        Create Invoice
                                    </button>
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
