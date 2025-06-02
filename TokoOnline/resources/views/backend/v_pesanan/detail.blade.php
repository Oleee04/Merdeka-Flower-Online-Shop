@extends('backend.v_layouts.app')

@section('content')
<div class="section">
    <div class="container">
        <div class="order-summary">
            <div class="section-title mb-4">
                <h3 class="title">{{ $subJudul }}</h3>
            </div>

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2>Detail Pesanan #{{ $order->id }}</h2>
                        <p class="text-muted">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <form action="{{ route('pesanan.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h4 class="title">Informasi Pelanggan</h4>
                                <p><strong>Nama:</strong> {{ $order->customer->user->nama ?? 'Tidak tersedia' }}</p>
                                <p><strong>Email:</strong> {{ $order->customer->user->email ?? 'Tidak tersedia' }}</p>
                            </div>

                            <div class="col-md-6">
                                <h4 class="title">Status Pesanan</h4>
                                <p><strong>Status:</strong>
                                    <span class="badge 
                                        @if($order->status == 'pending') badge-warning
                                        @elseif($order->status == 'Paid') badge-success
                                        @elseif($order->status == 'Kirim') badge-warning
                                        @elseif($order->status == 'Selesai') badge-primary
                                        @else badge-secondary
                                        @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </p>
                                <p><strong>Total Pembayaran:</strong> Rp. {{ number_format($order->total_harga + $order->biaya_ongkir, 0, ',', '.') }}</p>
                                @if($order->noresi)
                                    <p><strong>No. Resi:</strong> {{ $order->noresi }}</p>
                                @endif
                            </div>
                        </div>

                        <h4 class="title">Daftar Produk</h4>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Produk</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalHarga = 0; @endphp
                                    @foreach($order->orderItems as $item)
                                        @php
                                            $subtotal = $item->harga * $item->quantity;
                                            $totalHarga += $subtotal;
                                        @endphp
                                        <tr>
                                            <td style="width: 100px;">
                                                @if($item->produk->foto)
                                                    <img src="{{ asset('storage/img-produk/thumb_sm_' . $item->produk->foto) }}"
                                                         class="img-thumbnail" style="max-height: 80px;">
                                                @else
                                                    <div class="bg-light text-muted text-center" style="height: 80px; line-height: 80px;">
                                                        No Image
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->produk->nama_produk }}</strong><br>
                                                <small class="text-muted">#{{ $item->produk->kategori->nama_kategori ?? '-' }}</small><br>
                                                <small>Berat: {{ $item->produk->berat }}g</small><br>
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
                                        <th colspan="4" class="text-right">Subtotal:</th>
                                        <th class="text-center">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</th>
                                    </tr>
                                    @if($order->biaya_ongkir > 0)
                                        <tr>
                                            <th colspan="4" class="text-right">Biaya Ongkir:</th>
                                            <th class="text-center">Rp. {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th colspan="4" class="text-right">Total Bayar:</th>
                                        <th class="text-center text-danger">Rp. {{ number_format($totalHarga + $order->biaya_ongkir, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <h4 class="title mt-4">Update Pesanan</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noresi">No. Resi</label>
                                    <input type="text" id="noresi" name="noresi" value="{{ old('noresi', $order->noresi) }}"
                                           class="form-control @error('noresi') is-invalid @enderror">
                                    @error('noresi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="">- Pilih Status -</option>
                                        <option value="Paid" {{ old('status', $order->status) == 'Paid' ? 'selected' : '' }}>Proses</option>
                                        <option value="Kirim" {{ old('status', $order->status) == 'Kirim' ? 'selected' : '' }}>Kirim</option>
                                        <option value="Selesai" {{ old('status', $order->status) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat"
                                              class="form-control @error('alamat') is-invalid @enderror"
                                              rows="4">{{ old('alamat', $order->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pos">Kode Pos</label>
                                    <input type="text" id="pos" name="pos" value="{{ old('pos', $order->pos) }}"
                                           class="form-control @error('pos') is-invalid @enderror">
                                    @error('pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-actions text-right mt-3">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('order.history') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .section { padding: 40px 0; }
    .section-title h3, .section-title h4 {
        font-weight: 700;
        color: #2B2D42;
        text-transform: uppercase;
    }
    .order-summary {
        background: #fff;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .badge { font-size: 0.9rem; padding: 6px 12px; }
    .form-control:focus {
        border-color: #E91E63;
        box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.2);
    }
</style>
@endpush
