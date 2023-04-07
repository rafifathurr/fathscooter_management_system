<!DOCTYPE html>
<html>
    <head>
        <title>Export Excel</title>
    </head>
    <body>
        <table width="100%">
            <thead>
                <tr>
                    <th colspan="10" style="text-align:center;">
                    @if(isset($month))
                        <h3>Report Order Of {{date("F", mktime(0, 0, 0, $month, 10))}} {{$year}}</h3> 
                    @else
                        <h3>Report Order Of {{$year}}</h3>
                    @endif
                    </th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Product</th>
                    <th>Code</th>
                    <th>Source Payment</th>
                    <th>Qty</th>
                    <th>Base Price</th>
                    <th>Income</th>
                    <th>Platform Fee</th>
                    <th>Profit</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $num = 0; 
                $base_all = 0;
            ?>
            @foreach($orders as $order)
                <?php
                $base_all += $order->base_price_product*$order->qty;
                ?>
                <tr>
                    <td>
                    <center>{{$num=$num+1}}</center>
                    </td>
                    <td>
                    <center>{{$order->date}}</center>
                    </td>
                    <td>
                    <center>{{$order->product->product_name}}</center>
                    </td>
                    <td>
                    <center>{{$order->product->code}}</center>
                    </td>
                    <td>
                    <center>{{$order->source->source}}</center>
                    </td>
                    <td>
                    <center>{{$order->qty}}</center>
                    </td>
                    <td style="text-align:right">
                    Rp. {{ number_format($order->base_price_product*$order->qty,0,',','.')}},-
                    </td>
                    <td style="text-align:right">
                    Rp. {{ number_format($order->entry_price,0,',','.')}},-
                    </td>
                    <td style="text-align:right">
                    Rp. {{ number_format($order->tax,0,',','.')}},-
                    </td>
                    <td style="text-align:right">
                    Rp. {{ number_format($order->profit,0,',','.')}},-
                    </td>
                </tr>
            @endforeach
            <tr style="background-color:green;">
                <td colspan="6" style="text-align:right;">
                   <center><h3>Total</h3></center> 
                </td>
                <td style="text-align:right">
                <center><h3>Rp. {{ number_format($base_all,0,',','.')}},-</h3></center> 
                </td>
                <td style="text-align:right">
                <center><h3>Rp. {{ number_format($sum->total_income,0,',','.')}},-</h3></center> 
                </td>
                <td style="text-align:right">
                <center><h3>Rp. {{ number_format($sum->total_tax,0,',','.')}},-</h3></center> 
                </td>
                <td style="text-align:right">
                <center><h3>Rp. {{ number_format($sum->total_profit,0,',','.')}},-</h3></center> 
                </td>
            </tr>
            </tbody>
        </table>
    </body>
</html>