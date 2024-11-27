<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }

        .receipt {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .receipt h1 {
            color: #ff7f00;
            margin-bottom: 10px;
        }

        .receipt h3 {
            color: #333;
            margin: 5px 0;
        }

        .receipt p {
            color: #555;
            margin: 5px 0;
            font-size: 14px;
        }

        .receipt table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .receipt table th,
        .receipt table td {
            text-align: left;
            padding: 8px 5px;
            border-bottom: 1px solid #ddd;
        }

        .receipt .total {
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h1>Struk Pembayaran</h1>
        <p><strong>Nama Pembeli:</strong> {{ $order['name_customer'] }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order['created_at'])->format('d/m/Y H:i') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order['items'] as $item)
                    <tr>
                        <td>{{ $item['name_item'] }}</td>
                        <td>{{ $item['qty'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item['sub_price'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p><strong>Subtotal:</strong> Rp {{ number_format($order['price'], 0, ',', '.') }}</p>
        <p><strong>PPN (10%):</strong> Rp {{ number_format($order['price'] * 0.1, 0, ',', '.') }}</p>
        <h3 class="total"><strong>Total Bayar:</strong> Rp {{ number_format($order['total_price'], 0, ',', '.') }}</h3>
    </div>
</body>

</html>
