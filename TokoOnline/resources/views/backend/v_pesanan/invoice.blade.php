<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; color: #333; }
        .invoice-box {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background: #fff;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h2 {
            margin: 0;
            color: #2B2D42;
        }
        .info-grid {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .info-box {
            width: 48%;
        }
        .info-box h4 {
            color: #E91E63;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 1px;
        }
        .info-box p {
            margin: 4px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            vertical-align: middle;
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
            color: #2B2D42;
        }
        .img-thumbnail {
            max-height: 80px;
            max-width: 80px;
            object-fit: contain;
            border-radius: 4px;
        }
        .no-image {
            height: 80px;
            line-height: 80px;
            background: #f0f0f0;
            color: #999;
            font-size: 12px;
        }
        .total {
            text-align: right;
            font-weight: 700;
            color: #E91E63;
            font-size: 16px;
        }
        .back-button {
            display: block;
            width: 180px;
            margin: 30px auto 0;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        .text-muted {
            color: #888;
        }
        .text-left {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <h2>Invoice Pemesanan</h2>
            <p>Nomor Invoice: <strong>#{{ $order->id }}</strong></p>
            <p>Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h4>Informasi Pengiriman</h4>
                <p><strong>Nama:</strong> {{ optional(optional($order->customer)->user)->nama ?? 'Tidak tersedia' }}</p>
                <p><strong>Email:</strong> {{ optional(optional($order->customer)->user)->email ?? '-' }}</p>
                <p><strong>Alamat:</strong> {{ $order->alamat ?? '-' }}</p>
                <p><strong>Kode Pos:</strong> {{ $order->pos ?? '-' }}</p>
            </div>
            <div class="info-box">
                <h4>Status Pesanan</h4>
                <p>
                    <strong>Status:</strong> 
                          <span class="badge 
                                        @if($order->status == 'pending') badge-warning
                                        @elseif($order->status == 'Paid') badge-success
                                        @elseif($order->status == 'Kirim') badge-info
                                        @elseif($order->status == 'Selesai') badge-primary
                                        @else badge-secondary
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                </p>
                <p><strong>Total Bayar:</strong> Rp {{ number_format(($order->total_harga ?? 0) + ($order->biaya_ongkir ?? 0), 0, ',', '.') }}</p>
                @if(!empty($order->noresi))
                    <p><strong>No. Resi:</strong> {{ $order->noresi }}</p>
                @endif
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100px;">Gambar</th>
                    <th class="text-left">Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($order->orderItems as $item)
                    @php
                        $harga = $item->harga ?? ($item->produk->harga ?? 0);
                        $qty = $item->quantity ?? $item->jumlah ?? 1;
                        $subtotal = $harga * $qty;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>
                            @if($item->produk && $item->produk->foto)
                                <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}" alt="{{ $item->produk->nama_produk }}" class="img-thumbnail">
                            @else
                                <div class="no-image">No Image</div>
                            @endif
                        </td>
                        <td class="text-left">
                            <strong>{{ $item->produk->nama_produk ?? '-' }}</strong><br>
                            <small class="text-muted">Kategori: {{ $item->produk->kategori->nama_kategori ?? '-' }}</small><br>
                            <small>Berat: {{ $item->produk->berat ?? 0 }} g</small><br>
                            <small>Stok: {{ $item->produk->stok ?? 0 }}</small>
                        </td>
                        <td>Rp {{ number_format($harga, 0, ',', '.') }}</td>
                        <td>{{ $qty }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="total">Subtotal</td>
                    <td class="total">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
                @if(!empty($order->biaya_ongkir) && $order->biaya_ongkir > 0)
                    <tr>
                        <td colspan="4" class="total">Ongkir</td>
                        <td class="total">Rp {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</td>
                    </tr>
                @endif
                <tr style="font-weight: 700; color: #E91E63;">
                    <td colspan="4" class="total">Total Bayar</td>
                    <td class="total">Rp {{ number_format($total + ($order->biaya_ongkir ?? 0), 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('backend.pesanan.index') }}" class="back-button">← Kembali ke History</a>
    </div>
</body>
</html>
