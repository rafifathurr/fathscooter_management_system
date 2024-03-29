<!DOCTYPE html>
<html>

<head>
    <title>Export Excel</title>
</head>

<body>
    <table width="100%">
        <thead>
            <tr>
                <th colspan="6" style="text-align:center;">
                    @if (isset($month))
                        <h3>Report Order Of {{ date('F', mktime(0, 0, 0, $month, 10)) }} {{ $year }}</h3>
                    @else
                        <h3>Report Order Of {{ $year }}</h3>
                    @endif
                </th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>Invoice</th>
                <th>Date</th>
                <th>Source Payment</th>
                <th>Income</th>
                <th>Platform Fee</th>
                <th>Profit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td style="text-align:left;">
                        {{ $order->invoice }}
                    </td>
                    <td>
                        <center>{{ $order->date_order }}</center>
                    </td>
                    <td>
                        <center>{{ $order->source->source }}</center>
                    </td>
                    <td style="text-align:right">
                        Rp. {{ number_format($order->entry_price, 0, ',', '.') }},-
                    </td>
                    <td style="text-align:right">
                        Rp. {{ number_format($order->platform_fee, 0, ',', '.') }},-
                    </td>
                    <td style="text-align:right">
                        Rp. {{ number_format($order->profit, 0, ',', '.') }},-
                    </td>
                </tr>
            @endforeach
            <tr style="background-color:green;">
                <td colspan="3" style="text-align:right;">
                    <center>
                        <h3>Total</h3>
                    </center>
                </td>
                <td style="text-align:right">
                    <center>
                        <h3>Rp. {{ number_format($sum->total_income, 0, ',', '.') }},-</h3>
                    </center>
                </td>
                <td style="text-align:right">
                    <center>
                        <h3>Rp. {{ number_format($sum->total_platform_fee, 0, ',', '.') }},-</h3>
                    </center>
                </td>
                <td style="text-align:right">
                    <center>
                        <h3>Rp. {{ number_format($sum->total_profit, 0, ',', '.') }},-</h3>
                    </center>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
