<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .header, .footer { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ccc; padding: 8px; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Invoice</h2>
        <p>No. Invoice: #{{ $order->id }}</p>
        <p>Tanggal: {{ $order->created_at->format('d-m-Y') }}</p>
    </div>

    <hr>

    <h4>Data Pelanggan</h4>
    <p>Nama: {{ $order->customer->user->name }}</p>
    <p>Alamat: {{ $order->alamat }}</p>
    <p>No HP: {{ $order->customer->user->hp }}</p>

    <h4>Detail Pesanan</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->produk->nama_produk }}</td>
                <td class="right">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="right">{{ $item->quantity }}</td>
                <td class="right">Rp{{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="right"><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
    <p class="right"><strong>Biaya Ongkir:</strong> Rp{{ number_format($order->biaya_ongkir, 0, ',', '.') }}</p>
    <p class="right"><strong>Total Bayar:</strong> Rp{{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</p>

    <hr>

    <div class="footer">
        <p>Terima kasih telah berbelanja!</p>
    </div>
</body>
</html>
