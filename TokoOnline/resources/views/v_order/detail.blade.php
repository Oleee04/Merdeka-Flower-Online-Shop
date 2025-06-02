@extends('v_layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="order-summary clearfix">
            <div class="section-title">
                <p>Pesanan Saya</p>
                <h3 class="title">Detail Pesanan</h3>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{{ session('success') }}</strong>
                </div>
            @endif

            <div class="card mb-3">
                <div class="card-body">
                    <div class="invoice-title text-center mb-4">
                        <h2>Pesanan #{{ $order->id }}</h2>
                        <strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="section-title">
                                <h4 class="title">Informasi Pengiriman</h4>
                            </div>
                            <div class="customer-info">
                                <p><strong>Nama:</strong> {{ $order->customer && $order->customer->user ? $order->customer->user->nama : 'Tidak tersedia' }}</p>
                                <p><strong>Email:</strong> {{ $order->customer && $order->customer->user ? $order->customer->user->email : 'Tidak tersedia' }}</p>
                                {{-- No. HP dihapus --}}
                                <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
                                <p><strong>Kode Pos:</strong> {{ $order->pos }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="section-title">
                                <h4 class="title">Status Pesanan</h4>
                            </div>
                            <div class="order-info">
                                <p><strong>Status:</strong> 
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
                                <p><strong>Total Bayar:</strong> Rp. {{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</p>
                                @if($order->noresi)
                                    <p><strong>No. Resi:</strong> {{ $order->noresi }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="section-title">
                        <h4 class="title">Produk dalam Pesanan</h4>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Produk</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($order->orderItems as $item)
                                @php $subtotal = $item->harga * $item->quantity; $total += $subtotal; @endphp
                                <tr>
                                    <td style="width: 100px; text-align: center;">
                                        @if($item->produk->foto)
                                            <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}" 
                                                 alt="{{ $item->produk->nama_produk }}" 
                                                 style="max-height: 80px; max-width: 80px; object-fit: contain;">
                                        @else
                                            <div style="height: 80px; line-height: 80px; background: #f0f0f0; color: #999; font-size: 12px;">
                                                No Image
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $item->produk->nama_produk }}</strong><br>
                                        <small class="text-muted">Kategori: {{ $item->produk->kategori->nama_kategori ?? '-' }}</small><br>
                                        <small>Berat: {{ $item->produk->berat }} g</small><br>
                                        <small>Stok: {{ $item->produk->stok }}</small>
                                    </td>
                                    <td class="text-center">Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-center">Rp. {{ number_format($subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Subtotal</th>
                                <th class="text-center">Rp. {{ number_format($total, 0, ',', '.') }}</th>
                            </tr>
                            @if($order->biaya_ongkir > 0)
                                <tr>
                                    <th colspan="4" class="text-right">Ongkir</th>
                                    <th class="text-center">Rp. {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</th>
                                </tr>
                            @endif
                            <tr class="table-active">
                                <th colspan="4" class="text-right">Total</th>
                                <th class="text-center text-danger">Rp. {{ number_format($total + $order->biaya_ongkir, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="text-center mt-4">
                        <a href="{{ route('order.history') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke History
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .section { padding: 30px 0; }
    .section-title p {
        color: #E91E63; font-weight: 600; text-transform: uppercase;
        font-size: 12px; letter-spacing: 2px;
    }
    .section-title .title { font-size: 24px; font-weight: 700; color: #2B2D42; }
    .order-summary { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
    .table th, .table td { vertical-align: middle; border: 1px solid #dee2e6; }
    .badge-warning { background-color: #ffc107; color: #212529; }
    .badge-success { background-color: #28a745; }
    .badge-info { background-color: #17a2b8; }
    .badge-primary { background-color: #007bff; }
    .badge-secondary { background-color: #6c757d; }
</style>
@endpush
@endsection
