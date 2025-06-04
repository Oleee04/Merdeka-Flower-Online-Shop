@extends('layouts.app')
@section('content') 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Checkout - Alamat Pengiriman</h4>
                </div>
                <div class="card-body">
                    <!-- Ringkasan Pesanan -->
                    <div class="mb-4">
                        <h5>Ringkasan Pesanan</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
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
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3">Subtotal Produk</th>
                                        <th>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
                                    </tr>
                                    <tr id="ongkir-row" style="display: none;">
                                        <th colspan="3">Biaya Ongkir</th>
                                        <th id="biaya-ongkir">Rp 0</th>
                                    </tr>
                                    <tr id="total-row" style="display: none;">
                                        <th colspan="3">Total Bayar</th>
                                        <th id="total-bayar">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Form Alamat Pengiriman -->
                    <form action="{{ route('order.save-shipping-address') }}" method="POST" id="checkout-form">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <h5>Alamat Pengiriman</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="alamat_lengkap" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required 
                                    placeholder="Masukkan alamat lengkap Anda">{{ $order->alamat ?? '' }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="kode_pos" class="form-label">Kode Pos</label>
                                <input type="text" name="kode_pos" id="kode_pos" class="form-control" required 
                                    value="{{ $order->pos ?? '' }}" placeholder="12345">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kota" class="form-label">Kota Tujuan</label>
                                <select name="kota" id="kota" class="form-select" required>
                                    <option value="">Pilih Kota</option>
                                    <option value="Jakarta" {{ ($order->kota ?? '') == 'Jakarta' ? 'selected' : '' }}>Jakarta - Rp 15.000</option>
                                    <option value="Bogor" {{ ($order->kota ?? '') == 'Bogor' ? 'selected' : '' }}>Bogor - Rp 20.000</option>
                                    <option value="Depok" {{ ($order->kota ?? '') == 'Depok' ? 'selected' : '' }}>Depok - Rp 18.000</option>
                                    <option value="Tangerang" {{ ($order->kota ?? '') == 'Tangerang' ? 'selected' : '' }}>Tangerang - Rp 22.000</option>
                                    <option value="Bekasi" {{ ($order->kota ?? '') == 'Bekasi' ? 'selected' : '' }}>Bekasi - Rp 20.000</option>
                                    <option value="Bandung" {{ ($order->kota ?? '') == 'Bandung' ? 'selected' : '' }}>Bandung - Rp 25.000</option>
                                    <option value="Surabaya" {{ ($order->kota ?? '') == 'Surabaya' ? 'selected' : '' }}>Surabaya - Rp 30.000</option>
                                    <option value="Yogyakarta" {{ ($order->kota ?? '') == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta - Rp 28.000</option>
                                    <option value="Semarang" {{ ($order->kota ?? '') == 'Semarang' ? 'selected' : '' }}>Semarang - Rp 25.000</option>
                                    <option value="Medan" {{ ($order->kota ?? '') == 'Medan' ? 'selected' : '' }}>Medan - Rp 35.000</option>
                                    <option value="Palembang" {{ ($order->kota ?? '') == 'Palembang' ? 'selected' : '' }}>Palembang - Rp 32.000</option>
                                    <option value="Makassar" {{ ($order->kota ?? '') == 'Makassar' ? 'selected' : '' }}>Makassar - Rp 40.000</option>
                                    <option value="Denpasar" {{ ($order->kota ?? '') == 'Denpasar' ? 'selected' : '' }}>Denpasar - Rp 35.000</option>
                                    <option value="Balikpapan" {{ ($order->kota ?? '') == 'Balikpapan' ? 'selected' : '' }}>Balikpapan - Rp 45.000</option>
                                    <option value="Banjarmasin" {{ ($order->kota ?? '') == 'Banjarmasin' ? 'selected' : '' }}>Banjarmasin - Rp 38.000</option>
                                    <option value="Pontianak" {{ ($order->kota ?? '') == 'Pontianak' ? 'selected' : '' }}>Pontianak - Rp 42.000</option>
                                    <option value="Manado" {{ ($order->kota ?? '') == 'Manado' ? 'selected' : '' }}>Manado - Rp 50.000</option>
                                    <option value="Jayapura" {{ ($order->kota ?? '') == 'Jayapura' ? 'selected' : '' }}>Jayapura - Rp 60.000</option>
                                    <option value="Ambon" {{ ($order->kota ?? '') == 'Ambon' ? 'selected' : '' }}>Ambon - Rp 55.000</option>
                                    <option value="Kupang" {{ ($order->kota ?? '') == 'Kupang' ? 'selected' : '' }}>Kupang - Rp 48.000</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" name="no_hp" id="no_hp" class="form-control" required 
                                    value="{{ $order->hp ?? '' }}" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (Opsional)</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="2" 
                                placeholder="Catatan tambahan untuk pengiriman">{{ $order->catatan ?? '' }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('order.cart') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Keranjang
                            </a>
                            <button type="submit" class="btn btn-primary" id="submit-btn" disabled>
                                <i class="fas fa-credit-card"></i> Lanjut ke Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const kotaSelect = document.getElementById('kota');
    const submitBtn = document.getElementById('submit-btn');
    const ongkirRow = document.getElementById('ongkir-row');
    const totalRow = document.getElementById('total-row');
    const biayaOngkirEl = document.getElementById('biaya-ongkir');
    const totalBayarEl = document.getElementById('total-bayar');
    const orderId = parseInt(document.getElementById('order-id').value);
const subtotalProduk = parseInt(document.getElementById('subtotal-produk').value);


    const ongkirTarif = {
        'Jakarta': 15000, 'Bogor': 20000, 'Depok': 18000, 'Tangerang': 22000,
        'Bekasi': 20000, 'Bandung': 25000, 'Surabaya': 30000, 'Yogyakarta': 28000,
        'Semarang': 25000, 'Medan': 35000, 'Palembang': 32000, 'Makassar': 40000,
        'Denpasar': 35000, 'Balikpapan': 45000, 'Banjarmasin': 38000, 'Pontianak': 42000,
        'Manado': 50000, 'Jayapura': 60000, 'Ambon': 55000, 'Kupang': 48000
    };

    function formatRupiah(angka) {
        return 'Rp ' + angka.toLocaleString('id-ID');
    }

    function updateOngkir() {
        const selectedKota = kotaSelect.value;

        if (selectedKota) {
            const biayaOngkir = ongkirTarif[selectedKota] || 25000;
            const totalBayar = subtotalProduk + biayaOngkir;

            biayaOngkirEl.textContent = formatRupiah(biayaOngkir);
            totalBayarEl.textContent = formatRupiah(totalBayar);

            ongkirRow.style.display = 'table-row';
            totalRow.style.display = 'table-row';
            submitBtn.disabled = false;
        } else {
            ongkirRow.style.display = 'none';
            totalRow.style.display = 'none';
            submitBtn.disabled = true;
        }
    }

    kotaSelect.addEventListener('change', updateOngkir);

    if (kotaSelect.value) {
        updateOngkir();
    }
});
</script>

@endsection