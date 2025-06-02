@extends('backend.v_layouts.app') 

@section('content') 
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> 
    <div class="card mb-3"> 
        <div class="card-body"> 
            <div class="table-responsive"> 
                <table id="dataTable" class="table table-bordered table-hover display" style="width:100%"> 
                    <thead> 
                        <tr> 
                            <th>No</th> 
                            <th>ID Order</th> 
                            <th>Tanggal</th> 
                            <th>Total</th> 
                            <th>Status</th> 
                            <th>Pelanggan</th> 
                            <th>Aksi</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        @forelse ($orders as $row) 
                        <tr> 
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $row->id }}</td> 
                            <td>{{ $row->created_at->format('d M Y H:i') }}</td> 
                            <td>Rp. {{ number_format($row->total_harga + $row->biaya_ongkir, 0, ',', '.') }}</td> 
                            <td> 
                                @php
                                    $status = strtolower($row->status);
                                @endphp
                                @if ($status == 'pending')
                                    <span class="badge badge-warning" style="color: white;">Menunggu Pembayaran</span>
                                @elseif ($status == 'proses')
                                    <span class="badge badge-primary">Proses</span>
                                @elseif ($status == 'paid')
                                    <span class="badge badge-success">Sudah Dibayar</span>
                                @elseif ($status == 'kirim')
                                    <span class="badge badge-info">Dikirim</span>
                                @elseif ($status == 'selesai')
                                    <span class="badge badge-secondary">Selesai</span>
                                @else
                                    <span class="badge badge-dark">{{ ucfirst($row->status) }}</span>
                                @endif
                            </td> 
                            <td>
                                {{ $row->customer?->user?->email ?? '-' }}
                            </td>
                            <td> 
                                <a href="{{ route('backend.v_pesanan.detail', $row->id) }}" title="Detail Order"> 
                                    <button type="button" class="badge badge-primary"><i class="far fa-eye"></i> Detail</button> 
                                </a> 
                                <a href="{{ route('pesanan.invoice', $row->id) }}" title="Cetak Invoice" target="_blank"> 
                                    <button type="button" class="badge badge-secondary"><i class="fas fa-print"></i> Cetak</button> 
                                </a> 
                            </td> 
                        </tr> 
                        @empty 
                        <tr> 
                            <td colspan="7" class="text-center">Tidak ada data order.</td> 
                        </tr> 
                        @endforelse 
                    </tbody> 
                </table> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection
