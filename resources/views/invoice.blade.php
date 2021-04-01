<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Invoice</title>

        <style type="text/css">
            html {
                margin: 0;
            }
            body {
                font-size: 0.6875rem;
                margin: 36pt;
            }
            body, h1, h2, h3, h4, h5, h6, p, div {
                font-family: sans-serif;
                line-height: 1.1;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
        </style>
    </head>

    <body class="">
        <h2 align="center">
            <img src="ims-logo.png" style="width: 50px;"><br><br>
            <strong>Sale Invoice</strong>
        </h2><hr>

        <table class="table" style="margin-left: 570px;">
            <tbody>
                <tr>
                    <td class="border-0 pl-0">
                        <p>Serial <strong>Invoice-IMS-{{$serial}}</strong></p>
                        <p>Date: <strong>05-May-2021</strong></p>
                    </td>
                </tr>
            </tbody>
        </table><hr>

        <table class="table">
            <thead>
                <tr>
                    <th class="border-0 pl-0" width="48.5%">
                        <h2 style="margin-right: 300px;">Seller</h2><hr>
                    </th>
                    <th class="border-0" width="3%"></th>
                    <th class="border-0 pl-0">
                        <h2 style="margin-right: 250px;">Buyer</h2><hr style="width: 340px;">
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-0">
                        <p class="seller-name">
                            <strong>Johar Alam</strong>
                        </p>
                        <p class="seller-phone">
                            03242322223
                        </p>
                        <p class="seller-email">
                            johar@glowlogix.com
                        </p>
                    </td>
                    <td class="border-0"></td>
                    <td class="px-0">
                        <p class="buyer-name">
                            <strong>{{$customer}}</strong>
                        </p>
                        <p class="buyer-phone">
                            03237737222
                        </p>
                        <p class="buyer-email">
                            customer@example.com
                        </p>
                    </td>
                </tr>
            </tbody>
        </table><hr><br>

        <table class="table" style="margin-left: 305px;">
            <thead>
                <tr>
                    <th style="width: 100px;">Product</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 100px;">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: center; color: red;">
                    <td class="pl-0">{{$product}}</td>
                    <td class="text-center">{{$quantity}}</td>
                    <td class="text-right">
                        {{$selling_rate}} $
                    </td>
                    <td class="text-right pr-0">
                        {{$selling_rate * $quantity}} $
                    </td>
                </tr>
            </tbody>
        </table><hr>
        
        <?php $subTotal = $selling_rate * $quantity; ?>

        <div align="right">
            <label class="text-right pl-0"><h3 style="margin-right: 10px;">Total Amount: {{$selling_rate * $quantity}} $</h3></label>
            <label class="text-right pl-0"><h3 style="margin-right: 10px;">Paid: {{$payment}} $</h3></label>

            <label class="text-right pl-0">
                <h3 style="margin-right: 10px;">
                    @if($payment > $subTotal)
                    Return: {{$payment - $selling_rate * $quantity}} $
                    @endif

                    @if($payment < $subTotal)
                    Remaining: {{$selling_rate * $quantity - $payment}} $
                    @endif
                </h3>
            </label>
        </div>

        <div><hr><br><br>
            <p style="margin-top: 50px;">
                <u>Company Stamp</u>
                <u style="margin-left: 465px;">Customer Signature and Date</u>
            </p>
        </div>
    </body>
</html>
