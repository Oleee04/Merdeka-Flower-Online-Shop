@extends('backend.v_layouts.app')

@section('content')

<style>
    h4 {
        color: #2B2D42;
        font-weight: 700;
        margin-bottom: 20px;
    }
    p {
        color: #333;
        font-size: 14px;
        margin-bottom: 30px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 40px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        background: #fff;
        font-family: Arial, sans-serif;
        color: #333;
    }
    th, td {
        border: 1px solid #dee2e6;
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
    }
    th {
        background-color: #f2f2f2;
        color: #2B2D42;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    tbody tr:nth-child(even) {
        background-color: #fafafa;
    }
    tfoot {
        font-weight: bold;
        background-color: #f9f9f9;
    }
    .text-center {
        text-align: center;
    }
</style>

<div class="invoice-box" style="max-width: 900px; margin: auto; padding: 30px; border: 1px solid #eee; box-shadow: 0 0 10px rgba(0,0,0,0.15); background: #fff;">
    <h4>Laporan Penjualan</h4>
    <p>Periode: <strong>{{ \Carbon\Carbon::parse($start_date)->format('d M Y') }}</strong> s/d <strong>{{ \Carbon\Carbon::parse($end_date)->format('d M Y') }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Invoice</th>
                <th>Pelanggan</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grand_total = 0; @endphp
            @forelse ($penjualan as $item)
                @php
                    $total = ($item->total_harga ?? 0) + ($item->biaya_ongkir ?? 0);
                    $grand_total += $total;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>#{{ $item->invoice ?? $item->id }}</strong></td>
                    <td>{{ optional(optional($item->customer)->user)->nama ?? '-' }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td class="total">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Data tidak tersedia</td>
                </tr>
            @endforelse
        </tbody>
        @if ($penjualan->count() > 0)
        <tfoot>
            <tr>
                <td colspan="4" style="text-align: right;">Total Keseluruhan</td>
                <td style="color: #E91E63;">Rp {{ number_format($grand_total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>
</div>

@endsection
